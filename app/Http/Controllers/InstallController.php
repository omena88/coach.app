<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\UserRole;
use Exception;

class InstallController extends Controller
{
    /**
     * Mostrar página principal del instalador
     */
    public function index()
    {
        if ($this->isInstalled()) {
            return redirect('/login')->with('error', 'La aplicación ya está instalada.');
        }

        return view('install.welcome');
    }

    /**
     * Paso 1: Verificación de requisitos
     */
    public function requirements()
    {
        if ($this->isInstalled()) {
            return redirect('/login');
        }

        $requirements = $this->checkRequirements();
        
        return view('install.requirements', compact('requirements'));
    }

    /**
     * Paso 2: Configuración de base de datos
     */
    public function database()
    {
        if ($this->isInstalled()) {
            return redirect('/login');
        }

        return view('install.database');
    }

    /**
     * Verificar conexión a base de datos (AJAX)
     */
    public function testDatabase(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'db_connection' => 'required|in:mysql,pgsql,sqlite',
                'db_host' => 'required_unless:db_connection,sqlite',
                'db_port' => 'required_unless:db_connection,sqlite|numeric',
                'db_database' => 'required',
                'db_username' => 'required_unless:db_connection,sqlite',
                'db_password' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }

            // Configurar conexión temporal
            config([
                'database.connections.test' => [
                    'driver' => $request->db_connection,
                    'host' => $request->db_host,
                    'port' => $request->db_port,
                    'database' => $request->db_database,
                    'username' => $request->db_username,
                    'password' => $request->db_password,
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                ]
            ]);

            // Probar conexión
            DB::connection('test')->getPdo();

