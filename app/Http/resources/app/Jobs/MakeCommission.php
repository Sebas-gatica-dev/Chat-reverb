<?php

namespace App\Jobs;

use App\Enums\Salaries\ModallyProfitCounterSalaryEnum;
use App\Enums\Salaries\ModallyProfitSalaryEnum;
use App\Enums\Salaries\ProfitOfSalaryEnum;
use App\Enums\Salaries\TaxesSalaryEnum;
use App\Enums\Salaries\TransportSalaryEnum;
use App\Models\Commission;
use App\Models\Salary;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MakeCommission implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

     protected $visitId;

    public function __construct($visitId)
    {
        $this->visitId = $visitId;

    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Obtener la visita
        $visit = Visit::with(['users', 'property'])->find($this->visitId);
    
        if (!$visit) {
            // Manejar el caso donde la visita no existe
            return;
        }
    
        $businessId = $visit->business_id;
    
        // Obtener los salarios relevantes
        $salaries = Salary::where('business_id', $businessId)
            ->whereIn('type', ['commission', 'porcentaje']) // Ajusta según corresponda
            ->get();
    
        // Iterar sobre los salarios y aplicar la lógica
        foreach ($salaries as $salary) {
            switch ($salary->profit_of) {
                case ProfitOfSalaryEnum::WORKS:
                    $this->handleWorksProfit($salary, $visit);
                    break;
                case ProfitOfSalaryEnum::CUSTOMERS:
                    $this->handleCustomersProfit($salary, $visit);
                    break;
            }
        }
    

    }


    private function handleWorksProfit($salary, $visit)
    {
        $visitUserIds = $visit->users->pluck('id')->toArray();

        switch ($salary->modally_profit) {
            case ModallyProfitSalaryEnum::OWN:
                if (in_array($salary->user_id, $visitUserIds)) {
                    $this->createCommission($salary, $visit);
                }
                break;
            case ModallyProfitSalaryEnum::USERS:
                $modallyProfitIds = json_decode($salary->modally_profit_ids, true);
                if (array_intersect($modallyProfitIds, $visitUserIds)) {
                    $this->createCommission($salary, $visit);    
                }
                break;
            case ModallyProfitSalaryEnum::BRANCHES:
                $modallyProfitIds = json_decode($salary->modally_profit_ids, true);
                $visitBranchIds = $visit->users->pluck('branch_id')->toArray();
                if (array_intersect($modallyProfitIds, $visitBranchIds)) {
                    $this->createCommission($salary, $visit);
                }
                break;
            case ModallyProfitSalaryEnum::ALL:
                $this->createCommission($salary, $visit);
                break;
        }
    }

    private function handleCustomersProfit($salary, $visit)
    {
        $property = $visit->property;
        $customerCreatorId = $property->created_by;

        switch ($salary->modally_profit) {
            case ModallyProfitSalaryEnum::OWN:
                if ($salary->user_id == $customerCreatorId) {
                    if ($this->shouldCreateCommission($salary, $visit, $property)) {
                        $this->createCommission($salary, $visit);
                    }
                }
                break;
            case ModallyProfitSalaryEnum::USERS:
                $modallyProfitIds = json_decode($salary->modally_profit_ids, true);
                if (in_array($customerCreatorId, $modallyProfitIds)) {
                    if ($this->shouldCreateCommission($salary, $visit, $property)) {
                        $this->createCommission($salary, $visit);
                    }
                }
                break;
            case ModallyProfitSalaryEnum::BRANCHES:
                $modallyProfitIds = json_decode($salary->modally_profit_ids, true);

                if (in_array($property->branch_id, $modallyProfitIds)) {
                    if ($this->shouldCreateCommission($salary, $visit, $property)) {
                        $this->createCommission($salary, $visit);
                    }
                }
                break;
            case ModallyProfitSalaryEnum::ALL:
                if ($this->shouldCreateCommission($salary, $visit, $property)) {
                    $this->createCommission($salary, $visit);
                }
                break;
        }
    }

    private function shouldCreateCommission($salary, $visit, $property)
    {
        switch ($salary->modally_profit_counter) {
            case ModallyProfitCounterSalaryEnum::COUNT:
                $visitCount = Visit::where('property_id', $property->id)
                    ->where('status', 'completed')
                    ->where('inspect_visit', false)
                    ->count();
                return $visitCount <= $salary->modally_profit_quantity;
            case ModallyProfitCounterSalaryEnum::DAYS:
                $daysSinceCustomerCreated = Carbon::parse($visit->date)->diffInDays($property->created_at);
                return $daysSinceCustomerCreated <= $salary->modally_profit_quantity;
            case ModallyProfitCounterSalaryEnum::INFINITY:
                return true;
        }
        return false;
    }

    private function createCommission($salary, $visit)
    {
        $commissionAmount = $this->calculateCommissionAmount($salary, $visit);
        $taxAmount = $this->calculateTaxAmount($salary, $visit);
        $transportAmount = $this->calculateTransportAmount($salary, $visit);

        Commission::create([
            'visit_id' => $visit->id,
            'user_id' => $salary->user_id,
            'business_id' => $visit->business_id,
            'type_salary' => $salary->type,
            'amount' => $commissionAmount,
            'tax' => $taxAmount,
            'transport' => $transportAmount,
            'value' => $commissionAmount,
            'total' => $commissionAmount + $taxAmount + $transportAmount,
            // Otros campos necesarios
        ]);
    }



    private function calculateCommissionAmount($salary, $visit)
    {
        $baseAmount = $visit->price; 

        if($salary->type == 'percentage'){
            $commissionAmount = ($baseAmount * $$salary->type_value) / 100;
        }else{
            $commissionAmount = $salary->type_value;
        }

        return $commissionAmount;
    }

    private function calculateTaxAmount($salary, $visit)
    {
        $baseAmount = $visit->price; 

        if($salary->taxes == 'percentage'){
            $taxAmount = ($baseAmount * $salary->taxes_value) / 100;
        }elseif($salary->taxes == 'fixed'){
            $taxAmount = $salary->type_value;
        }else{
            $taxAmount = 0;
        }

        return $taxAmount;
    }

    private function calculateTransportAmount($salary, $visit)
    {
        $baseAmount = $visit->price; 

        if($salary->transport == 'percentage'){
            $transportAmount = ($baseAmount * $salary->transport_value) / 100;
        }else{
            $transportAmount = 0;
        }

        return $transportAmount;
    }
    
}
