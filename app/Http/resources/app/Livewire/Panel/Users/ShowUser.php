<?php

namespace App\Livewire\Panel\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Notifications;
use App\Models\Phone;
use Illuminate\Support\Arr;





class ShowUser extends Component
{
    use WithPagination; // Añadir el trait para la paginación

    public ?User $user;
    public $currentSection = 1;
    public $perPage = 6;
    public $productsWithUnits;

    public $phoneForm;
    public $phoneNumberForm;
    public $phoneTagForm;
    public $phoneTypeForm;


    public function mount()
    {
        // Cargar las relaciones de productos y unidades
        // $this->user->load('units', 'products');

        // Mapear las unidades correspondientes a cada producto
    

        // dd( $this->productsWithUnits);

        // Opcional: Puedes usar un dump temporal para ver el resultado si es necesario
        
        // dd($this->productsWithUnits);

    //  $this->phones = $this->user->phones;
    }

    public function changeSection($section)
    {
        $this->currentSection = $section;
    }

    public function loadMore()
    {
        $this->perPage += 8;
    }


    public function addPhone()
    {
        $this->reset('phoneForm', 'phoneNumberForm', 'phoneTagForm', 'phoneTypeForm');
        $this->dispatch('open-phone-form');
    }


    
    public function editPhone($phoneId)
    {
        $this->authorize('access-function', 'phone-edit');
        $this->phoneForm = Phone::find($phoneId);
        $this->phoneNumberForm = $this->phoneForm->number;
        $this->phoneTagForm = $this->phoneForm->tag;


        $this->phoneTypeForm = $this->phoneForm->type;

        $this->dispatch('open-phone-form');
    }

    public function deletePhone($phoneId)
    {
        $this->authorize('access-function', 'phone-delete');
        $phoneForm = Phone::find($phoneId);

        if ($phoneForm) {
            $phoneForm->delete();

            $this->dispatch('notification', [
                'message' => 'Teléfono eliminado correctamente',
                'type' => Notifications::icons('success')
            ]);
        }

   
        $this->reset('phoneForm');

    }

 


    public function savePhone()
    {

        $this->authorize('access-function', 'phone-add');
        $this->validate([
            'phoneNumberForm' => 'required',
            'phoneTagForm' => 'required',
            'phoneTypeForm' => 'required',
        ], $this->phoneMessages());

        
        //   dd($this->phoneForm);



          if ($this->phoneForm) {

            $this->phoneForm->update([
                'number' => $this->phoneNumberForm,
                'tag' => $this->phoneTagForm,
                'type' => $this->phoneTypeForm,
            ]);

           
                $this->phoneForm->phoneable_id = $this->user->id;
                $this->phoneForm->phoneable_type = 'App\Models\User';
                $this->phoneForm->save();
          
        } else {

           
        

            $phones = $this->user->phones->toArray();


            if (!authorizeFeatureCount('phone-add', $phones, $this)) {
                $this->dispatch('close-phone-form');
                return;
            }

        

           $newPhone = Phone::create([
                'number' => $this->phoneNumberForm,
                'tag' => $this->phoneTagForm,
                'type' => $this->phoneTypeForm,
                'order' => $phones ? Arr::last($phones)['order'] + 1 : 1,
                'phoneable_id' => $this->user->id,
                'phoneable_type' => 'App\Models\User',
            ]);

        }

        //  dd($newPhone);


        $this->user->load('phones');
        $this->dispatch('close-phone-form');
        $this->reset('phoneForm');
    }


    protected function phoneMessages()
    {
        return [
            'number.required' => 'El número es obligatorio.',
            'number.numeric' => 'El número debe ser un valor numérico.',
            'tagNumber.required' => 'El tag del número es obligatorio.',
            'phoneModel.required' => 'El modelo del teléfono es obligatorio.',
            'typeNumber.required' => 'El tipo de número es obligatorio.',
        ];
    }






    public function render()
    {
        // Obtener las visitas paginadas del usuario
        $visits = $this->user->visits()->paginate($this->perPage);
    
        // Agrupar las unidades por producto
        $this->productsWithUnits = $this->user->products->unique('id')->map(function ($product) {
            // Filtrar las unidades que pertenecen al producto actual
            $units = $this->user->units->filter(function ($unit) use ($product) {
                return $unit->product_id == $product->id;
            });
    
            // Asignar las unidades como un nuevo atributo al producto
            $product->units = $units;
    
            return $product;
        });

        $userPhones = $this->user->phones->toArray();
    
        return view('livewire.panel.users.show-user', [
            'visits' => $visits,
            'productsWithUnits' => $this->productsWithUnits,
            'phones' => $userPhones,
        ])->layout('layouts.panel');
    }
    
}
