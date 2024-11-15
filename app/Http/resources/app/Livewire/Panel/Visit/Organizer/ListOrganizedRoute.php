<?php

namespace App\Livewire\Panel\Visit\Organizer;

use App\Models\AutomaticRoute;
use App\Models\JobStatus;
use App\Models\User;
use Livewire\Component;

class ListOrganizedRoute extends Component
{
    public $routeDetails;
    public $routes;

    public function mount()
    {
        $this->refreshRoutes();
    }

    public function refreshRoutes()
    {
        // Refrescar las rutas para obtener el estado más reciente
        $this->routes = AutomaticRoute::select('id', 'start_date', 'end_date', 'selected_employees', 'user_id', 'route_saved', 'job_id', 'progress', 'status')->orderBy('created_at', 'desc')->with('creator')->get();
        // Para cada ruta, convertir los IDs de empleados a nombres
        foreach ($this->routes as $route) {
            // Obtener los nombres de los empleados
            $route->employee_names = $this->getEmployeeNamesFromIds($route->selected_employees);
        }
    }


    public function getEmployeeNamesFromIds($selectedEmployees)
    {
        $employeeIds = json_decode($selectedEmployees);
        $employees = User::whereIn('id', $employeeIds)->pluck('name');

        return $employees->toArray();
    }

    public function goToRouteOrganizer($idAutomaticRoute)
    {
        $route = AutomaticRoute::where('id', $idAutomaticRoute)->first();
        $this->redirectRoute('panel.routes.preview', ['routeId' => $route->id]);
    }

    public function render()
    {
        return view('livewire.panel.visit.organizer.list-organized-route', [
            'routes' => $this->routes
        ])->layout('layouts.panel', ['title' => 'Lista de rutas organizadas']);
    }
}
