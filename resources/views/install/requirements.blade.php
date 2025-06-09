@extends('install.layout')

@section('title', 'Verificación de Requisitos')

@php $currentStep = 'requirements'; @endphp

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Verificación de Requisitos del Sistema</h2>
            <p class="mt-2 text-gray-600">
                Verificamos que tu servidor cumple con todos los requisitos necesarios para ejecutar Coach.App
            </p>
        </div>

        <div class="space-y-4">
            @php
                $allPassed = true;
            @endphp
            
            @foreach($requirements as $key => $requirement)
                @php
                    if (!$requirement['status']) $allPassed = false;
                @endphp
                
                <div class="flex items-center justify-between p-4 rounded-lg border {{ $requirement['status'] ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                    <div class="flex items-center space-x-3">
                        <div class="h-8 w-8 rounded-full flex items-center justify-center {{ $requirement['status'] ? 'bg-green-500' : 'bg-red-500' }}">
                            @if($requirement['status'])
                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                        
                        <div>
                            <h3 class="font-medium {{ $requirement['status'] ? 'text-green-900' : 'text-red-900' }}">
                                {{ $requirement['name'] }}
                            </h3>
                            <p class="text-sm {{ $requirement['status'] ? 'text-green-700' : 'text-red-700' }}">
                                Estado actual: {{ $requirement['current'] }}
                            </p>
                        </div>
                    </div>
                    
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $requirement['status'] ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $requirement['status'] ? 'Cumple' : 'Error' }}
                    </span>
                </div>
            @endforeach
        </div>

        @if(!$allPassed)
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <div class="flex items-start space-x-3">
                    <svg class="h-6 w-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div>
                        <h3 class="font-medium text-red-900">Requisitos No Cumplidos</h3>
                        <p class="mt-1 text-red-700">
                            Algunos requisitos del sistema no se cumplen. Por favor, contacta a tu proveedor de hosting 
                            o administrador del servidor para resolver estos problemas antes de continuar.
                        </p>
                        <div class="mt-3">
                            <h4 class="font-medium text-red-900">Soluciones comunes:</h4>
                            <ul class="mt-1 text-sm text-red-700 list-disc list-inside space-y-1">
                                <li>Para extensiones PHP: contacta a tu hosting para habilitarlas</li>
                                <li>Para permisos de escritura: ejecuta <code class="bg-red-100 px-1 rounded">chmod 755 storage bootstrap/cache</code></li>
                                <li>Para versión de PHP: solicita actualización a PHP 8.2+</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="font-medium text-green-900">¡Excelente! Todos los requisitos se cumplen</h3>
                        <p class="text-green-700">Tu servidor está listo para ejecutar Coach.App. Puedes continuar con la instalación.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-center justify-between pt-6">
            <a href="{{ route('install.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Volver
            </a>
            
            @if($allPassed)
                <a href="{{ route('install.database') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    Continuar
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            @else
                <button disabled 
                        class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 font-medium rounded-lg cursor-not-allowed">
                    Corrige los errores para continuar
                </button>
            @endif
        </div>
    </div>
@endsection 