            return response()->json(['success' => true, 'message' => '¡Conexión exitosa!']);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }

    /**
     * Paso 3: Configuración de aplicación
     */
    public function application()
    {
        if ($this->isInstalled()) {
            return redirect('/login');
        }

        return view('install.application');
    }

    /**
     * Paso 4: Configuración de email
     */
    public function email()
    {
        if ($this->isInstalled()) {
            return redirect('/login');
        }

        return view('install.email');
    }

    /**
     * Paso 5: Crear usuario administrador
     */
    public function admin()
    {
        if ($this->isInstalled()) {
            return redirect('/login');
        }

        return view('install.admin');
    }

    /**
     * Paso 6: Instalación final
     */
    public function install(Request $request)
    {
        if ($this->isInstalled()) {
            return redirect('/login');
        }

        try {
            // Validar todos los datos
            $validator = Validator::make($request->all(), [
                // Database
                'db_connection' => 'required|in:mysql,pgsql,sqlite',
                'db_host' => 'required_unless:db_connection,sqlite',
                'db_port' => 'required_unless:db_connection,sqlite|numeric',
                'db_database' => 'required',
                'db_username' => 'required_unless:db_connection,sqlite',
                'db_password' => 'nullable',
                
                // Application
                'app_name' => 'required|string|max:255',
                'app_url' => 'required|url',
                'app_env' => 'required|in:production,local',
                
                // Admin
                'admin_name' => 'required|string|max:255',
                'admin_email' => 'required|email|max:255',
                'admin_password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }

            // 1. Crear archivo .env
            $this->createEnvFile($request);

            // 2. Generar app key
            Artisan::call('key:generate', ['--force' => true]);

            // 3. Ejecutar migraciones
            Artisan::call('migrate', ['--force' => true]);

            // 4. Crear usuario administrador
            $this->createAdminUser($request);

            // 5. Optimizar aplicación
            $this->optimizeApplication();

            // 6. Marcar como instalado
            $this->markAsInstalled();

            return response()->json([
                'success' => true, 
                'message' => '¡Instalación completada exitosamente!',
                'redirect' => route('login')
            ]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error en la instalación: ' . $e->getMessage()]);
        }
    }

    /**
     * Verificar si la aplicación ya está instalada
     */
    private function isInstalled()
    {
        return File::exists(base_path('.installed'));
    }

    /**
     * Verificar requisitos del sistema
     */
    private function checkRequirements()
    {
        return [
            'php_version' => [
                'name' => 'PHP 8.2+',
                'status' => version_compare(PHP_VERSION, '8.2.0', '>='),
                'current' => PHP_VERSION
            ],
            'pdo' => [
                'name' => 'PDO Extension',
                'status' => extension_loaded('pdo'),
                'current' => extension_loaded('pdo') ? 'Habilitado' : 'Deshabilitado'
            ],
            'mbstring' => [
                'name' => 'Mbstring Extension',
                'status' => extension_loaded('mbstring'),
                'current' => extension_loaded('mbstring') ? 'Habilitado' : 'Deshabilitado'
            ],
            'openssl' => [
                'name' => 'OpenSSL Extension',
                'status' => extension_loaded('openssl'),
                'current' => extension_loaded('openssl') ? 'Habilitado' : 'Deshabilitado'
            ],
            'tokenizer' => [
                'name' => 'Tokenizer Extension',
                'status' => extension_loaded('tokenizer'),
                'current' => extension_loaded('tokenizer') ? 'Habilitado' : 'Deshabilitado'
            ],
            'xml' => [
                'name' => 'XML Extension',
                'status' => extension_loaded('xml'),
                'current' => extension_loaded('xml') ? 'Habilitado' : 'Deshabilitado'
            ],
            'storage_writable' => [
                'name' => 'Storage Directory Writable',
                'status' => is_writable(storage_path()),
                'current' => is_writable(storage_path()) ? 'Escribible' : 'No escribible'
            ],
            'bootstrap_writable' => [
                'name' => 'Bootstrap Cache Writable',
                'status' => is_writable(base_path('bootstrap/cache')),
                'current' => is_writable(base_path('bootstrap/cache')) ? 'Escribible' : 'No escribible'
            ]
        ];
    }

    /**
     * Crear archivo .env
     */
    private function createEnvFile($request)
    {
        $envContent = "APP_NAME=\"{$request->app_name}\"\n";
        $envContent .= "APP_ENV={$request->app_env}\n";
        $envContent .= "APP_KEY=\n";
        $envContent .= "APP_DEBUG=" . ($request->app_env === 'local' ? 'true' : 'false') . "\n";
        $envContent .= "APP_URL={$request->app_url}\n\n";

        $envContent .= "LOG_CHANNEL=stack\n";
        $envContent .= "LOG_DEPRECATIONS_CHANNEL=null\n";
        $envContent .= "LOG_LEVEL=debug\n\n";

        $envContent .= "DB_CONNECTION={$request->db_connection}\n";
        $envContent .= "DB_HOST={$request->db_host}\n";
        $envContent .= "DB_PORT={$request->db_port}\n";
        $envContent .= "DB_DATABASE={$request->db_database}\n";
        $envContent .= "DB_USERNAME={$request->db_username}\n";
        $envContent .= "DB_PASSWORD={$request->db_password}\n\n";

        $envContent .= "BROADCAST_DRIVER=log\n";
        $envContent .= "CACHE_DRIVER=file\n";
        $envContent .= "FILESYSTEM_DISK=local\n";
        $envContent .= "QUEUE_CONNECTION=sync\n";
        $envContent .= "SESSION_DRIVER=file\n";
        $envContent .= "SESSION_LIFETIME=120\n\n";

        if ($request->mail_mailer) {
            $envContent .= "MAIL_MAILER={$request->mail_mailer}\n";
            $envContent .= "MAIL_HOST={$request->mail_host}\n";
            $envContent .= "MAIL_PORT={$request->mail_port}\n";
            $envContent .= "MAIL_USERNAME={$request->mail_username}\n";
            $envContent .= "MAIL_PASSWORD={$request->mail_password}\n";
            $envContent .= "MAIL_ENCRYPTION={$request->mail_encryption}\n";
            $envContent .= "MAIL_FROM_ADDRESS={$request->mail_from_address}\n";
            $envContent .= "MAIL_FROM_NAME=\"{$request->app_name}\"\n\n";
        }

        File::put(base_path('.env'), $envContent);
    }

    /**
     * Crear usuario administrador
     */
    private function createAdminUser($request)
    {
        User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => UserRole::ADMIN,
            'email_verified_at' => now(),
        ]);
    }

    /**
     * Optimizar aplicación
     */
    private function optimizeApplication()
    {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        Artisan::call('storage:link');
    }

    /**
     * Marcar como instalado
     */
    private function markAsInstalled()
    {
        File::put(base_path('.installed'), date('Y-m-d H:i:s'));
    }
} 