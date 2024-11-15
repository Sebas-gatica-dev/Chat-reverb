<?php

namespace App\Enums;

use App\Enums\Forms\SectorTypeEnum;

enum StatusVisitEnum : string
{
    case PENDING = 'pending';
    case ONTHEWAY = 'ontheway';
    case ATTHEDOOR = 'atthedoor';
    case INPROGRESS = 'inprogress';
    case COMPLETED = 'completed';
    case RESCHEDULED = 'rescheduled';
    case CANCELLED = 'cancelled';
    case INCOMPLETE = 'incomplete';


    public static function getStatus($status): string
    {
        return match ($status) {
            self::PENDING => 'Pendiente', 
            self::ONTHEWAY => 'En camino',  // VAMOS A TENER QUE COMPLETAR EL CAMPO DE CUANTO TIEMPO TARDA EN LLEGAR (DATA/COMMENT), ENVIAMOS MAIL DE QUE ESTAMOS EN CAMINO y EL TIEMPO APROXIMADO EN LLEGAR (OPCIONAL LOS MINUTOS) EN CASO QUE HAYA FORMULARIOS DINAMICOS SE TIENE QUE CARGAR LA DATA)
            self::ATTHEDOOR => 'En la puerta', // ENVIAMOS MAIL DE QUE ESTA EN LA PUERTA (EN CASO QUE HAYA FORMULARIOS DINAMICOS SE TIENE QUE CARGAR LA DATA)
            self::INPROGRESS => 'En progreso', // SOLO SE MARCA QUE VA A ARRANCAR A TRABAJAR (Y EN CASO QUE HAYA FORMULARIOS DINAMICOS SE TIENE QUE CARGAR LA DATA)
            // VAMOS PODER CARGAR PRODUCTOS MIENTRAS ESTAMOS TRABAJANDO
            self::COMPLETED => 'Completada', // Listamos los productos cargados se pueden editar o eliminar y podemos cargar alguno mas, una vez finalizado (le dio save) nos fijamos si  se edito alguno, hacemos el cambio en el history, si se elimino, volvemos a sumarle las unidades etc, como si hace un retroceso. EN CASO QUE HAYA FORMULARIOS DINAMICOS SE TIENE QUE CARGAR LA DATA) ENVIAMOS MAIL--- AGREGAR COMENTARIO/ RESUMEN etc que se agrega a los comentarios de la visita -- PREGUNTAMOS SI QUIERE INICIAR DIRECTAMENTE LA PROXIMA VISITA EN CASO QUE TENGA UNA PROXIMA VISITA
            self::RESCHEDULED => 'Reprogramada', // ESTO SE PUEDE HACER UNICAMENTE EN "PENDIENTE, EN CAMINO, EN LA PUERTA" SE LLENA EL DATA/COMMENT (SELECT DE QUE ESTADO QUIERO CAMBIARLO) QUE PASO?  (Y EN CASO QUE HAYA FORMULARIOS DINAMICOS SE TIENE QUE CARGAR LA DATA) ENVIAMOS MAIL
            self::CANCELLED => 'Cancelada', // ESTO SE PUEDE HACER UNICAMENTE EN "PENDIENTE, EN CAMINO, EN LA PUERTA" SE LLENA EL DATA/COMMENT  (Y EN CASO QUE HAYA FORMULARIOS DINAMICOS SE TIENE QUE CARGAR LA DATA) ENVIAMOS MAIL 
            self::INCOMPLETE => 'Incompleta', // ESTO SE PUEDE HACER UNICAMENTE EN "EN PROGRESO" SE LLENA EL DATA/COMMENT  (Y EN CASO QUE HAYA FORMULARIOS DINAMICOS SE TIENE QUE CARGAR LA DATA)
            default => 'Desconocido',
        };
    }

