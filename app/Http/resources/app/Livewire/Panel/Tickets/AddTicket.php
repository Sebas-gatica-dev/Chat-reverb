<?php

namespace App\Livewire\Panel\Tickets;

use App\Enums\Tickets\StatusTicketEnum;
use App\Enums\Tickets\TypeTicketEnum;
use App\Jobs\ImageOptimizationSquare;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddTicket extends Component
{
    use WithFileUploads;

    // Propiedades del Ticket
    public $type;
    public $date;
    public $user_id;
    public $amount;
    public $description;
    public $proof; // Comprobante (archivo)
    public $branch_id;
    public $bank_account_id;

    // Colecciones para inputs select
    public $types;
    public $users;
    public $branches;
    public $bank_accounts;


    public function mount()
    {

        // Cargar tipos de tickets
        $this->types = collect(TypeTicketEnum::cases())->map(function ($type) {
            return ['id' => $type->value, 'name' => $type->getName()];
        })->toArray();

        // Cargar usuarios del negocio actual
        $this->users = User::where('business_id', auth()->user()->business_id)->get()->map(function ($user) {
            return ['id' => $user->id, 'name' => $user->name];
        })->toArray();

        // Cargar sucursales del negocio actual
        $this->branches = Branch::where('business_id', auth()->user()->business_id)->get()->map(function ($branch) {
            return ['id' => $branch->id, 'name' => $branch->name];
        })->toArray();

        // Cargar cuentas bancarias del negocio actual
        $this->bank_accounts = BankAccount::where('business_id', auth()->user()->business_id)->get()->map(function ($bank_account) {
            return ['id' => $bank_account->id, 'name' => $bank_account->name];
        })->toArray();

        // Establecer fecha predeterminada
        $this->date = Carbon::now()->format('Y-m-d');
    }

    public function rules()
    {


        return  [

            'type' => ['required', Rule::in(array_column(TypeTicketEnum::cases(), 'value'))],
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
            'branch_id' => 'nullable|required_if:type,cash_deposit',
            'bank_account_id' => 'nullable|required_if:type,transfer_deposit',
            'proof' => 'nullable|required_if:type,transfer_deposit|file|mimes:pdf,jpg,jpeg,png|max:2048',

        ];
    }

    public function messages() {

     return [

        'type.required' => 'El tipo de ticket es obligatorio.',
        'type.in' => 'El tipo de ticket no es válido.',
        'date.required' => 'La fecha es obligatoria.',
        'date.date' => 'La fecha no es válida.',
        'user_id.required' => 'El usuario es obligatorio.',
        'user_id.exists' => 'El usuario no es válido.',
        'amount.required' => 'El monto es obligatorio.',
        'amount.numeric' => 'El monto debe ser un número.',
        'amount.min' => 'El monto no puede ser negativo.',
        'description.string' => 'El detalle debe ser una cadena de texto.',
        'branch_id.required_if' => 'La sucursal es obligatoria.',
        'bank_account_id.required_if' => 'La cuenta bancaria es obligatoria.',
        'proof.required_if' => 'El comprobante es obligatorio.',
        'proof.file' => 'El comprobante debe ser un archivo.',
        
     ];
    }
    public function save()
    {
   
        $this->validate();

        // Crear el ticket
        $ticket = Ticket::create([
            'type' => $this->type,
            'created_at' => $this->date,
            'created_by' => auth()->id(),
            'user_id' => $this->user_id ?? auth()->id(),
            'amount' => $this->amount,
            'description' => $this->description,
            // 'path' => $proofPath ?? null,
            'branch_id' => $this->branch_id ?? null,
            'bank_account_id' => $this->bank_account_id ?? null,
            'status' => StatusTicketEnum::PENDING, // Estado predeterminado
            'business_id' => auth()->user()->business_id, // Asignar al negocio actual
            // Otros campos...
        ]);

        
        if ($this->proof) {


            // Crear un nombre único para la imagen
            $filename =   uniqid() . '.webp';
            $filePath = Str::slug(auth()->user()->business->name) . '/tickets/' . $ticket->id . '/';
            $filenameComplete = $filePath . $filename;
            // Guardar la imagen optimizada en el storage
            $this->proof->storeAs(path: $filePath, name: $filename);
            // Actualizar la propiedad con la ruta de la imagen optimizada
            $ticket->update([
                'path' => $filenameComplete,
            ]);

            Bus::dispatch(new ImageOptimizationSquare($filenameComplete));
        }



        session()->flash('notification', [
            'message' => 'Ticket creado correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('panel.tickets.list');
    }




    #[On('update-selected-value-type')]
    public function updateType($type)
    {
       
        $this->type = $type;
    }


    #[On('update-selected-value-user')]
    public function updateSelectedUser($user_id)
    {
        $this->user_id = $user_id;
    }

    
    #[On('update-selected-value-branch')]
    public function updateSelectedBranch($branch_id)
    {
        $this->branch_id = $branch_id;
    }


    #[On('update-selected-value-bank_account')]
    public function updateSelectedBankAccount($bank_account_id)
    {
        $this->bank_account_id = $bank_account_id;
    }






    #[On('change-files-proof')]
    public function updateProof($value)
    {

        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
        $this->proof = $file;
    }

    #[On('remove-files-proof')]
    public function removeFile()
    {
        $this->proof = null;
    }


    public function render()
    {
        return view('livewire.panel.tickets.add-ticket')->layout('layouts.panel');
    }
}
