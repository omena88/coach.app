<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del Compromiso') }}
            </h2>
            @can('update', $commitment)
                <a href="{{ route('commitments.edit', $commitment) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                                <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $commitment->description }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Fecha Límite</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $commitment->due_date->format('d/m/Y') }}
                                    @if($commitment->due_date->isPast() && $commitment->status->value === 'pending')
                                        <span class="ml-2 text-red-500 text-xs font-medium">Vencido</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Estado</label>
                                <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($commitment->status->value === 'fulfilled') bg-green-100 text-green-800
                                    @elseif($commitment->status->value === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    @if($commitment->status->value === 'fulfilled') Cumplido
                                    @elseif($commitment->status->value === 'pending') Pendiente
                                    @else No Cumplido @endif
                                </span>
                            </div>
                        </div>

                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Sesión Relacionada</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    <p class="font-medium">{{ $commitment->session->date->format('d/m/Y') }} a las {{ $commitment->session->time->format('H:i') }}</p>
                                    <p class="text-gray-600">Coach: {{ $commitment->session->coach->name }}</p>
                                    <p class="text-gray-600">Coachee: {{ $commitment->session->coachee->name }}</p>
                                    <a href="{{ route('sessions.show', $commitment->session) }}" class="text-blue-600 hover:text-blue-900 text-sm">Ver sesión completa</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($commitment->evaluation_coach)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Evaluación del Coach</label>
                            <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $commitment->evaluation_coach }}</p>
                        </div>
                    @endif

                    @if($commitment->evaluation_coachee)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Evaluación del Coachee</label>
                            <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $commitment->evaluation_coachee }}</p>
                        </div>
                    @endif

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('sessions.show', $commitment->session) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Volver a la Sesión
                        </a>
                        <a href="{{ route('commitments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Ver Todos los Compromisos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 