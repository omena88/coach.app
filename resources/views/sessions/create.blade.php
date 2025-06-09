<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Sesión de Coaching') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('sessions.store') }}">
                        @csrf

                        @if(Auth::user()->isAdmin())
                            <!-- Coach -->
                            <div class="mb-4">
                                <label for="coach_id" class="block text-sm font-medium text-gray-700">Coach</label>
                                <select id="coach_id" name="coach_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Seleccionar Coach</option>
                                    @foreach($coaches as $coach)
                                        <option value="{{ $coach->id }}" {{ old('coach_id') == $coach->id ? 'selected' : '' }}>
                                            {{ $coach->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('coach_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" name="coach_id" value="{{ Auth::user()->id }}">
                        @endif

                        <!-- Coachee -->
                        <div class="mb-4">
                            <label for="coachee_id" class="block text-sm font-medium text-gray-700">Coachee</label>
                            <select id="coachee_id" name="coachee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar Coachee</option>
                                @foreach($coachees as $coachee)
                                    <option value="{{ $coachee->id }}" {{ old('coachee_id') == $coachee->id ? 'selected' : '' }}>
                                        {{ $coachee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('coachee_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                            <input type="date" id="date" name="date" value="{{ old('date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hora -->
                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700">Hora</label>
                            <input type="time" id="time" name="time" value="{{ old('time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Modalidad -->
                        <div class="mb-4">
                            <label for="mode" class="block text-sm font-medium text-gray-700">Modalidad</label>
                            <select id="mode" name="mode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar Modalidad</option>
                                @foreach($modes as $mode)
                                    <option value="{{ $mode->value }}" {{ old('mode') == $mode->value ? 'selected' : '' }}>
                                        @if($mode->value === 'virtual') Virtual
                                        @elseif($mode->value === 'in_person') Presencial
                                        @else Teléfono @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('mode')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->value }}" {{ old('status', 'scheduled') == $status->value ? 'selected' : '' }}>
                                        @if($status->value === 'completed') Completada
                                        @elseif($status->value === 'scheduled') Programada
                                        @elseif($status->value === 'rescheduled') Reprogramada
                                        @else Cancelada @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Objetivos -->
                        <div class="mb-4">
                            <label for="goals" class="block text-sm font-medium text-gray-700">Objetivos</label>
                            <textarea id="goals" name="goals" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Describe los objetivos de esta sesión...">{{ old('goals') }}</textarea>
                            @error('goals')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notas -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notas</label>
                            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Notas adicionales...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('sessions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear Sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 