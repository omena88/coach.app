@extends('install.layout')

@section('title', 'Configuración de Email')

@php $currentStep = 'email'; @endphp

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Configuración de Email</h2>
            <p class="mt-2 text-gray-600">
                Configura el envío de emails (opcional). Puedes saltarte este paso y configurarlo más tarde.
            </p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start space-x-3">
                <svg class="h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm">
                    <h4 class="font-medium text-blue-900">¿Para qué se usa el email?</h4>
                    <ul class="mt-1 text-blue-700 space-y-1">
                        <li>• Notificaciones de nuevas sesiones programadas</li>
                        <li>• Recordatorios de compromisos pendientes</li>
                        <li>• Recuperación de contraseñas</li>
                        <li>• Notificaciones del sistema</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <input type="checkbox" id="enableEmail" name="enable_email" 
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="enableEmail" class="text-sm font-medium text-gray-900">
                    Configurar email ahora
                </label>
            </div>
            <span class="text-xs text-gray-500">Opcional - puedes configurarlo después</span>
        </div>

        <form id="emailForm" class="space-y-6 hidden">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="mail_mailer" class="block text-sm font-medium text-gray-700 mb-2">
                        Servicio de Email
                    </label>
                    <select id="mail_mailer" name="mail_mailer" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="smtp">SMTP</option>
                        <option value="mailgun">Mailgun</option>
                        <option value="ses">Amazon SES</option>
                        <option value="sendmail">Sendmail</option>
                    </select>
                </div>

                <div>
                    <label for="mail_host" class="block text-sm font-medium text-gray-700 mb-2">
                        Servidor SMTP
                    </label>
                    <input type="text" id="mail_host" name="mail_host" value="smtp.gmail.com" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="smtp.gmail.com">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="mail_port" class="block text-sm font-medium text-gray-700 mb-2">
                        Puerto
                    </label>
                    <input type="number" id="mail_port" name="mail_port" value="587" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="587">
                </div>

                <div>
                    <label for="mail_encryption" class="block text-sm font-medium text-gray-700 mb-2">
                        Encriptación
                    </label>
                    <select id="mail_encryption" name="mail_encryption" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="tls">TLS (Recomendado)</option>
                        <option value="ssl">SSL</option>
                        <option value="">Sin encriptación</option>
                    </select>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="mail_username" class="block text-sm font-medium text-gray-700 mb-2">
                        Usuario/Email
                    </label>
                    <input type="email" id="mail_username" name="mail_username" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="tu-email@gmail.com">
                </div>

                <div>
                    <label for="mail_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <input type="password" id="mail_password" name="mail_password" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Contraseña o App Password">
                </div>
            </div>

            <div>
                <label for="mail_from_address" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Remitente
                </label>
                <input type="email" id="mail_from_address" name="mail_from_address" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="noreply@tu-dominio.com">
                <p class="mt-1 text-sm text-gray-500">
                    Email que aparecerá como remitente en las notificaciones
                </p>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="h-5 w-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div class="text-sm">
                        <h4 class="font-medium text-yellow-900">Configuración para Gmail</h4>
                        <div class="mt-1 text-yellow-700 space-y-1">
                            <p>• Servidor: smtp.gmail.com, Puerto: 587, Encriptación: TLS</p>
                            <p>• Usa tu email de Gmail como usuario</p>
                            <p>• <strong>Importante:</strong> Usa "App Password" en lugar de tu contraseña normal</p>
                            <p>• Generar App Password: <a href="https://myaccount.google.com/apppasswords" target="_blank" class="underline">Google Account Settings</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="testEmailBtn" 
                    class="w-full p-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center space-x-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Enviar Email de Prueba</span>
            </button>

            <div id="email-status" class="hidden">
                <!-- Status will be shown here -->
            </div>
        </form>

        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="h-5 w-5 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm">
                    <h4 class="font-medium text-gray-900">Si decides no configurar email ahora</h4>
                    <p class="text-gray-600 mt-1">
                        Podrás configurarlo más tarde desde el panel de administración en: 
                        <span class="font-mono text-gray-800">Configuración > Email</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-6">
            <a href="{{ route('install.application') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Volver
            </a>
            
            <a href="{{ route('install.admin') }}" id="continueBtn"
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
    const enableEmailCheckbox = document.getElementById('enableEmail');
    const emailForm = document.getElementById('emailForm');
    const continueBtn = document.getElementById('continueBtn');
    const testEmailBtn = document.getElementById('testEmailBtn');
    const statusDiv = document.getElementById('email-status');
    
    // Toggle email form visibility
    enableEmailCheckbox.addEventListener('change', function() {
        if (this.checked) {
            emailForm.classList.remove('hidden');
        } else {
            emailForm.classList.add('hidden');
        }
    });
    
    // Auto-fill from address based on username
    const usernameInput = document.getElementById('mail_username');
    const fromAddressInput = document.getElementById('mail_from_address');
    
    usernameInput.addEventListener('blur', function() {
        if (this.value && !fromAddressInput.value) {
            fromAddressInput.value = this.value;
        }
    });
    
    // Test email functionality (placeholder - would need backend implementation)
    testEmailBtn.addEventListener('click', function() {
        showAlert('Función de prueba de email estará disponible después de la instalación', 'info');
    });
    
    // Store email config when continuing
    continueBtn.addEventListener('click', function(e) {
        if (enableEmailCheckbox.checked) {
            const emailConfig = {
                mail_mailer: document.getElementById('mail_mailer').value,
                mail_host: document.getElementById('mail_host').value,
                mail_port: document.getElementById('mail_port').value,
                mail_username: document.getElementById('mail_username').value,
                mail_password: document.getElementById('mail_password').value,
                mail_encryption: document.getElementById('mail_encryption').value,
                mail_from_address: document.getElementById('mail_from_address').value
            };
            
            // Basic validation if email is enabled
            if (!emailConfig.mail_host || !emailConfig.mail_username) {
                e.preventDefault();
                showAlert('Por favor completa los campos de email requeridos', 'warning');
                return;
            }
            
            sessionStorage.setItem('email_config', JSON.stringify(emailConfig));
        } else {
            sessionStorage.removeItem('email_config');
        }
    });
    
    // Set default values based on service selection
    const mailerSelect = document.getElementById('mail_mailer');
    const hostInput = document.getElementById('mail_host');
    const portInput = document.getElementById('mail_port');
    const encryptionSelect = document.getElementById('mail_encryption');
    
    mailerSelect.addEventListener('change', function() {
        switch(this.value) {
            case 'smtp':
                hostInput.value = 'smtp.gmail.com';
                portInput.value = '587';
                encryptionSelect.value = 'tls';
                break;
            case 'mailgun':
                hostInput.value = 'smtp.mailgun.org';
                portInput.value = '587';
                encryptionSelect.value = 'tls';
                break;
            case 'ses':
                hostInput.value = 'email-smtp.us-east-1.amazonaws.com';
                portInput.value = '587';
                encryptionSelect.value = 'tls';
                break;
        }
    });
});
</script>
@endpush 