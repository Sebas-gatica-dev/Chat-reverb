<?php

namespace App\Models;

use App\Enums\Units\UnitDownActionReasonTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Stmt\Switch_;
use Symfony\Component\Translation\LocaleSwitcher;
use App\Enums\Units\UnitsHistoryTypeEnum;


class UnitHistory extends Model
{
    /** @use HasFactory<\Database\Factories\UnitsHistoryFactory> */
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'type' => UnitsHistoryTypeEnum::class,
        'reason_action' => UnitDownActionReasonTypeEnum::class,

    ];


    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function product()
    {
        return $this->unit->product();
    }

    // Relación polimórfica para el "desde" (origen)
    public function originable()
    {
        return $this->morphTo(__FUNCTION__, 'originable_type', 'originable_id');
    }

    // Relación polimórfica para el "hasta" (destino)
    public function destinationable()
    {
        return $this->morphTo(__FUNCTION__, 'destinationable_type', 'destinationable_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    


    public function getDescription()
    {

        $description = '';
        // dd($this->type);

        switch ($this->type->value) {
           
            case UnitsHistoryTypeEnum::Alta->value:
                $description = "La unidad fue dada de alta por " . $this->createdBy->name  . " en la fecha " . ($this->created_at->format('d/m/Y') ?? 'N/A') . ".";
                break;
            case UnitsHistoryTypeEnum::Baja->value:
                $description = "La unidad fue dada de baja por " . ($this->createdBy->name ?? 'N/A') . ".";
                break;
            case UnitsHistoryTypeEnum::Carga->value:
                $description = "La unidad fue cargada con " . ($this->initial_quantity ?? 'N/A') . " unidades.";
                break;
            case UnitsHistoryTypeEnum::TransferToWarehouse->value:
            case UnitsHistoryTypeEnum::TransferToWorker->value:
                $description = "La unidad fue transferida desde el " . $this->getNameModel($this->originable) . " al " . $this->getNameModel($this->destinationable) . ".";
                break;
            case UnitsHistoryTypeEnum::TransferToOtherUnit->value:
                // dd($this->originable->tag);
                // $description = "Se transfirieron " . $this->quantity . " de la unidad "  . $this->originable->tag  . " a la unidad " . ($this->destinationable->tag ?? 'N/A') . ".";
                $description = $this->getTranferToUnitMeessage();
                break;
            case UnitsHistoryTypeEnum::Uso->value:
                $description = "La unidad está siendo utilizada por " . ($this->createdBy->name ?? 'N/A') . ".";
                break;
            case UnitsHistoryTypeEnum::Agotado->value:
                $description = "La unidad se agotó después de usar " . ($this->final_quantity ?? 'N/A') . " unidades.";
                break;
            case UnitsHistoryTypeEnum::Caduco->value:
                $description = "La unidad caducó el " . ($this->updated_at->format('d/m/Y') ?? 'N/A') . ".";
                break;
            case UnitsHistoryTypeEnum::ReceiveTransfer->value:
                $description = "La unidad recibió una transferencia de " . ($this->originable->name ?? 'N/A') . ".";
                break;
            default:
                $description = "Información adicional no disponible.";
                break;
        }

        // dd($description);

        return $description;
    }


    public function getNameModel($type)
    {

        switch ($type) {
            case $type instanceof Warehouse:
                return 'depósito <a href="' . route('panel.settings.stock.warehouse.edit', $type->id) . '">' . $type->name . '</a>';
                break;
            case $type instanceof User:
                return 'operario <a href="' . route('panel.users.show', $type->id) . '">' . $type->name . '</a>';
                break;

            default:
                return 'modelo';
        }
    }



    // public function getTranferToUnitMeessage()
    // {
    //     $dinamicOriginableRoute = 'panel.stock.';
    //     $dinamicDestinationableRoute = 'panel.stock.';

    //     return 'Se transfirieron ' . $this->quantity . ' de la unidad <a href="'  . $this->originable->tag . '">' . '</a>  a la unidad <a href="' . '' . '">' . ($this->destinationable->tag ?? 'N/A') . '</a>.';
    // }

    public function getTranferToUnitMeessage()
{

    // Asumiendo que $this->originable y $this->destinationable contienen los modelos necesarios
    $originableRoute = route('panel.stock.inventory-list', [
        'product' => $this->originable->product->id, 
        'search' => $this->originable->tag
    ]);

    $destinationableRoute = route('panel.stock.inventory-list', [
        'product' => $this->destinationable->product->id, 
        'search' => $this->destinationable->tag
    ]);

    return 'Se transfirieron ' . $this->quantity . ' de la unidad <a href="' . $originableRoute . '">' . $this->originable->tag . '</a> a la unidad <a href="' . $destinationableRoute . '">' . ($this->destinationable->tag ?? 'N/A') . '</a>.';
}




/**
 * Este método `getReasonActionDescriptionAttribute` sirve para obtener una descripción más detallada de la razón por la cual una unidad fue dada de baja.
 * 
 * Si la razón de baja (`reason_action`) es "Otro", entonces devuelve la descripción personalizada que se haya escrito.
 * 
 * Si no, usa un método estático `getDownActionReason` del enum `UnitDownActionReasonTypeEnum` para obtener una descripción predefinida basada en el valor de `reason_action`.
 */
public function getReasonActionDescriptionAttribute()
{
    
    if ($this->reason_action === UnitDownActionReasonTypeEnum::Otro) {
        return $this->description;
    }

    // dd($this->reason_action);

    return UnitDownActionReasonTypeEnum::getDownActionReason($this->reason_action->value);
}


   /**
     * Método para obtener el texto correspondiente al tipo de historial de unidad.
     */
    public function getStatus()
    {
        return UnitsHistoryTypeEnum::getStatus($this->type->value);
    }

}
