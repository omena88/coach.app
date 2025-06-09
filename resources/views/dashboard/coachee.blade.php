<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Progreso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Gráficos de Compromisos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Compromisos Cumplidos -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800">{{ $fulfilledCommitments }}</div>
                                <div class="text-sm font-medium text-green-600">Cumplidos</div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Compromisos Cumplidos</h3>
                        <p class="text-sm text-gray-600">¡Excelente trabajo!</p>
                        @php
                            $total = $fulfilledCommitments + $pendingCommitments + $overdueCommitments;
                            $percentage = $total > 0 ? ($fulfilledCommitments / $total) * 100 : 0;
                        @endphp
                        <div class="mt-4 w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-green-600 h-3 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">{{ number_format($percentage, 1) }}% del total</p>
                    </div>
                </div>

                <!-- Compromisos Pendientes -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800">{{ $pendingCommitments - $overdueCommitments }}</div>
                                <div class="text-sm font-medium text-yellow-600">A tiempo</div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Compromisos Pendientes</h3>
                        <p class="text-sm text-gray-600">Mantén el ritmo</p>
                        @php
                            $pendingOnTime = $pendingCommitments - $overdueCommitments;
                            $pendingPercentage = $total > 0 ? ($pendingOnTime / $total) * 100 : 0;
                        @endphp
                        <div class="mt-4 w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-yellow-600 h-3 rounded-full transition-all duration-500" style="width: {{ $pendingPercentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">{{ number_format($pendingPercentage, 1) }}% del total</p>
                    </div>
                </div>

                <!-- Compromisos Retrasados -->
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
                                <div class="text-sm font-medium text-red-600">Retrasados</div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Compromisos Retrasados</h3>
                        <p class="text-sm text-gray-600">Requieren atención</p>
                        @php
                            $overduePercentage = $total > 0 ? ($overdueCommitments / $total) * 100 : 0;
                        @endphp
                        <div class="mt-4 w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-red-600 h-3 rounded-full transition-all duration-500" style="width: {{ $overduePercentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">{{ number_format($overduePercentage, 1) }}% del total</p>
                    </div>
                </div>
            </div>

            <!-- Resumen Rápido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Resumen de Sesiones -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        Resumen de Sesiones
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-purple-50 rounded-lg border border-purple-100">
                            <div class="text-2xl font-bold text-purple-600">{{ $totalSessions }}</div>
                            <div class="text-sm text-purple-600">Total</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg border border-green-100">
                            <div class="text-2xl font-bold text-green-600">{{ $completedSessions }}</div>
                            <div class="text-sm text-green-600">Completadas</div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico Circular de Compromisos -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        Estado General
                    </h3>
                    @if($total > 0)
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gray-800 mb-2">{{ number_format(($fulfilledCommitments / $total) * 100, 1) }}%</div>
                            <div class="text-sm text-gray-600 mb-4">Tasa de cumplimiento</div>
                            <div class="flex justify-center space-x-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-600 rounded-full mr-1"></div>
                                    <span class="text-xs text-gray-600">Cumplidos</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-600 rounded-full mr-1"></div>
                                    <span class="text-xs text-gray-600">Pendientes</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-red-600 rounded-full mr-1"></div>
                                    <span class="text-xs text-gray-600">Retrasados</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-500">Aún no tienes compromisos</div>
                        </div>
                    @endif
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
                                <p class="text-gray-300 text-sm">Tu agenda de coaching</p>
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
                                                <p class="font-semibold text-gray-800">{{ $session->coach->name }}</p>
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
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No tienes sesiones programadas</h4>
                                <p class="text-gray-500">Tu coach programará las próximas sesiones</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Compromisos Recientes -->
                <div class="bg-white rounded-lg shadow-lg border border-gray-200">
                    <div class="bg-yellow-600 px-6 py-4 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-white">Compromisos Pendientes</h3>
                                <p class="text-yellow-100 text-sm">Por completar</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-700 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($recentCommitments->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentCommitments as $commitment)
                                    <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-300 border border-gray-200">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <p class="font-semibold text-gray-800 mb-1">
                                                    {{ Str::limit($commitment->description, 60) }}
                                                </p>
                                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                    <span class="font-medium">{{ $commitment->session->coach->name }}</span>
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
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No tienes compromisos pendientes</h4>
                                <p class="text-gray-500">¡Excelente trabajo!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 