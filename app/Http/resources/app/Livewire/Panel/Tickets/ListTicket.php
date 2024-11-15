<?php

namespace App\Livewire\Panel\Tickets;

use App\Enums\PaymentMethodEnum;
use App\Enums\StatusVisitEnum;
use App\Enums\Tickets\StatusTicketEnum;
use App\Enums\Tickets\TypeTicketEnum;
use App\Helpers\Notifications;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Visit;
use Livewire\Attributes\Computed;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ListTicket extends Component
{

    use WithPagination;

    public $business;
    public $users;
    public $ticketStatuses;
    public $ticketTypes;

    // Filtros
    #[Url(as: 'date')]
    public $selectedDate;
    #[Url(as: 'user')]
    public $selectedUser;
    #[Url(as: 'status')]
    public $selectedStatus;
    #[Url(as: 'type')]
    public $selectedTypeTicket;

    #[Url(as: 'buscar')]
    public $searchTerm = '';

    public $countFilters = 0;
    public $sort = 'newest';

    //Propiedades del modal
    public $showViewModal = false;
    public $showConfirmationModal = false;
    public $modalModel;
    public $modalToggle = false;
    public $modalIcon;
    public $modalIconBgColor;
    public $modalTitle;
    public $modalMessage;
    public $modalConfirmAction;
    public $modalConfirmButtonText;
    public $modalConfirmButtonColor;
    public $modalConfirmButtonHoverColor;

    public $discount_bill;
    public $selectedTicketId;
    public $selectedTicket;


    public $modalView = false;

    public $modalToggleAnswer = null;
    public $photo = null;

    public $filteredTicketsIds;


    public $cashDeposits = 0;
    public $cashDepositsPending = 0;

    public $bankDeposits = 0;
    public $bankDepositsPending = 0;


    public $expenses = 0;
    public $expensesPending = 0;

    public $pendingMoney = 0;
    public $ticketPending = 0;

   

    public function mount()
    {
        $this->business = Auth::user()->business;

        // Obtener lista de usuarios del negocio
        $this->users = User::where('business_id', $this->business->id)
            ->get()
            ->map(function ($user) {
                return ['id' => $user->id, 'name' => $user->name];
            })
            ->toArray();

        // Obtener estados de los tickets
        $this->ticketStatuses = collect(StatusTicketEnum::cases())->map(function ($status) {
            return ['id' => $status->value, 'name' => $status->getName()];
        })->toArray();

        // Obtener tipos de tickets
        $this->ticketTypes = collect(TypeTicketEnum::cases())->map(function ($type) {
            return ['id' => $type->value, 'name' => $type->getName()];
        })->toArray();

        // Fecha predeterminada: mes actual
        $this->selectedDate = $this->selectedDate ?? Carbon::now()->format('Y-m');

        $this->updateCountFilters();

  
    }




    public function updateCountFilters()
    {
        $this->countFilters = 0;

        if ($this->selectedDate) $this->countFilters++;
        if ($this->selectedUser) $this->countFilters++;
        if ($this->selectedStatus) $this->countFilters++;
        if ($this->selectedTypeTicket) $this->countFilters++;
        if ($this->searchTerm) $this->countFilters++;
    }


    #[On('update-selected-value-users')]
    public function updateSelectedUser($value)
    {
        $this->selectedUser = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-ticketStatuses')]
    public function updateSelectedStatus($value)
    {
        $this->selectedStatus = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-ticketTypes')]
    public function updateSelectedTypeTicket($value)
    {
        $this->selectedTypeTicket = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }


    public function updateSort($sort)
    {
        $this->sort = $sort;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->selectedDate = null;
        $this->selectedUser = null;
        $this->selectedStatus = null;
        $this->selectedTypeTicket = null;
        $this->searchTerm = '';
        $this->updateCountFilters();
        $this->resetPage();
    }



    #[Computed()]
    public function tickets()
    {

        $query = $this->getTicketsQuery();

        $this->filteredTicketsIds = $query->pluck('tickets.id')->toArray();

        $tickets = $query->paginate(10);

        $this->calculateStatistics();

        $this->pendingMoney = $this->calculatePendingMoney();

        return $tickets;
    }




    protected function getTicketsQuery()
    {
        $query = Ticket::where('business_id', $this->business->id)
            ->select(
                'id',
                'description',
                'amount',
                'status',
                'type',
                'path',
                'created_by',
                'user_id',
                'business_id',
                'branch_id',
                'bank_account_id',
            )->with([
                'offeredBy' => function ($query) {
                    $query->select('id', 'name');
                },
                'branch' => function ($query) {
                    $query->select('id', 'name');
                },
                'bankAccount' => function ($query) {
                    $query->select('id', 'name');
                },
            ]);


        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where(function ($query) use ($searchTerm) {

                $query->whereHas('branch', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                })
                    ->orWhereHas('bankAccount', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    });
            });
        } else {
            $query = $this->applyFilters($query);
        }

        // Aplicar ordenamiento
        $query->orderBy('created_at', $this->sort === 'newest' ? 'desc' : 'asc');

        return $query;
    }



    public function applyFilters($query)
    {


        $query->when($this->selectedDate, function ($query) {
            $startDate = Carbon::parse($this->selectedDate)->startOfMonth()->toDateString();
            $endDate = Carbon::parse($this->selectedDate)->endOfMonth()->toDateString();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->when($this->selectedUser, function ($query) {
            $query->where('user_id', $this->selectedUser);
        })->when($this->selectedStatus, function ($query) {
            $query->where('status', $this->selectedStatus);
        })->when($this->selectedTypeTicket, function ($query) {
            $query->where('type', $this->selectedTypeTicket);
        });

        return $query;
    }



    public function approveTicket($ticketId)
    {
        $this->modalView = false;
        $this->selectedTicketId = $ticketId;
        $this->selectedTicket = Ticket::with(['offeredBy'])->findOrFail($ticketId);

        if ($this->selectedTicket->type == TypeTicketEnum::EXPENSES) {
            $this->modalModel = $this->selectedTicket;
            $this->modalToggle = true;
            $this->modalToggleAnswer = '¿Desea descontar de la billetera?';
        }

        // Configurar datos del modal
        $this->modalIcon = '<svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
    </svg>';


        $this->modalIconBgColor = 'bg-green-100';
        $this->modalTitle = 'Aprobar Ticket';
        $this->modalMessage = '¿Está seguro de APROBAR el ticket creado por el usuario ' . ($this->selectedTicket->offeredBy->name ?? '') . '?';
        $this->modalConfirmAction = 'confirmApproveTicket';
        $this->modalConfirmButtonText = 'Aprobar';
        $this->modalConfirmButtonColor = 'bg-green-600';
        $this->modalConfirmButtonHoverColor = 'bg-green-700';
        $this->showConfirmationModal = true;
    }


    public function rejectTicket($ticketId)
    {


        $this->modalView = false;
        $this->selectedTicketId = $ticketId;
        $this->selectedTicket = Ticket::with(['offeredBy'])->findOrFail($ticketId);

        // Configurar datos del modal
        $this->modalIcon = '<svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5" />
        <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round" />
    </svg>';
        $this->modalIconBgColor = 'bg-red-100';
        $this->modalTitle = 'Rechazar Ticket';
        $this->modalMessage = '¿Está seguro de RECHAZAR el ticket creado por el usuario ' . ($this->selectedTicket->offeredBy->name ?? '') . '?';
        $this->modalConfirmAction = 'confirmRejectTicket';
        $this->modalConfirmButtonText = 'Rechazar';
        $this->modalConfirmButtonColor = 'bg-red-600';
        $this->modalConfirmButtonHoverColor = 'bg-red-700';

        $this->showConfirmationModal = true;
    }


    public function recoverTicket($ticketId)
    {

        $this->modalView = false;
        $this->selectedTicketId = $ticketId;
        $this->selectedTicket = Ticket::with(['offeredBy'])->findOrFail($ticketId);

        // Configurar datos del modal
        $this->modalIcon = '<svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
        </svg>';
        $this->modalIconBgColor = 'bg-blue-100';
        $this->modalTitle = 'Recuperar Ticket';
        $this->modalMessage = '¿Está seguro de RECUPERAR el ticket creado por el usuario ' . ($this->selectedTicket->offeredBy->name ?? '') . '?';
        $this->modalConfirmAction = 'confirmRecoverTicket';
        $this->modalConfirmButtonText = 'Recuperar';
        $this->modalConfirmButtonColor = 'bg-blue-600';
        $this->modalConfirmButtonHoverColor = 'bg-blue-700';

        $this->showConfirmationModal = true;
    }

    public function archiveTicket($ticketId)
    {

        $this->modalView = false;
        $this->selectedTicketId = $ticketId;
        $this->selectedTicket = Ticket::with(['offeredBy'])->findOrFail($ticketId);

        // Configurar datos del modal
        $this->modalIcon = '<svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
        </svg>';
        $this->modalIconBgColor = 'bg-gray-100';
        $this->modalTitle = 'Archivar Ticket';
        $this->modalMessage = '¿Está seguro de ARCHIVAR el ticket creado por el usuario ' . ($this->selectedTicket->offeredBy->name ?? '') . '?';
        $this->modalConfirmAction = 'confirmArchiveTicket';
        $this->modalConfirmButtonText = 'Archivar';
        $this->modalConfirmButtonColor = 'bg-gray-600';
        $this->modalConfirmButtonHoverColor = 'bg-gray-700';

        $this->showConfirmationModal = true;
    }



    public function viewTicket($ticketId)
    {
        $this->modalView = true;
        $this->selectedTicketId = $ticketId;
        $this->selectedTicket = Ticket::with(['offeredBy', 'branch', 'bankAccount'])->findOrFail($ticketId);

        $this->photo = $this->selectedTicket->path;

        $this->modalMessage = $this->selectedTicket->description;

        // Ver ticket
        $this->modalIcon = '<svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>';


        $this->modalIconBgColor = 'bg-gray-100';
        $this->modalTitle = 'Ver Ticket';


        $this->modalView = true;

        $this->showConfirmationModal = true;
    }

    public function confirmApproveTicket()
    {
        $ticket = Ticket::findOrFail($this->selectedTicketId);

        if ($ticket->type == TypeTicketEnum::EXPENSES) {


            $ticket->discount_bill = $this->discount_bill;
        }

        $ticket->status = StatusTicketEnum::APPROVED;
        $ticket->save();

        $this->showConfirmationModal = false;
        session()->flash('notification', [
            'message' => 'Ticket aprobado correctamente',
            'type' => 'success',
        ]);

        $this->resetModal();
    }


    public function confirmRejectTicket()
    {

        $ticket = Ticket::findOrFail($this->selectedTicketId);
        $ticket->status = StatusTicketEnum::REJECTED;
        $ticket->save();

        $this->showConfirmationModal = false;
        session()->flash('notification', [
            'message' => 'Ticket rechazado correctamente',
            'type' => 'success',
        ]);

        $this->resetModal();
    }


    public function confirmRecoverTicket()
    {

        $ticket = Ticket::findOrFail($this->selectedTicketId);
        $ticket->status = StatusTicketEnum::PENDING;
        $ticket->save();

        $this->showConfirmationModal = false;
        session()->flash('notification', [
            'message' => 'Ticket recuperado correctamente',
            'type' => 'success',
        ]);

        $this->resetModal();
    }

    public function confirmArchiveTicket()
    {

        //Hacer un softdelete
        $ticket = Ticket::findOrFail($this->selectedTicketId);
        $ticket->delete();
        $this->showConfirmationModal = false;
        session()->flash('notification', [
            'message' => 'Ticket archivado correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->resetModal();
    }

    #[On('cancelAction')]
    public function cancelAction()
    {
        $this->showConfirmationModal = false;
        $this->resetModal();
    }

    // Similar para los demás métodos de confirmación


    public function resetModal()
    {
        $this->showConfirmationModal = false;
        $this->showViewModal = false;
        $this->modalView = false;
        $this->selectedTicketId = null;
        $this->selectedTicket = null;
        $this->photo = null;
        $this->modalModel = null;
        $this->modalToggle = false;
        $this->modalToggleAnswer = null;
        $this->discount_bill = null;
    }



    #[On('update-checked-toggle-id')]
    public function updateToggle($value, $id)
    {
        $this->discount_bill = $value;
    }







    protected function calculateStatistics()
    {

        //Se usa en todos
        $ticketFilters = Ticket::where('business_id', $this->business->id)->whereIn('id', $this->filteredTicketsIds);

    
        //Particulares de cash deposits
        $this->cashDeposits = $ticketFilters->clone()->where('type', TypeTicketEnum::CASH_DEPOSIT)
        ->where('status', StatusTicketEnum::APPROVED)->sum('amount');

        $this->cashDepositsPending = $ticketFilters->clone()->where('type', TypeTicketEnum::CASH_DEPOSIT)
        ->where('status', StatusTicketEnum::PENDING)->sum('amount');

        //Particulares de bank deposits

        $this->bankDeposits = $ticketFilters->clone()->where('type', TypeTicketEnum::TRANSFER_DEPOSIT)
        ->where('status', StatusTicketEnum::APPROVED)->sum('amount');

        $this->bankDepositsPending = $ticketFilters->clone()->where('type', TypeTicketEnum::TRANSFER_DEPOSIT)
        ->where('status', StatusTicketEnum::PENDING)->sum('amount');

        //Particulares de bills
        $this->expenses = $ticketFilters->clone()->where('type', TypeTicketEnum::EXPENSES)->where('status', StatusTicketEnum::APPROVED)
            ->sum('amount');

        $this->expensesPending = $ticketFilters->clone()->where('type', TypeTicketEnum::EXPENSES)
            ->where('status', StatusTicketEnum::PENDING)
            ->sum('amount');



        
        $this->ticketPending =  $this->cashDepositsPending + $this->bankDepositsPending + $this->expensesPending + $ticketFilters->clone()->where('type', TypeTicketEnum::ADJUSTMENT)
        ->where('status', StatusTicketEnum::PENDING)
        ->sum('amount');

        // unset($this->tickets);
    }


    public function calculatePendingMoney()
    {

        //Traer todas las visitas con filtro de selected User donde el payment method fue Deposit
        $visits = Visit::where('business_id', $this->business->id)
            ->where('status', StatusVisitEnum::COMPLETED->value)
            ->where('expected_payment', PaymentMethodEnum::Cash->value);

        $visits = $this->applyBillFilters($visits)->sum('amount_received');
        

        $deposits = Ticket::where('business_id', $this->business->id)
        ->whereIn('type', [TypeTicketEnum::CASH_DEPOSIT, TypeTicketEnum::TRANSFER_DEPOSIT])
        ->where('status', StatusTicketEnum::APPROVED);

        $deposits = $this->applyBillFilters($deposits)->sum('amount');

        $expenses =  Ticket::where('business_id', $this->business->id)
        ->where('type', TypeTicketEnum::EXPENSES)->where('status', StatusTicketEnum::APPROVED)
        ->where('discount_bill', true);

        $expenses = $this->applyBillFilters($expenses)->sum('amount');

        $adjustments = Ticket::where('business_id', $this->business->id)
                        ->where('type', TypeTicketEnum::ADJUSTMENT)
                        ->where('status', StatusTicketEnum::APPROVED); 

        $adjustments = $this->applyBillFilters($adjustments)->sum('amount');


        return $visits - $deposits - $expenses + $adjustments;

    }


    public function applyBillFilters($query)
    {
        $query->when($this->selectedDate, function ($query) {
            $startDate = Carbon::parse($this->selectedDate)->startOfMonth()->toDateString();
            $endDate = Carbon::parse($this->selectedDate)->endOfMonth()->toDateString();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->when($this->selectedUser, function ($query) {
            if ($query instanceof Visit) {
                $query->whereHas('users', function ($query) {
                    $query->where('id', $this->selectedUser);
                });
            } else {
                $query->where('user_id', $this->selectedUser);
            }
        });

        return $query;
    }



    public function render()
    {

        return view('livewire.panel.tickets.list-ticket')->layout('layouts.panel');
    }
}
