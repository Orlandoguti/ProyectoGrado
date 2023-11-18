<?php

namespace App\Http\Middleware;

use Closure;

class Personal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario tiene el rol de "Trabajador"
        if ($request->user() && $request->user()->hasRole('3')) {
            return $next($request);
        }

        // Si el usuario no tiene el rol de "Trabajador", redirigir o mostrar un mensaje de acceso denegado
        return redirect('/')->with('error', 'Acceso denegado. No tienes permiso para acceder a esta página.');
    }
}
