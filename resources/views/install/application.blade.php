@extends('install.layout')

@section('title', 'Configuración de Aplicación')

@php $currentStep = 'application'; @endphp

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Configuración de la Aplicación</h2>
            <p class="mt-2 text-gray-600">
                Configura los datos básicos de tu aplicación Coach.App
            </p>
        </div>

        <form id="applicationForm" class="space-y-6">
            <div>
                <label for="app_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de la Aplicación
                </label>
                <input type="text" id="app_name" name="app_name" value="Coach.App" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Coach.App" required>
                <p class="mt-1 text-sm text-gray-500">
                    Este nombre aparecerá en el título de la aplicación y emails
                </p>
            </div>

            <div>
                <label for="app_url" class="block text-sm font-medium text-gray-700 mb-2">
                    URL de la Aplicación
                </label>
                <input type="url" id="app_url" name="app_url" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="https://tu-dominio.com" required>
                <p class="mt-1 text-sm text-gray-500">
                    La URL completa donde estará disponible tu aplicación
                </p>
            </div>

            <div>
                <label for="app_env" class="block text-sm font-medium text-gray-700 mb-2">
                    Entorno de la Aplicación
                </label>
                <select id="app_env" name="app_env" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="production">Producción (Recomendado)</option>
                    <option value="local">Desarrollo/Local</option>
                </select>
                <p class="mt-1 text-sm text-gray-500">
                    Selecciona "Producción" para uso en vivo, "Desarrollo" solo para pruebas
                </p>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-start space-x-3">
                    <svg class="h-6 w-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-medium text-blue-900 mb-2">Configuraciones Automáticas</h4>
                        <div class="text-sm text-blue-700 space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span><strong>APP_KEY:</strong> Se generará automáticamente para seguridad</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span><strong>Idioma:</strong> Español (es) por defecto</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span><strong>Zona Horaria:</strong> América/Lima</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span><strong>Cache y Sesiones:</strong> Configuradas para producción</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="h-5 w-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div class="text-sm">
                        <h4 class="font-medium text-yellow-900">Importante</h4>
                        <p class="text-yellow-700">
                            Asegúrate de que la URL sea correcta, ya que se usará para generar enlaces en emails y notificaciones.
                        </p>
                    </div>
                </div>
            </div>
        </form>

        <div class="flex items-center justify-between pt-6">
            <a href="{{ route('install.database') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Volver
            </a>
            
            <a href="{{ route('install.email') }}" id="continueBtn"
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                Continuar
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const continueBtn = document.getElementById('continueBtn');
    const form = document.getElementById('applicationForm');
    
    // Auto-detect current URL for app_url field
    const appUrlInput = document.getElementById('app_url');
    if (!appUrlInput.value) {
        const currentUrl = window.location.origin;
        appUrlInput.value = currentUrl;
    }
    
    // Store app config when continuing
    continueBtn.addEventListener('click', function(e) {
        const formData = new FormData(form);
        const isValid = form.checkValidity();
        
        if (!isValid) {
            e.preventDefault();
            form.reportValidity();
            showAlert('Por favor completa todos los campos requeridos', 'warning');
            return;
        }
        
        // Store app config for final installation
        sessionStorage.setItem('app_config', JSON.stringify({
            app_name: formData.get('app_name'),
            app_url: formData.get('app_url'),
            app_env: formData.get('app_env')
        }));
    });
    
    // Validate URL format
    const urlInput = document.getElementById('app_url');
    urlInput.addEventListener('blur', function() {
        const url = this.value;
        if (url && !url.match(/^https?:\/\/.+/)) {
            this.setCustomValidity('La URL debe comenzar con http:// o https://');
            this.reportValidity();
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>
@endpush 