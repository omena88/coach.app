@extends('install.layout')

@section('title', 'Crear Administrador')

@php $currentStep = 'admin'; @endphp

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Crear Usuario Administrador</h2>
            <p class="mt-2 text-gray-600">
                Crea tu cuenta de administrador principal para gestionar el sistema
            </p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-start space-x-3">
                <svg class="h-6 w-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <div>
                    <h4 class="font-medium text-blue-900 mb-2">Permisos del Administrador</h4>
                    <div class="text-sm text-blue-700 space-y-1">
                        <p>• <strong>Acceso completo</strong> a todas las funcionalidades</p>
                        <p>• <strong>Gestión de usuarios</strong> (coaches y coachees)</p>
                        <p>• <strong>Configuración del sistema</strong></p>
                        <p>• <strong>Reportes y estadísticas</strong></p>
                        <p>• <strong>Administración de sesiones</strong> y compromisos</p>
                    </div>
                </div>
            </div>
        </div>

        <form id="adminForm" class="space-y-6">
            <div>
                <label for="admin_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre Completo *
                </label>
                <input type="text" id="admin_name" name="admin_name" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Tu nombre completo" required>
            </div>

            <div>
                <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email *
                </label>
                <input type="email" id="admin_email" name="admin_email" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="admin@tu-dominio.com" required>
                <p class="mt-1 text-sm text-gray-500">
                    Este email se usará para iniciar sesión y recuperar contraseña
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="admin_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña *
                    </label>
                    <input type="password" id="admin_password" name="admin_password" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Mínimo 8 caracteres" required minlength="8">
                </div>

                <div>
                    <label for="admin_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirmar Contraseña *
                    </label>
                    <input type="password" id="admin_password_confirmation" name="admin_password_confirmation" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Confirma tu contraseña" required minlength="8">
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="h-5 w-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div class="text-sm">
                        <h4 class="font-medium text-yellow-900">Recomendaciones de Seguridad</h4>
                        <ul class="mt-1 text-yellow-700 space-y-1">
                            <li>• Usa una contraseña fuerte con al menos 8 caracteres</li>
                            <li>• Incluye mayúsculas, minúsculas, números y símbolos</li>
                            <li>• No uses información personal obvia</li>
                            <li>• Guarda estas credenciales en un lugar seguro</li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>

        <div class="flex items-center justify-between pt-6">
            <a href="{{ route('install.email') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Volver
            </a>
            
            <button type="button" id="installBtn"
                    class="inline-flex items-center px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span>Instalar Coach.App</span>
            </button>
        </div>
    </div>

    <!-- Installation Modal -->
    <div id="installModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <div id="install-progress">
                    <svg class="animate-spin h-12 w-12 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mt-4">Instalando Coach.App</h3>
                    <p id="install-status" class="text-gray-600 mt-2">Preparando instalación...</p>
                </div>
                
                <div id="install-success" class="hidden">
                    <svg class="h-16 w-16 text-green-500 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-green-900 mt-4">¡Instalación Completada!</h3>
                    <p class="text-green-700 mt-2">Coach.App se ha instalado correctamente</p>
                    <button id="goToApp" class="mt-6 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                        Ir a la Aplicación
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('adminForm');
    const installBtn = document.getElementById('installBtn');
    const modal = document.getElementById('installModal');
    
    installBtn.addEventListener('click', function() {
        const isValid = form.checkValidity();
        
        if (!isValid) {
            form.reportValidity();
            return;
        }
        
        // Check password match
        const password = document.getElementById('admin_password').value;
        const confirmPassword = document.getElementById('admin_password_confirmation').value;
        
        if (password !== confirmPassword) {
            showAlert('Las contraseñas no coinciden', 'error');
            return;
        }
        
        startInstallation();
    });
    
    function startInstallation() {
        modal.classList.remove('hidden');
        
        const installData = {
            ...JSON.parse(sessionStorage.getItem('db_config') || '{}'),
            ...JSON.parse(sessionStorage.getItem('app_config') || '{}'),
            ...JSON.parse(sessionStorage.getItem('email_config') || '{}'),
            admin_name: document.getElementById('admin_name').value,
            admin_email: document.getElementById('admin_email').value,
            admin_password: document.getElementById('admin_password').value,
            admin_password_confirmation: document.getElementById('admin_password_confirmation').value
        };
        
        axios.post('{{ route("install.process") }}', installData)
            .then(function(response) {
                if (response.data.success) {
                    document.getElementById('install-progress').classList.add('hidden');
                    document.getElementById('install-success').classList.remove('hidden');
                    sessionStorage.clear();
                    
                    document.getElementById('goToApp').addEventListener('click', function() {
                        window.location.href = response.data.redirect || '/login';
                    });
                }
            })
            .catch(function(error) {
                const message = error.response?.data?.message || 'Error en la instalación';
                showAlert(message, 'error');
                modal.classList.add('hidden');
            });
    }
});
</script>
@endpush 