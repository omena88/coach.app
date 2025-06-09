<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotInstalled
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si la aplicación no está instalada, redirigir al instalador
        if (!$this->isInstalled() && !$request->is('install/*') && !$request->is('install')) {
            return redirect('/install');
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