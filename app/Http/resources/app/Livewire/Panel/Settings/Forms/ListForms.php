<?php

namespace App\Livewire\Panel\Settings\Forms;

use Livewire\Component;
use App\Enums\Forms\InputTypeEnum;
use App\Models\InputData;
use App\Models\Input;
use App\Enums\Forms\SectorTypeEnum;
use Livewire\Attributes\On;
use App\Helpers\Notifications;



class ListForms extends Component
{

    public $inputs = [];
    public $inputsType;
    public $sectors;
    public $selectedSector;
    public $labelInput;
    public $requiredForm;
    public $selectedInput;
    public $selectedTypeInput = 'default';

    public $inputIsRequired = false;
    public $isRequiredMessage;

    public $showPlaceholderField;
    public $placeholderForm;
    public $inputsForSector = [];

    public $sectorSubcategories = [];
    public $showSubcategories = false;

    public $optionsForSelect = [];

    public $activeSector = null;

    public function mount()
    {
        $this->inputsType = collect(InputTypeEnum::cases())
            ->filter(fn($inputType) => $inputType->value !== 'default') // Excluir el valor 'default'
            ->map(fn($inputType) => [
                'id' => $inputType->value,
                'name' => $inputType->getName(),
            ])->toArray();
    
        $this->sectors = collect(SectorTypeEnum::getParentTypes())
            ->map(fn($name, $id) => [
                'id' => $id,
                'name' => $name,
                'subcategories' => SectorTypeEnum::from($id)->getSubCategories(),
            ])->toArray();
    }
    
   
 
public function changeSector($module)
{
    // Verificar si el módulo seleccionado es una subcategoría
    $isSubcategory = false;
    foreach ($this->sectors as $sector) {
        if (in_array($module, array_column($sector['subcategories'], 'value'))) {
            $isSubcategory = true;
            break;
        }
    }

    if (!$isSubcategory) {
        $this->showSubcategories = false; // Ocultar subcategorías con animación
    }

    $this->selectedSector = $module;
    $this->activeSector = $this->getParentSector($module);
    $this->updateInputsForSector();
    $this->resetForm();
}

    public function showSubcategoriesFromSector($module)
    {
        $subcategories = [];
    
        foreach ($this->sectors as $sector) {
            if ($sector['id'] === $module) {
                foreach ($sector['subcategories'] as $sub) {
                    $sub = [
                        'id' => $sub->value,
                        'name' => SectorTypeEnum::from($sub->value)->getName(),
                    ];
                    $subcategories[] = $sub;
                }
            }
        }
    
        $this->selectedSector = $module;
        $this->activeSector = $module;
        $this->sectorSubcategories = $subcategories;
        $this->showSubcategories = true;
        $this->updateInputsForSector();
        $this->resetForm();
    }
    

    private function getParentSector($module)
    {
        foreach ($this->sectors as $sector) {
            if ($sector['id'] === $module || in_array($module, array_column($sector['subcategories'], 'value'))) {
                return $sector['id'];
            }
        }
        return null;
    }





    public function getDynamicParams()
    {
        $commonParams = [
            'label' => $this->labelInput,
            'validationMessage' => $this->isRequiredMessage, // Pasamos el mensaje de validación al componente hijo
        ];

        if ($this->selectedTypeInput === 'select') {
            return array_merge($commonParams, [
                'options' => $this->optionsForSelect,
            ]);
        }

        return $commonParams;
    }






    // public function changeSector($module)
    // {
    //     $this->selectedSector = $module;

    //     $this->updateInputsForSector();
    //     $this->resetForm();

    // }


 

    public function updateInputsForSector()
    {
        $this->inputs = Input::where('sector', $this->selectedSector)
            ->where('business_id', auth()->user()->business_id)
            ->orderBy('order', 'asc') // Ordenar por el campo 'order'
            ->get()
            ->toArray();


        // dd($this->inputs);

        
        $this->inputsForSector = array_filter($this->inputs, function (
            $input,
        ) {
            return $input['sector'] === $this->selectedSector;
        });




    }

// public function showSubcategoriesFromSector($module)
// {


//     $subcategories = [];

  
//         foreach($this->sectors as $sector) {

//             if ($sector['id'] === $module) {

               
//                  foreach($sector['subcategories'] as $sub) {


//                     $sub = [
//                         'id' => $sub->value,
//                         'name' => SectorTypeEnum::from($sub->value)->getName(),
//                     ];


//                     $subcategories[] = $sub;

//                 }


             



//                 //  dd( $this->sectorSubcategories);

              
            
//             }

//         }

//     $this->selectedSector = $module;
//     $this->sectorSubcategories = $subcategories;
//     $this->showSubcategories = true;
//     $this->updateInputsForSector();
//     $this->resetForm();


// }