    public function getName(): ?string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::ONTHEWAY => 'OnTheWay',
            self::ATTHEDOOR => 'AtTheDoor',
            self::INPROGRESS => 'InProgress',
            self::COMPLETED => 'Completed',
            self::RESCHEDULED => 'Rescheduled',
            self::CANCELLED => 'Cancelled',
            self::INCOMPLETE => 'Incomplete',
        };
    }






    public function getSector(): ?SectorTypeEnum
    {
        return match($this) {
            self::PENDING => SectorTypeEnum::VisitEnRoute,
            self::ONTHEWAY => SectorTypeEnum::VisitAtDoor,
            self::ATTHEDOOR => SectorTypeEnum::VisitWorkInProgress,
            self::INPROGRESS => SectorTypeEnum::VisitWorkCompletion,
            self::CANCELLED => SectorTypeEnum::VisitCancellation,
            self::RESCHEDULED => SectorTypeEnum::VisitReschedule,
            self::INCOMPLETE => SectorTypeEnum::VisitIncomplete,
        };
    }


    public static function getSectorName(string $sector): ?self
    {
        return match($sector) {
            
            'visit_en_route' => self::ONTHEWAY,
            'visit_at_door' => self::ATTHEDOOR,
            'visit_work_in_progress' => self::INPROGRESS,
            'visit_work_completion' => self::COMPLETED,
            'visit_cancellation' => self::CANCELLED,
            'visit_reschedule' => self::RESCHEDULED,
            'visit_incomplete' => self::INCOMPLETE,
            default => null,
        };
    }



    public function getStatusClasses(){

        return match ($this) {
            self::PENDING => 'text-blue-500',
            self::ONTHEWAY => 'text-yellow-500',
            self::ATTHEDOOR => 'text-amber-500',
            self::INPROGRESS => 'text-green-500',
            self::COMPLETED => 'text-indigo-500',
            self::RESCHEDULED => 'text-red-500',
            self::CANCELLED => 'text-red-500',
            self::INCOMPLETE => 'text-red-500',
        };


    }








    public function getBgClasses(){

        return match ($this) {
            self::PENDING => 'bg-blue-100',
            self::ONTHEWAY => 'bg-yellow-100',
            self::ATTHEDOOR => 'bg-amber-100',
            self::INPROGRESS => 'bg-green-100',
            self::COMPLETED => 'bg-indigo-100',
            self::RESCHEDULED => 'bg-red-100',
            self::CANCELLED => 'bg-red-100',
            self::INCOMPLETE => 'bg-red-100',
        };
        
    }





    public function getTextClasses(): ?string
    {

        return match ($this) {
            self::PENDING => 'text-blue-700',
            self::ONTHEWAY => 'text-yellow-800',
            self::ATTHEDOOR => 'text-amber-700',
            self::INPROGRESS => 'text-green-700',
            self::COMPLETED => 'text-indigo-700',
            self::RESCHEDULED => 'text-red-700',
            self::CANCELLED => 'text-red-700',
            self::INCOMPLETE => 'text-red-700',

        };
    }


    public function getFillClasses(): ?string
    {

        return match ($this) {
            
            self::PENDING => 'fill-blue-500',
            self::ONTHEWAY => 'fill-yellow-500',
            self::ATTHEDOOR => 'fill-amber-500',
            self::INPROGRESS => 'fill-green-500',
            self::COMPLETED => 'fill-indigo-500',
            self::RESCHEDULED => 'fill-red-500',
            self::CANCELLED => 'fill-red-500',
            self::INCOMPLETE => 'fill-red-500',


        };
    }

    public function getColorRingClasses(): ?string
    {

        return match ($this) {

            self::PENDING => 'ring-blue-700',
            self::ONTHEWAY => 'ring-yellow-700',
            self::ATTHEDOOR => 'ring-amber-700',
            self::INPROGRESS => 'ring-green-700',
            self::COMPLETED => 'ring-indigo-700',
            self::RESCHEDULED => 'ring-red-700',
            self::CANCELLED => 'ring-red-700',
            self::INCOMPLETE => 'ring-red-700',

        };
    }



    public function getColorsBullet(){

        return match ($this) {
            self::PENDING => 'bg-blue-600/10',
            self::ONTHEWAY => 'bg-yellow-500/10',
            self::ATTHEDOOR => 'bg-amber-600/10',
            self::INPROGRESS => 'bg-green-600/10',
            self::COMPLETED => 'bg-indigo-600/10',
            self::RESCHEDULED => 'bg-red-600/10',
            self::CANCELLED => 'bg-red-600/10',
            self::INCOMPLETE => 'bg-red-600/10',

        };

    }











    
}


