<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WithBusiness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();


        // Verificar si el usuario no tiene un negocio
        if ($user->business === null) {
            // Redirigir a la creación de negocio si no tiene uno
            return redirect()->route('panel.first-steps.business');
        }


        // Verificar si el usuario intenta acceder a la ruta de creación de negocio y ya tiene uno
        if ($request->route()->getName() === 'first-steps.business' && $user->business !== null) {
            // Redirigir a una página diferente (por ejemplo, el panel principal) si ya tiene un negocio
            return redirect()->route('panel.first-steps.plan'); // Ajusta esta ruta según tu aplicación
        }

        return $next($request);
    }
}