    public function rules()
    {
        return [
            'labelInput' => 'required',
            'selectedSector' => 'required',
            'selectedTypeInput' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'default') {
                        $fail('Debes seleccionar un tipo de input válido.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'labelInput.required' => 'El input debe tener un encabezado',
            'selectedSector.required' => 'Debes seleccionar un sector',
            'selectedTypeInput.required' => 'Debes seleccionar un tipo de input',
        ];
    }


    public function save()
    {
        $this->validate();

        // dd($this->optionsForSelect);

        $optionForSelect = $this->selectedTypeInput === 'select' ? json_encode($this->optionsForSelect) : null;

        if ($this->selectedInput) {
            // Modo de edición
            $input = Input::where('id', $this->selectedInput)->firstOrFail();
            $input->update([
                'label' => $this->labelInput,
                'sector' => $this->selectedSector,
                'input_type' => $this->selectedTypeInput,
                'required' => $this->inputIsRequired,
                'placeholder' => $this->placeholderForm,
                'options' => $optionForSelect,
            ]);

            // Actualizar el input en la lista de inputs
            foreach ($this->inputs as &$existingInput) {
                if ($existingInput['id'] === $this->selectedInput) {
                    $existingInput['label'] = $this->labelInput;
                    $existingInput['sector'] = $this->selectedSector;
                    $existingInput['input_type'] = $this->selectedTypeInput;
                    $existingInput['required'] = $this->inputIsRequired;
                    $existingInput['placeholder'] = $this->placeholderForm;
                    $existingInput['options'] = $optionForSelect;
                    break;
                }
            }

            // session()->flash('notification', [
            //     'message' => 'Input actualizado correctamente' ,
            //     'type' => Notifications::icons('success')
            // ]);

        } else {
            // Modo de creación
            $lastOrder = Input::where('sector', $this->selectedSector)
                ->where('business_id', auth()->user()->business_id)
                ->select('order')
                ->max('order');
            $newOrder = $lastOrder ? $lastOrder + 1 : 1;

            $input = Input::create([
                'label' => $this->labelInput,
                'sector' => $this->selectedSector,
                'input_type' => $this->selectedTypeInput,
                'required' => $this->inputIsRequired,
                'placeholder' => $this->placeholderForm,
                'options' => $optionForSelect,
                'order' => $newOrder,
                'business_id' => auth()->user()->business_id,
            ]);

            $this->inputs[] = $input;
        }

        $this->resetForm();
        $this->updateInputsForSector();

        session()->flash('notification', [
            'message' => 'Input creado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }

    public function deleteForm($id)
    {

        $ordenedInputs = [];

        $input = Input::where('id', $id)->firstOrFail();
        $input->delete();

        $this->inputs = array_values(array_filter($this->inputs, fn($input) => $input['id'] !== $id));

        // dd($this->inputs);
        foreach ($this->inputs as $index => $input) {
            $input['order'] = $index + 1; // El nuevo orden empieza desde 1
            Input::where('id', $input['id'])->update(['order' => $input['order']]);
            $ordenedInputs[] = $input;
        }

        $this->inputs = $ordenedInputs;
        $this->resetForm();
        $this->updateInputsForSector();

        session()->flash('notification', [
            'message' => 'Input eliminada correctamente',
            'type' => Notifications::icons('success')
        ]);
    }

    public function editForm($id)
    {

        $input = Input::where('id', $id)->firstOrFail();
        $this->selectedInput = $input->id;
        $this->labelInput = $input->label;
        $this->selectedTypeInput = $input->input_type->value;
        $this->inputIsRequired = $input->required;
        $this->placeholderForm = $input->placeholder;
        $this->optionsForSelect = json_decode($input->options, true) ?? null;
        $this->dispatch('update-from-parent-is-required', $this->inputIsRequired);
        $this->dispatch('change-selected-value-typeInput', $this->selectedTypeInput);

    }

    public function resetForm()
    {
        $this->labelInput = '';
        $this->inputIsRequired = false;
        $this->placeholderForm = '';
        $this->showPlaceholderField = false;
        $this->optionsForSelect = null;
        $this->dispatch('update-from-parent-is-required', false);
        $this->dispatch('clear-selected-value-typeInput', $this->selectedTypeInput);
        $this->selectedTypeInput = 'default';
        $this->selectedInput = null;

    }

    #[On('update-selected-value-typeInput')]
    public function changeSelectedTypeInput($value)
    {

        if ($value) {

            $this->selectedTypeInput = $value;

            if ($value == 'text' || $value == 'textarea' || $value == 'number' || $value == 'select') {

                $this->showPlaceholderField = true;

            } else {

                $this->showPlaceholderField = false;
                
            }
        } else {

            $this->selectedTypeInput = 'default';

        }
    }

    #[On('update-checked-is-required')]
    public function updateChecked($value)
    {
        $this->inputIsRequired = $value;
    }

    public function updateTaskOrder($order)
    {

        $ordenedInputs = [];

        foreach ($order as $item) {
            // Encuentra el input en el array de inputs por su ID
            $input = collect($this->inputs)->firstWhere('id', $item['value']);

            if ($input) {
                // Actualiza el campo 'order' en el input del array
                $input['order'] = $item['order'];

                // Guarda el input actualizado en la base de datos
                $inputDb = Input::where('id', $item['value'])->firstOrFail();
                $inputDb->order = $item['order']; // Asegúrate de tener este campo en tu modelo Input
                $inputDb->save();

                // Añade el input actualizado a la lista ordenada
                $ordenedInputs[] = $input;
            }
        }

        // Actualiza el array completo de inputs en la propiedad $inputs
        $this->inputs = $ordenedInputs;
    }

    public function render()
    {

        $dynamicParams = $this->getDynamicParams();

        return view('livewire.panel.settings.forms.list-forms', [
            'dynamicParams' => $dynamicParams,
        ])->layout('layouts.panel');
    }
     
}
