<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateCoachCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coach:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un nuevo coach en el sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Validar los datos
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $this->error('Error en la validación:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('- ' . $error);
            }
            return 1;
        }

        try {
            $coach = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => UserRole::COACH,
            ]);

            $this->info("✅ Coach creado exitosamente:");
            $this->line("   Nombre: {$coach->name}");
            $this->line("   Email: {$coach->email}");
            $this->line("   ID: {$coach->id}");

            return 0;
        } catch (\Exception $e) {
            $this->error("❌ Error al crear el coach: " . $e->getMessage());
            return 1;
        }
    }
} 