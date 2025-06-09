@extends('install.layout')

@section('title', 'Bienvenida')

@php $currentStep = 'welcome'; @endphp

@section('content')
    <div class="text-center space-y-6">
        <div class="space-y-4">
            <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-blue-100">
                <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold text-gray-900">¡Bienvenido al Instalador de Coach.App!</h2>
            
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Este asistente te guiará paso a paso para configurar tu aplicación de gestión de sesiones de coaching.
                En unos minutos tendrás tu sistema completamente funcional.
            </p>
        </div>

        <div class="bg-gray-50 rounded-xl p-6 max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">¿Qué haremos durante la instalación?</h3>
            
            <div class="grid md:grid-cols-2 gap-4 text-left">
                <div class="flex items-start space-x-3">
                    <div class="h-6 w-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Verificar Requisitos</h4>
                        <p class="text-sm text-gray-600">Comprobaremos que tu servidor cumple todos los requisitos</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="h-6 w-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Configurar Base de Datos</h4>
                        <p class="text-sm text-gray-600">Configuraremos la conexión a tu base de datos</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="h-6 w-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Configurar Aplicación</h4>
                        <p class="text-sm text-gray-600">Estableceremos la configuración básica de tu aplicación</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="h-6 w-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Crear Administrador</h4>
                        <p class="text-sm text-gray-600">Crearemos tu cuenta de administrador principal</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 rounded-xl p-6 max-w-2xl mx-auto">
            <div class="flex items-center space-x-3">
                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-left">
                    <h4 class="font-medium text-blue-900">Información Importante</h4>
                    <p class="text-sm text-blue-700">
                        Este proceso tomará aproximadamente 5 minutos. Asegúrate de tener a mano los datos de tu base de datos.
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-6">
            <a href="{{ route('install.requirements') }}" 
               class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                <span>Comenzar Instalación</span>
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
@endsection 