<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la Sesión') }}
            </h2>
            <div class="flex space-x-2">
                @can('update', $session)
                    <a href="{{ route('sessions.edit', $session) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>
                @endcan
                @can('create', App\Models\Commitment::class)
                    <a href="{{ route('commitments.create', ['session_id' => $session->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Nuevo Compromiso
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Detalles de la Sesión -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Información de la Sesión</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Fecha y Hora</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $session->date->format('d/m/Y') }} a las {{ $session->time->format('H:i') }}
                                </p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Coach</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $session->coach->name }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Coachee</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $session->coachee->name }}</p>
                            </div>
                        </div>

                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Modalidad</label>
                                <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($session->mode->value === 'virtual') bg-blue-100 text-blue-800
                                    @elseif($session->mode->value === 'in_person') bg-green-100 text-green-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    @if($session->mode->value === 'virtual') Virtual
                                    @elseif($session->mode->value === 'in_person') Presencial
                                    @else Teléfono @endif
                                </span>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Estado</label>
                                <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($session->status->value === 'completed') bg-green-100 text-green-800
                                    @elseif($session->status->value === 'scheduled') bg-blue-100 text-blue-800
                                    @elseif($session->status->value === 'rescheduled') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    @if($session->status->value === 'completed') Completada
                                    @elseif($session->status->value === 'scheduled') Programada
                                    @elseif($session->status->value === 'rescheduled') Reprogramada
                                    @else Cancelada @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($session->goals)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Objetivos</label>
                            <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $session->goals }}</p>
                        </div>
                    @endif

                    @if($session->notes)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Notas</label>
                            <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $session->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Compromisos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Compromisos</h3>
                        @can('create', App\Models\Commitment::class)
                            <a href="{{ route('commitments.create', ['session_id' => $session->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                Agregar Compromiso
                            </a>
                        @endcan
                    </div>

                    @if($session->commitments->count() > 0)
                        <div class="space-y-4">
                            @foreach($session->commitments as $commitment)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-medium text-gray-900">{{ $commitment->description }}</h4>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($commitment->status->value === 'fulfilled') bg-green-100 text-green-800
                                            @elseif($commitment->status->value === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            @if($commitment->status->value === 'fulfilled') Cumplido
                                            @elseif($commitment->status->value === 'pending') Pendiente
                                            @else No Cumplido @endif
                                        </span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 mb-2">
                                        <strong>Fecha límite:</strong> {{ $commitment->due_date->format('d/m/Y') }}
                                    </p>

                                    @if($commitment->evaluation_coach)
                                        <div class="mb-2">
                                            <p class="text-sm font-medium text-gray-700">Evaluación del Coach:</p>
                                            <p class="text-sm text-gray-600">{{ $commitment->evaluation_coach }}</p>
                                        </div>
                                    @endif

                                    @if($commitment->evaluation_coachee)
                                        <div class="mb-2">
                                            <p class="text-sm font-medium text-gray-700">Evaluación del Coachee:</p>
                                            <p class="text-sm text-gray-600">{{ $commitment->evaluation_coachee }}</p>
                                        </div>
                                    @endif

                                    <div class="flex space-x-2 mt-3">
                                        @can('view', $commitment)
                                            <a href="{{ route('commitments.show', $commitment) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Ver</a>
                                        @endcan
                                        @can('update', $commitment)
                                            <a href="{{ route('commitments.edit', $commitment) }}" class="text-blue-600 hover:text-blue-900 text-sm">Editar</a>
                                        @endcan
                                        @can('delete', $commitment)
                                            <form action="{{ route('commitments.destroy', $commitment) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este compromiso?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No hay compromisos registrados para esta sesión.</p>
                            @can('create', App\Models\Commitment::class)
                                <a href="{{ route('commitments.create', ['session_id' => $session->id]) }}" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Crear Primer Compromiso
                                </a>
                            @endcan
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('sessions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver a Sesiones
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 