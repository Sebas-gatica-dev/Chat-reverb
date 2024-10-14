<?php

namespace App\Livewire\Panel;

use App\Models\Customer;
use App\Models\Property;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;

class SearchList extends Component
{
    #[Url]
    public $search;

    public $results = [];

    public function mount()
    {
        $this->authorize('access-function', 'search-main');
        $this->performSearch();
    }

    public function updatedSearch()
    {
        $this->performSearch();
    }

    private function normalizeString($string)
    {
        // Elimina los acentos utilizando iconv y reemplaza cualquier caracter no ASCII.
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        // Convierte a minúsculas para comparación insensible a mayúsculas.
        $string = strtolower($string);
        // Elimina cualquier carácter no deseado, por ejemplo, marcas de apóstrofos que puedan quedar.
        $string = preg_replace('/[^a-z0-9\s]/', '', $string);

        return $string;
    }

    public function performSearch()
    {

        $this->dispatch('fill', $this->search)->to(Search::class);

        $this->results = []; // Reset the results array

        // Normalizar el término de búsqueda
        $normalizedSearch = $this->normalizeString($this->search);


        if(strlen($this->search) < 3) {
            return;
        }

        // Buscar en Clientes
        $clientes = Customer::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('surname', 'like', '%' . $this->search . '%')
            ->orWhereHas('phones', function ($query) {
                $query->where('number', 'like', '%' . $this->search . '%');
            })
            ->get();

        foreach ($clientes as $cliente) {
            // Chequea coincidencia en nombre
            if (stripos($this->normalizeString($cliente->name), $normalizedSearch) !== false) {
                $this->results[] = [
                    'type' => 'Cliente',
                    'data' => $cliente,
                    'field' => 'nombre',
                    'value' => $cliente->name
                ];
            }

            // Chequea coincidencia en apellido
            if (stripos($this->normalizeString($cliente->surname), $normalizedSearch) !== false) {
                $this->results[] = [
                    'type' => 'Cliente',
                    'data' => $cliente,
                    'field' => 'apellido',
                    'value' => $cliente->surname
                ];
            }

            // Chequea coincidencia en teléfono
            foreach ($cliente->phones as $phone) {
                if (stripos($this->normalizeString($phone->number), $normalizedSearch) !== false) {
                    $this->results[] = [
                        'type' => 'Cliente',
                        'data' => $cliente,
                        'field' => 'teléfono',
                        'value' => $phone->number
                    ];
                }
            }
        }

        // Buscar en Propiedades
        $propiedades = Property::where('property_name', 'like', '%' . $this->search . '%')
            ->orWhere('address', 'like', '%' . $this->search . '%')
            ->orWhereHas('phones', function ($query) {
                $query->where('number', 'like', '%' . $this->search . '%');
            })
            ->with('customer')
            ->get();

        foreach ($propiedades as $propiedad) {
            // Chequea coincidencia en nombre de propiedad
            if (stripos($this->normalizeString($propiedad->property_name), $normalizedSearch) !== false) {
                $this->results[] = [
                    'type' => 'Propiedad',
                    'data' => $propiedad,
                    'field' => 'nombre',
                    'value' => $propiedad->property_name
                ];
            }

            // Chequea coincidencia en dirección
            if (stripos($this->normalizeString($propiedad->address), $normalizedSearch) !== false) {
                $this->results[] = [
                    'type' => 'Propiedad',
                    'data' => $propiedad,
                    'field' => 'dirección',
                    'value' => $propiedad->address
                ];
            }

            // Chequea coincidencia en teléfono
            foreach ($propiedad->phones as $phone) {
                if (stripos($this->normalizeString($phone->number), $normalizedSearch) !== false) {
                    $this->results[] = [
                        'type' => 'Propiedad',
                        'data' => $propiedad,
                        'field' => 'teléfono',
                        'value' => $phone->number
                    ];
                }
            }
        }

        // Buscar en Usuarios
        $usuarios = User::where('name', 'like', '%' . $this->search . '%')->get();

        foreach ($usuarios as $usuario) {
            // Chequea coincidencia en nombre de usuario
            if (stripos($this->normalizeString($usuario->name), $normalizedSearch) !== false) {
                $this->results[] = [
                    'type' => 'Usuario',
                    'data' => $usuario,
                    'field' => 'nombre',
                    'value' => $usuario->name
                ];
            }
        }
    }





    public function render()
    {
        return view('livewire.panel.search-list')
            ->layout('layouts.panel');
    }
}
