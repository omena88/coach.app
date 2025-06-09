<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class InstallationMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si la aplicación ya está instalada, redirigir al login
        if ($this->isInstalled()) {
            return redirect('/login')->with('error', 'La aplicación ya está instalada.');
        }

        return $next($request);
    }

    /**
     * Verificar si la aplicación está instalada
     */
    private function isInstalled(): bool
    {
        return File::exists(base_path('.installed'));
    }
} 