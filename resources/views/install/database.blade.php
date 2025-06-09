@extends('install.layout')

@section('title', 'Configuración de Base de Datos')

@php $currentStep = 'database'; @endphp

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Configuración de Base de Datos</h2>
            <p class="mt-2 text-gray-600">
                Configura la conexión a tu base de datos. Probaremos la conexión antes de continuar.
            </p>
        </div>

        <form id="databaseForm" class="space-y-6">
            <div>
                <label for="db_connection" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo de Base de Datos
                </label>
                <select id="db_connection" name="db_connection" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="mysql">MySQL</option>
                    <option value="pgsql">PostgreSQL</option>
                    <option value="sqlite">SQLite</option>
                </select>
            </div>

            <div id="network-fields">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="db_host" class="block text-sm font-medium text-gray-700 mb-2">
                            Servidor (Host)
                        </label>
                        <input type="text" id="db_host" name="db_host" value="localhost" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="localhost">
                    </div>

                    <div>
                        <label for="db_port" class="block text-sm font-medium text-gray-700 mb-2">
                            Puerto
                        </label>
                        <input type="number" id="db_port" name="db_port" value="3306" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="3306">
                    </div>
                </div>

                <div>
                    <label for="db_username" class="block text-sm font-medium text-gray-700 mb-2">
                        Usuario
                    </label>
                    <input type="text" id="db_username" name="db_username" value="root" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="root">
                </div>

                <div>
                    <label for="db_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <input type="password" id="db_password" name="db_password" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Contraseña de la base de datos">
                </div>
            </div>

            <div>
                <label for="db_database" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de la Base de Datos
                </label>
                <input type="text" id="db_database" name="db_database" value="coach_app" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="coach_app">
                <p class="mt-1 text-sm text-gray-500">
                    La base de datos será creada automáticamente si no existe (solo MySQL y PostgreSQL)
                </p>
            </div>

            <div id="connection-status" class="hidden">
                <!-- Status will be shown here -->
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm">
                        <h4 class="font-medium text-blue-900">Información</h4>
                        <ul class="mt-1 text-blue-700 space-y-1">
                            <li>• Para <strong>MySQL</strong>: Usa puerto 3306 (por defecto)</li>
                            <li>• Para <strong>PostgreSQL</strong>: Usa puerto 5432 (por defecto)</li>
                            <li>• Para <strong>SQLite</strong>: Solo necesitas el nombre del archivo</li>
                        </ul>
                    </div>
                </div>
            </div>

            <button type="button" id="testConnectionBtn" 
                    class="w-full p-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center space-x-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Probar Conexión</span>
            </button>
        </form>

        <div class="flex items-center justify-between pt-6">
            <a href="{{ route('install.requirements') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Volver
            </a>
            
            <a href="{{ route('install.application') }}" id="continueBtn"
               class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 font-medium rounded-lg cursor-not-allowed transition-colors">
                <span>Prueba la conexión para continuar</span>
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <svg class="animate-spin h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-900 font-medium">Probando conexión...</span>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const connectionSelect = document.getElementById('db_connection');
    const networkFields = document.getElementById('network-fields');
    const portInput = document.getElementById('db_port');
    const testBtn = document.getElementById('testConnectionBtn');
    const continueBtn = document.getElementById('continueBtn');
    const statusDiv = document.getElementById('connection-status');
    
    let connectionTested = false;
    
    // Handle connection type change
    connectionSelect.addEventListener('change', function() {
        const isNetworkDb = this.value !== 'sqlite';
        networkFields.style.display = isNetworkDb ? 'block' : 'none';
        
        // Set default ports
        if (this.value === 'mysql') {
            portInput.value = '3306';
        } else if (this.value === 'pgsql') {
            portInput.value = '5432';
        }
        
        connectionTested = false;
        updateContinueButton();
    });
    
    // Test database connection
    testBtn.addEventListener('click', function() {
        const formData = new FormData();
        formData.append('db_connection', document.getElementById('db_connection').value);
        formData.append('db_host', document.getElementById('db_host').value);
        formData.append('db_port', document.getElementById('db_port').value);
        formData.append('db_database', document.getElementById('db_database').value);
        formData.append('db_username', document.getElementById('db_username').value);
        formData.append('db_password', document.getElementById('db_password').value);
        
        showLoading(true);
        statusDiv.classList.add('hidden');
        
        axios.post('{{ route("install.test-database") }}', formData)
            .then(function(response) {
                showLoading(false);
                connectionTested = response.data.success;
                showConnectionStatus(response.data.success, response.data.message);
                updateContinueButton();
                
                if (response.data.success) {
                    showAlert(response.data.message, 'success');
                    // Store connection data for next step
                    sessionStorage.setItem('db_config', JSON.stringify({
                        db_connection: document.getElementById('db_connection').value,
                        db_host: document.getElementById('db_host').value,
                        db_port: document.getElementById('db_port').value,
                        db_database: document.getElementById('db_database').value,
                        db_username: document.getElementById('db_username').value,
                        db_password: document.getElementById('db_password').value
                    }));
                }
            })
            .catch(function(error) {
                showLoading(false);
                connectionTested = false;
                const message = error.response?.data?.message || 'Error al probar la conexión';
                showConnectionStatus(false, message);
                updateContinueButton();
                showAlert(message, 'error');
            });
    });
    
    function showConnectionStatus(success, message) {
        statusDiv.innerHTML = `
            <div class="p-4 rounded-lg border ${success ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'}">
                <div class="flex items-center space-x-3">
                    <div class="h-6 w-6 rounded-full flex items-center justify-center ${success ? 'bg-green-500' : 'bg-red-500'}">
                        <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            ${success ? 
                                '<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>' :
                                '<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>'
                            }
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium ${success ? 'text-green-900' : 'text-red-900'}">
                            ${success ? 'Conexión Exitosa' : 'Error de Conexión'}
                        </h4>
                        <p class="text-sm ${success ? 'text-green-700' : 'text-red-700'}">${message}</p>
                    </div>
                </div>
            </div>
        `;
        statusDiv.classList.remove('hidden');
    }
    
    function updateContinueButton() {
        if (connectionTested) {
            continueBtn.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
            continueBtn.classList.add('bg-blue-600', 'hover:bg-blue-700', 'text-white');
            continueBtn.querySelector('span').textContent = 'Continuar';
        } else {
            continueBtn.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
            continueBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'text-white');
            continueBtn.querySelector('span').textContent = 'Prueba la conexión para continuar';
        }
    }
    
    // Prevent navigation if connection not tested
    continueBtn.addEventListener('click', function(e) {
        if (!connectionTested) {
            e.preventDefault();
            showAlert('Debes probar la conexión a la base de datos antes de continuar', 'warning');
        }
    });
});
</script>
@endpush 