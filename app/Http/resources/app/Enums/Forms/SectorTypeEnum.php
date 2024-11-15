<?php

namespace App\Enums\Forms;

enum SectorTypeEnum: string 
{
    // Definición de los tipos "padre" sin hijos
    case VisitCreate = 'visit_add';
    case Customner = 'customer';

    // Definición de un tipo "padre" con hijos
    case StatusOfVisit = 'status_visit';

    // Hijos de StatusOfVisit
    case VisitEnRoute = 'visit_en_route';
    case VisitAtDoor = 'visit_at_door';
    case VisitWorkInProgress = 'visit_work_in_progress';
    case VisitWorkCompletion = 'visit_work_completion';
    case VisitCancellation = 'visit_cancellation';
    case VisitReschedule = 'visit_reschedule';
    case VisitIncomplete = 'visit_incomplete';

    /**
     * Devuelve el nombre descriptivo de cada sector.
     */
    public function getName(): string
    {
        return match ($this) {
            self::VisitCreate => 'Añadir visita',
            self::StatusOfVisit => 'Estado de la visita',
            self::VisitEnRoute => 'Visita en ruta',
            self::VisitAtDoor => 'Visita en la puerta',
            self::VisitWorkInProgress => 'Trabajo en progreso',
            self::VisitWorkCompletion => 'Finalización del trabajo',
            self::VisitCancellation => 'Cancelación de la visita',
            self::VisitReschedule => 'Reprogramación de la visita',
            self::VisitIncomplete => 'Visita incompleta',
            self::Customner => 'Cliente',
        };
    }

    /**
     * Devuelve los hijos de un tipo "padre", si tiene.
     */
    public  function getSubCategories(): array
    {
        return match ($this) {
            self::StatusOfVisit => [
                self::VisitEnRoute,
                self::VisitAtDoor,
                self::VisitWorkInProgress,
                self::VisitWorkCompletion,
                self::VisitCancellation,
                self::VisitReschedule,
                self::VisitIncomplete,
            ],
            default => [],
        };
    }

    /**
     * Verifica si un sector tiene hijos (subcategorías).
     */
    public function hasSubCategories(): bool
    {
        return !empty($this->getSubCategories());
    }

    /**
     * Obtiene solo los tipos "padre" (con o sin hijos).
     */
    public static function getParentTypes(): array
    {
        $subCategories = [];
        foreach (self::cases() as $type) {
            if ($type->hasSubCategories()) {
                $subCategories = array_merge($subCategories, $type->getSubCategories());
            }
        }

        $parents = [];
        foreach (self::cases() as $type) {
            // Incluimos solo los "padres" que no son subcategorías
            if (!in_array($type, $subCategories)) {
                $parents[$type->value] = $type->getName();
            }
        }

        return $parents;
    }
}