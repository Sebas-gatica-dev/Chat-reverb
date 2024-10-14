<?php

namespace App\Livewire\Panel\Visit\Organizer;

use App\Jobs\OrganizerVisits;
use App\Models\AutomaticRoute;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

use function Laravel\Prompts\select;

class TotalOrganizer extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    public $availabilityOperatorVisits = [];
    public $selectedUnAssignedVisits = []; // Para almacenar las visitas no asignadas seleccionadas
    public $selectedAssignedVisits = [];  // Para almacenar las visitas asignadas seleccionadas
    public $selectAllAssignedVisits = false;
    public $selectAllUnAssignedVisits = false;
    public $selectedDate;
    public $travelTimeCache = [];
    public $employees;
    public $startDate;
    public $endDate;
    public $selectedUser;
    public $tempSelectedEmployees;
    public $currentTab = 'unassigned'; // Puede ser 'unassigned' o 'assigned'
    public $selectedEmployees = [];
    public $searchEmployees;
    public $selectedResults;
    public $employeesWithVisits = [];
    public $employeesWithUnAssignedVisits = [];
    public $perPage = 20; // Número de elementos por página
    public $organizedVisits;
    public $unorganizedVisits;

    public function initProcessOrganizations()
    {
        $this->validate([
            'selectedAssignedVisits' => 'required_without:selectedUnAssignedVisits',
            'selectedUnAssignedVisits' => 'required_without:selectedAssignedVisits',
        ], [
            'selectedAssignedVisits.required_without' =>  'Al menos debe seleccionar una visita.',
            'selectedUnAssignedVisits.required_without' => 'Al menos debe seleccionar una visita.'
        ]);

        $mergedVisits[] = array_merge($this->selectedAssignedVisits, $this->selectedUnAssignedVisits);

        // Obtenemos los IDs de las visitas seleccionadas
        $mergedVisitIds = isset($mergedVisits[0]) ? $mergedVisits[0] : [];

        // Función para filtrar las visitas de un operario
        $this->employeesWithVisits = $this->filterVisits($this->employeesWithVisits, $mergedVisitIds);

        // Filtramos $this->employeesWithUnAssignedVisits
        $this->employeesWithUnAssignedVisits = $this->filterVisits($this->employeesWithUnAssignedVisits, $mergedVisitIds);

        // Combinar y reindexar las visitas
        $finalMergedEmployees = $this->mergeAndReindexVisits($this->employeesWithVisits, $this->employeesWithUnAssignedVisits);

        // OrganizerVisits::dispatch($finalMergedEmployees, $this->startDate, $this->endDate, $this->selectedEmployees, $mergedVisitIds, auth()->user()->business->id, auth()->user()->id);
        $automaticRoute = $this->initialAutomaticRoute($mergedVisitIds);

        // Crea el Job y despáchalo
        $job = new OrganizerVisits($finalMergedEmployees, $this->startDate, $this->endDate, $automaticRoute);

        // Despachar el Job y obtener el ID
        dispatch($job);

        $this->redirect(ListOrganizedRoute::class, true);
        //$this->redirectRoute('routes.organizer.list', true, true);
    }


    private function initialAutomaticRoute($mergedVisitIds)
    {
        $automaticRoute = AutomaticRoute::create([
            'start_date' => $this->startDate, // Fecha de inicio
            'end_date' => $this->endDate, // Fecha de fin
            'selected_visits' => json_encode($mergedVisitIds), // JSON con las visitas seleccionadas
            'selected_employees' => json_encode($this->selectedEmployees), // JSON con los empleados seleccionados
            'business_id' => auth()->user()->business->id, // ID del negocio asociado
            'user_id' =>  auth()->user()->id, // ID del usuario que creó la ruta
        ]);

        return $automaticRoute;
    }

    private function filterVisits($employeesWithVisits, $mergedVisitIds)
    {
        foreach ($employeesWithVisits as $employeeName => $employeeData) {
            // Filtrar las visitas del empleado
            $employeesWithVisits[$employeeName]['visits'] = array_filter($employeeData['visits'], function ($visit) use ($mergedVisitIds) {
                // Retornamos solo las visitas cuyo ID esté en el array mergedVisitIds
                return in_array($visit['id'], $mergedVisitIds);
            });
        }

        return $employeesWithVisits;
    }


    private  function mergeAndReindexVisits($employeesWithVisits, $employeesWithUnAssignedVisits)
    {
        $finalArray = [];

        // Iteramos sobre ambos arrays
        foreach ($employeesWithVisits as $employeeName => $employeeData) {
            // Si el operario existe también en el array de visitas sin asignar
            if (isset($employeesWithUnAssignedVisits[$employeeName])) {
                // Obtenemos las visitas asignadas y no asignadas
                $assignedVisits = $employeeData['visits'];
                $unassignedVisits = $employeesWithUnAssignedVisits[$employeeName]['visits'];

                // Hacemos un merge de visitas asignadas y no asignadas
                $mergedVisits = array_merge($assignedVisits, $unassignedVisits);

                // Eliminamos duplicados usando el 'id' como clave única
                $uniqueVisits = [];
                foreach ($mergedVisits as $visit) {
                    $uniqueVisits[$visit['id']] = $visit;
                }

                // Reindexamos los valores
                $finalArray[$employeeName] = $employeeData;
                $finalArray[$employeeName]['visits'] = array_values($uniqueVisits); // Reindexamos las visitas
            } else {
                // Si no hay visitas sin asignar, simplemente copiamos las asignadas
                $finalArray[$employeeName] = $employeeData;
            }
        }

        // También manejamos operarios que solo tienen visitas sin asignar
        foreach ($employeesWithUnAssignedVisits as $employeeName => $employeeData) {
            if (!isset($employeesWithVisits[$employeeName])) {
                // Si el operario no estaba en el array de visitas asignadas, lo agregamos tal cual
                $finalArray[$employeeName] = $employeeData;
            }
        }

        return $finalArray;
    }

    public function mount()
    {
        $this->employees = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        });

        // Establece las fechas por defecto a los próximos 7 días
        $this->startDate = Carbon::today()->addDay()->format('Y-m-d'); // Inicializar la fecha seleccionada al día siguiente;
        $this->endDate = Carbon::today()->addDays(7)->format('Y-m-d'); // Próximos 7 días
        $this->selectedDate = $this->startDate;
    }

    #[On('set-date-range')]
    public function setDateRange($start, $end)
    {
        $this->startDate = $start;
        $this->endDate = $end;
    }

    private function canWorkInVisit($visit, $operator)
    {
        // Obtener las availabilities de la visita y la propiedad
        $availabilities = $visit->availabilities->isNotEmpty()
            ? $visit->availabilities
            : $visit->property->availabilities;

        // Si hay availabilities específicas, verificar contra las del operario
        if ($availabilities->isNotEmpty()) {
            return $this->checkAvailability($availabilities, $operator);
        }

        // Si no hay disponibilidad específica, se asume que puede trabajar
        return true;
    }


    private function checkAvailability($availabilities, $operator)
    {
        // Agrupar availabilities del operario por día para acceso rápido
        $operatorAvailabilityByDay = $operator->availabilities->keyBy('day.name');

        foreach ($availabilities as $availability) {
            $day = $availability->day->name;
            $visitStart = $availability->start;
            $visitEnd = $availability->end;

            // Obtener disponibilidad del operario para el día actual
            $operatorAvailability = $operatorAvailabilityByDay->get($day);

            if ($operatorAvailability) {
                // Comparar los tiempos de disponibilidad
                if ($visitStart < $operatorAvailability->end && $visitEnd > $operatorAvailability->start) {
                    return true; // Hay superposición en los horarios
                }
            }
        }

        return false; // No hay superposición en los horarios
    }


    //Es del segundo paso
    public function selectDate($fecha)
    {
        $this->selectedDate = $fecha;
    }

    #[On('update-selected-value-users')]
    public function updateSelectedUser($value)
    {
        if ($value) {
            $this->selectedUser = $value['id'];
        } else {
            $this->selectedUser = null;
        }
    }

    #[On('update-selected-values-employees')]
    public function receiveSelectedEmployees($value)
    {
        if ($value) {
            // Almacenar temporalmente los valores seleccionados
            $this->tempSelectedEmployees = array_column($value, 'id');
        } else {
            $this->tempSelectedEmployees = [];
        }

        // Resetea los valores seleccionados si es necesario
        if (!$this->selectAllAssignedVisits) {
            $this->selectedAssignedVisits = [];
        }
        if (!$this->selectAllUnAssignedVisits) {
            $this->selectedUnAssignedVisits = [];
        }
    }

    public function confirmSelection()
    {
        if (!empty($this->tempSelectedEmployees)) {
            // Guardamos los empleados seleccionados temporalmente y cargamos sus availabilities
            $this->selectedEmployees = $this->tempSelectedEmployees;
            $this->selectedResults = User::whereIn('id', $this->selectedEmployees)->with('availabilities')->get();

            // Inicializamos las estructuras de datos para visitas asignadas y no asignadas
            $this->employeesWithVisits = [];
            $this->employeesWithUnAssignedVisits = [];

            foreach ($this->selectedResults as $employee) {
                $availability = $employee->availabilities->map(function ($availability) {
                    return [
                        'day' => $availability->day,
                        'start' => $availability->start,
                        'end' => $availability->end
                    ];
                })->toArray();

                // Estructuras para empleados con visitas asignadas y no asignadas
                $this->employeesWithVisits[$employee->id] = [
                    'name' => $employee->name,
                    'start_lat' => $employee->start_lat,
                    'start_lng' => $employee->start_lng,
                    'availability' => $availability,
                    'visits' => []
                ];

                $this->employeesWithUnAssignedVisits[$employee->id] = [
                    'name' => $employee->name,
                    'start_lat' => $employee->start_lat,
                    'start_lng' => $employee->start_lng,
                    'availability' => $availability,
                    'visits' => []
                ];
            }

            // Consultar visitas asignadas y no asignadas
            $queryAssignedVisits = Visit::where('business_id', auth()->user()->business_id)
                ->with('users', 'customer', 'property', 'availabilities', 'property.availabilities')
                ->whereNotNull('date')
                ->whereNotNull('time')
                ->whereHas('users')
                ->take(500)
                ->get();

            $queryUnassignedVisits = Visit::where('business_id', auth()->user()->business_id)
                ->with('users', 'customer', 'property')
                ->whereAny([
                    'date',
                    'time',
                ], null)
                ->orWhereDoesntHave('users')
                ->get();

            // Lógica para filtrar visitas y asignarlas a empleados
            $queryAssignedVisits = $this->filterVisitsByEmployee($queryAssignedVisits, 'assigned');
            $queryUnassignedVisits = $this->filterVisitsByEmployee($queryUnassignedVisits, 'unassigned');

            // Guardar las visitas organizadas y no organizadas
            $this->organizedVisits = $queryAssignedVisits;
            $this->unorganizedVisits = $queryUnassignedVisits;

            // Limpiar las visitas cacheadas
            unset($this->unAssignedVisits);
            unset($this->assignedVisits);
        }
    }

    private function filterVisitsByEmployee($visits, $type)
    {
        return $visits->filter(function ($visit) use ($type) {
            $visitAssigned = false; // Para marcar si la visita debe permanecer en la lista

            foreach ($this->selectedResults as $employee) {
                $property = $visit->property;

                if ($employee->worksInZone($property) && $this->canWorkInVisit($visit, $employee)) {
                    $availabilities = $visit->availabilities->isNotEmpty()
                        ? $visit->availabilities
                        : $visit->property->availabilities;

                    $availabilityPropertyOrVisit = $availabilities->isNotEmpty()
                        ? $availabilities->map(function ($availability) {
                            return [
                                'day' => $availability->day,
                                'start' => $availability->start,
                                'end' => $availability->end
                            ];
                        })->toArray()
                        : null;

                    // Asignamos la visita según el tipo (asignadas o no asignadas)
                    if ($type === 'assigned') {
                        $this->employeesWithVisits[$employee->id]['visits'][] = [
                            'id' => $visit->id,
                            'latitud' => $property->latitude,
                            'longitude' => $property->longitude,
                            'availability' => $availabilityPropertyOrVisit,
                            'duration_time' => $visit->duration_time
                        ];
                    } elseif ($type === 'unassigned') {
                        $this->employeesWithUnAssignedVisits[$employee->id]['visits'][] = [
                            'id' => $visit->id,
                            'latitud' => $property->latitude,
                            'longitude' => $property->longitude,
                            'availability' => $availabilityPropertyOrVisit,
                            'duration_time' => $visit->duration_time
                        ];
                    }

                    // Si el empleado puede realizar la visita, la marcamos como asignada
                    $visitAssigned = true;
                }
            }

            // Devolvemos true para mantener la visita si al menos un empleado puede realizarla
            return $visitAssigned;
        });
    }

    #[On('update-search-employees')]
    public function searchEmployees($search)
    {

        $this->searchEmployees = $search;

        $this->employees = auth()->user()->business->users()
            ->when($this->searchEmployees, function ($query) {
                $query->where('name', 'like', '%' . $this->searchEmployees . '%');
            })->get()->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                ];
            });

        $this->dispatch('update-values-employees', $this->employees);
    }

    public function confirmDeSelectedUnAssignedVisits()
    {
        $this->selectedUnAssignedVisits = [];
        $this->selectAllUnAssignedVisits = false;
    }



    public function confirmDeSelectedAssignedVisits()
    {
        $this->selectedAssignedVisits = [];
        $this->selectAllAssignedVisits = false;
    }

    public function updatedSelectAllAssignedVisits($value)
    {
        if ($value) {
            $this->selectedAssignedVisits = $this->organizedVisits->pluck('id')->toArray();
        } else {
            $this->selectedAssignedVisits = [];
        }
    }


    public function updatedSelectAllUnAssignedVisits($value)
    {
        if ($value) {
            $this->selectedUnAssignedVisits = $this->unorganizedVisits->pluck('id')->toArray();
        } else {
            $this->selectedUnAssignedVisits = [];
        }
    }



    #[Computed(persist: true, seconds: 100)]
    public function assignedVisits()
    {
        if ($this->organizedVisits) {
            $filteredVisitIds = $this->organizedVisits->pluck('id');
            $queryAssignedVisits = Visit::whereIn('id', $filteredVisitIds)->with('property', 'customer', 'users')->paginate($this->perPage, pageName: 'query-assigned-visits');

            if ($this->selectAllAssignedVisits) {
                $this->selectedAssignedVisits = $filteredVisitIds->toArray();
            }
            return $queryAssignedVisits;
        }
    }


    #[Computed(persist: true)]
    public function unAssignedVisits()
    {
        if ($this->unorganizedVisits) {
            $filteredVisitIdsUnassigned = $this->unorganizedVisits->pluck('id');

            $queryUnassignedVisits = Visit::whereIn('id', $filteredVisitIdsUnassigned)->with('property', 'customer', 'users')->paginate($this->perPage, pageName: 'query-unassigned-visits');

            if ($this->selectAllUnAssignedVisits) {
                $this->selectedUnAssignedVisits = $filteredVisitIdsUnassigned->toArray();
            }
            return $queryUnassignedVisits;
        }
    }

    public function updatingQueryAssignedVisits()
    {
        unset($this->assignedVisits);
    }

    public function updatingQueryUnassignedVisits()
    {
        unset($this->unAssignedVisits);
    }

    public function changeSelectAll()
    {
        if (count($this->selectedAssignedVisits) != $this->organizedVisits->count()) {
            $this->selectAllAssignedVisits = false;
        } else {
            // Si quieres alguna otra lógica para activar/desactivar selectAllAssignedVisits
            $this->selectAllAssignedVisits = true;
        }

        if (count($this->selectedUnAssignedVisits) != $this->unorganizedVisits->count()) {
            $this->selectAllUnAssignedVisits = false;
        } else {
            // Si quieres alguna otra lógica para activar/desactivar selectAllAssignedVisits
            $this->selectAllUnAssignedVisits = true;
        }
    }

    public function render()
    {
        return view('livewire.panel.visit.organizer.total-organizer')
            ->layout('layouts.panel', ['title' => 'Organizador de visitas']);
    }
}
