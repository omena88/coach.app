<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Instalador') - Coach.App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .progress-step.active {
            background: #10b981;
            color: white;
        }
        .progress-step.completed {
            background: #059669;
            color: white;
        }
        .progress-step {
            background: #e5e7eb;
            color: #6b7280;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-20 w-20 flex items-center justify-center rounded-full bg-white/20 backdrop-blur-sm">
                    <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h1 class="mt-4 text-4xl font-bold text-white">Coach.App</h1>
                <p class="mt-2 text-lg text-white/80">Instalador de Aplicación</p>
            </div>

            <!-- Progress Steps -->
            <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    @php
                        $steps = [
                            'welcome' => 'Bienvenida',
                            'requirements' => 'Requisitos',
                            'database' => 'Base de Datos',
                            'application' => 'Aplicación',
                            'email' => 'Email',
                            'admin' => 'Administrador',
                            'complete' => 'Completado'
                        ];
                        $currentStep = $currentStep ?? 'welcome';
                        $stepKeys = array_keys($steps);
                        $currentIndex = array_search($currentStep, $stepKeys);
                    @endphp
                    
                    @foreach($steps as $key => $label)
                        @php
                            $stepIndex = array_search($key, $stepKeys);
                            $isActive = $stepIndex === $currentIndex;
                            $isCompleted = $stepIndex < $currentIndex;
                        @endphp
                        
                        <div class="flex items-center {{ !$loop->last ? 'flex-1' : '' }}">
                            <div class="progress-step {{ $isActive ? 'active' : ($isCompleted ? 'completed' : '') }} h-10 w-10 rounded-full flex items-center justify-center text-sm font-medium transition-all duration-300">
                                @if($isCompleted)
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    {{ $stepIndex + 1 }}
                                @endif
                            </div>
                            
                            @if(!$loop->last)
                                <div class="flex-1 h-1 mx-4 bg-gray-200 rounded">
                                    <div class="h-1 bg-green-500 rounded transition-all duration-300 {{ $isCompleted ? 'w-full' : 'w-0' }}"></div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4 flex justify-between text-sm text-gray-600">
                    @foreach($steps as $key => $label)
                        <div class="flex-1 text-center">
                            <span class="hidden sm:inline">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Main Content -->
            <div class="glass-card rounded-2xl p-8">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-white/60 text-sm">
                    Coach.App © {{ date('Y') }} - Sistema de Gestión de Sesiones de Coaching
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Configurar axios para CSRF
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Funciones globales para el instalador
        window.showAlert = function(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 
                type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
            } text-white`;
            alertDiv.textContent = message;
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        };
        
        window.showLoading = function(show = true) {
            const loading = document.getElementById('loading');
            if (loading) {
                loading.style.display = show ? 'flex' : 'none';
            }
        };
    </script>
    
    @stack('scripts')
</body>
</html> 