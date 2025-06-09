<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Compromiso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('commitments.update', $commitment) }}">
                        @csrf
                        @method('PUT')

                        <!-- Sesión -->
                        <div class="mb-4">
                            <label for="session_id" class="block text-sm font-medium text-gray-700">Sesión</label>
                            <select id="session_id" name="session_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar Sesión</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}" {{ old('session_id', $commitment->session_id) == $session->id ? 'selected' : '' }}>
                                        {{ $session->date->format('d/m/Y') }} - {{ $session->coach->name }} → {{ $session->coachee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('session_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Describe el compromiso..." required>{{ old('description', $commitment->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha Límite -->
                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Fecha Límite</label>
                            <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $commitment->due_date->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('due_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->value }}" {{ old('status', $commitment->status->value) == $status->value ? 'selected' : '' }}>
                                        @if($status->value === 'fulfilled') Cumplido
                                        @elseif($status->value === 'pending') Pendiente
                                        @else No Cumplido @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Evaluación del Coach -->
                        <div class="mb-4">
                            <label for="evaluation_coach" class="block text-sm font-medium text-gray-700">Evaluación del Coach</label>
                            <textarea id="evaluation_coach" name="evaluation_coach" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Evaluación del coach sobre el compromiso...">{{ old('evaluation_coach', $commitment->evaluation_coach) }}</textarea>
                            @error('evaluation_coach')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Evaluación del Coachee -->
                        <div class="mb-6">
                            <label for="evaluation_coachee" class="block text-sm font-medium text-gray-700">Evaluación del Coachee</label>
                            <textarea id="evaluation_coachee" name="evaluation_coachee" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Evaluación del coachee sobre el compromiso...">{{ old('evaluation_coachee', $commitment->evaluation_coachee) }}</textarea>
                            @error('evaluation_coachee')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('commitments.show', $commitment) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar Compromiso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 