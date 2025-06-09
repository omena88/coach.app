<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Panel de Progreso') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('coachees.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuevo Coachee
                </a>
                <a href="{{ route('sessions.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Nueva Sesión
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(Auth::user()->isAdmin())
                <!-- Estadísticas de Administración -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg mb-8">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold">Panel de Administración</h3>
                                <p class="text-blue-100">Gestión general del sistema</p>
                            </div>
                            <a href="{{ route('coaches.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                                Ver Coaches
                            </a>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold">{{ $adminStats['total_coaches'] ?? 0 }}</div>
                                <div class="text-sm text-blue-100">Total Coaches</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">{{ $adminStats['total_all_coachees'] ?? 0 }}</div>
                                <div class="text-sm text-blue-100">Total Coachees</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">{{ $adminStats['total_all_sessions'] ?? 0 }}</div>
                                <div class="text-sm text-blue-100">Total Sesiones</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">{{ $adminStats['coaches_with_coachees'] ?? 0 }}</div>
                                <div class="text-sm text-blue-100">Coaches Activos</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Estadísticas Principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                
                <!-- Total de Coachees -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800">{{ $totalCoachees }}</div>
                                <div class="text-sm font-medium text-purple-600">Coachees</div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Mis Coachees</h3>
                        <p class="text-sm text-gray-600">Personas que acompaño</p>
                    </div>
                </div>

                <!-- Total de Sesiones -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800">{{ $totalSessions }}</div>
                                <div class="text-sm font-medium text-blue-600">Sesiones</div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Total Sesiones</h3>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                            @php $completionRate = $totalSessions > 0 ? ($completedSessions / $totalSessions) * 100 : 0; @endphp
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" style="width: {{ $completionRate }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">{{ number_format($completionRate, 1) }}% completadas</p>
                    </div>
                </div>

                <!-- Sesiones Completadas -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800">{{ $completedSessions }}</div>
                                <div class="text-sm font-medium text-green-600">Completadas</div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Sesiones Exitosas</h3>
                        <p class="text-sm text-gray-600">Con resultados medibles</p>
                    </div>
                </div>

                <!-- Compromisos Vencidos -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800">{{ $overdueCommitments }}</div>
                                <div class="text-sm font-medium text-red-600">Vencidos</div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Compromisos Vencidos</h3>
                        <p class="text-sm text-gray-600">Requieren seguimiento</p>
                    </div>
                </div>
            </div>

            <!-- Secciones Principales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Próximas Sesiones -->
                <div class="bg-white rounded-lg shadow-lg border border-gray-200">
                    <div class="bg-slate-800 px-6 py-4 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-white">Próximas Sesiones</h3>
                                <p class="text-gray-300 text-sm">Agenda programada</p>
                            </div>
                            <div class="w-10 h-10 bg-slate-700 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($upcomingSessions->count() > 0)
                            <div class="space-y-4">
                                @foreach($upcomingSessions as $session)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-300 border border-gray-200">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $session->coachee->name }}</p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $session->date->format('d/m/Y') }} a las {{ $session->time->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ route('sessions.show', $session) }}" class="w-8 h-8 bg-purple-600 hover:bg-purple-700 text-white rounded-lg flex items-center justify-center transition-all duration-200 shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('sessions.index') }}" class="inline-flex items-center px-6 py-3 bg-slate-800 text-white font-semibold rounded-lg hover:bg-slate-900 transition-all duration-300 shadow-lg">
                                    Ver todas las sesiones
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No hay sesiones programadas</h4>
                                <p class="text-gray-500">Programa una nueva sesión</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Compromisos Pendientes -->
                <div class="bg-white rounded-lg shadow-lg border border-gray-200">
                    <div class="bg-yellow-600 px-6 py-4 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-white">Compromisos Pendientes</h3>
                                <p class="text-yellow-100 text-sm">Requieren seguimiento</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-700 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($pendingCommitments->count() > 0)
                            <div class="space-y-4">
                                @foreach($pendingCommitments as $commitment)
                                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-all duration-300">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <p class="font-semibold text-gray-800 mb-1">
                                                    {{ Str::limit($commitment->description, 60) }}
                                                </p>
                                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                    <span class="font-medium">{{ $commitment->session->coachee->name }}</span>
                                                    <span>•</span>
                                                    <span>Vence: {{ $commitment->due_date->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <a href="{{ route('commitments.show', $commitment) }}" class="w-8 h-8 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg flex items-center justify-center transition-all duration-200 shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                        @if($commitment->due_date->isPast())
                                            <div class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                VENCIDO
                                            </div>
                                        @else
                                            <div class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                PENDIENTE
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('commitments.index') }}" class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 shadow-lg">
                                    Ver todos los compromisos
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No hay compromisos pendientes</h4>
                                <p class="text-gray-500">Todos los compromisos están al día</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 