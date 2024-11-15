<?php

namespace App\Livewire\Panel\Payments;

use App\Models\RequestPayment;
use App\Models\Receipt;
use App\Models\User;
use App\Models\Branch;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class ListPayment extends Component
{
    use WithPagination;

    // Filtros
    public $branches;
    public $users;
    public $receiptStatuses;
    public $receiptTypes;

    // Filtros
    #[Url(as: 'date')]
    public $selectedDate;


    public $countFilters = 0;

    #[Url(as: 'sucursal')]
    public $selectedBranch;
    #[Url(as: 'usuario')]
    public $selectedUser;
    #[Url(as: 'estado-comprobante')]
    public $selectedReceiptStatus;
    #[Url(as: 'tipo-comprobante')]
    public $selectedReceiptType;

    public $sort = 'newest';

    #[Url(as: 'buscar')]
    public $searchTerm = '';

    // Estadísticas
    public $totalApprovedAmount = 0;
    public $totalPendingAmount = 0;
    public $totalRejectedAmount = 0;
    public $totalUncollectibleAmount = 0;

    // Otros
    public $business;


    public function mount()
    {
        $this->business = auth()->user()->business;

        // Cargar sucursales
        $this->branches = Branch::where('business_id', $this->business->id)
            ->select('id', 'name')
            ->get()
            ->toArray();

        // Cargar usuarios que hayan creado solicitudes de pago
        $this->users = User::where('business_id', $this->business->id)
            ->whereHas('requestPayments')
            ->select('id', 'name')
            ->get()
            ->toArray();

        // Estados de comprobantes
        $this->receiptStatuses = collect(\App\Enums\Tickets\StatusTicketEnum::cases())
            ->map(fn($status) => ['id' => $status->value, 'name' => $status->getName()])
            ->toArray();

        // Tipos de comprobantes
        $this->receiptTypes = collect(\App\Enums\RequestPayment\ReceiptTypeEnum::cases())
            ->map(fn($type) => ['id' => $type->value, 'name' => $type->getName()])
            ->toArray();


        // Fecha predeterminada: mes actual
        $this->selectedDate = $this->selectedDate ?? Carbon::now()->format('Y-m');

        $this->updateCountFilters();
    }




    #[Computed]
    public function payments()
    {
        $query = $this->getPaymentsQuery();

        // Calcular estadísticas
        $this->calculateStatistics(clone $query);

        // Paginar los resultados
        return $query->paginate(10);
    }

    protected function getPaymentsQuery()
    {
        $query = RequestPayment::where('business_id', $this->business->id)
            ->with([
                'receipts',
                'branch',
                'creator',
                'referenceable' => function ($query) {
                    $query->select('id');
                },
            ]);

        // Aplicar búsqueda
        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->where('id', 'like', $searchTerm)
                    ->orWhereHas('branch', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('creator', function ($query) use ($searchTerm) {
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


    protected function applyFilters($query)
    {
        $query->when($this->selectedBranch, function ($query) {
            $query->where('branch_id', $this->selectedBranch);
        })->when($this->selectedUser, function ($query) {
            $query->where('created_by', $this->selectedUser);
        })->when($this->selectedDate, function ($query) {

            $startDate = Carbon::parse($this->selectedDate)->startOfMonth()->toDateString();
            $endDate = Carbon::parse($this->selectedDate)->endOfMonth()->toDateString();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->when($this->selectedReceiptStatus, function ($query) {
            $query->whereHas('receipts', function ($query) {
                $query->where('status', $this->selectedReceiptStatus);
            });
        })->when($this->selectedReceiptType, function ($query) {
            $query->whereHas('receipts', function ($query) {
                $query->where('type', $this->selectedReceiptType);
            });
        });

        return $query;
    }


    protected function calculateStatistics($query)
    {
        $approvedStatus = \App\Enums\RequestPayment\StatusRequestPaymentEnum::APPROVED->value;
        $pendingStatus = \App\Enums\RequestPayment\StatusRequestPaymentEnum::PENDING->value;
        $rejectedStatus = \App\Enums\RequestPayment\StatusRequestPaymentEnum::REJECTED->value;
        $uncollectibleStatus = \App\Enums\RequestPayment\StatusRequestPaymentEnum::UNCOLLECTIBLE->value;



        $this->totalApprovedAmount = (clone $query)->where('status', $approvedStatus)->sum('amount_charged');
        $this->totalPendingAmount = (clone $query)->where('status', $pendingStatus)->sum('amount_charged');
        $this->totalRejectedAmount = (clone $query)->where('status', $rejectedStatus)->sum('amount_charged');
        $this->totalUncollectibleAmount = (clone $query)->where('status', $uncollectibleStatus)->sum('amount_charged');
    }



    public function updateCountFilters()
    {
        $this->countFilters = 0;

        if ($this->selectedBranch) $this->countFilters++;
        if ($this->selectedUser) $this->countFilters++;
        if ($this->selectedDate) $this->countFilters++;
        if ($this->selectedReceiptStatus) $this->countFilters++;
        if ($this->selectedReceiptType) $this->countFilters++;
        if ($this->searchTerm) $this->countFilters++;
    }

    public function resetFilters()
    {
        $this->selectedBranch = null;
        $this->selectedUser = null;
        $this->selectedDate  = null;

        $this->selectedReceiptStatus = null;
        $this->selectedReceiptType = null;
        $this->searchTerm = '';
        $this->updateCountFilters();
        $this->resetPage();
    }


    public function updateSort($sort)
    {
        $this->sort = $sort;
        $this->resetPage();
    }




    #[On('update-selected-value-branches')]
    public function updateSelectedBranch($value)
    {
        $this->selectedBranch = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-users')]
    public function updateSelectedUser($value)
    {
        $this->selectedUser = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-receiptStatuses')]
    public function updateSelectedReceiptStatus($value)
    {
        $this->selectedReceiptStatus = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }

    #[On('update-selected-value-receiptTypes')]
    public function updateSelectedReceiptType($value)
    {
        $this->selectedReceiptType = $value;
        $this->updateCountFilters();
        $this->resetPage();
    }









    public function render()
    {
        return view('livewire.panel.payments.list-payment')
            ->layout('layouts.panel', ['title' => 'Pagos']);
    }
}
