<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\UserRole;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador (que también es coach)
        $admin = User::create([
            'name' => 'Oscar Mena',
            'email' => 'oscar.mena@goodlinks.pe',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
        ]);

        // Crear coaches de prueba
        $coach1 = User::create([
            'name' => 'María González',
            'email' => 'maria.gonzalez@coaching.com',
            'password' => Hash::make('password'),
            'role' => UserRole::COACH,
        ]);

        $coach2 = User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'carlos.rodriguez@coaching.com',
            'password' => Hash::make('password'),
            'role' => UserRole::COACH,
        ]);

        // Crear coachees de prueba
        User::create([
            'name' => 'Ana López',
            'email' => 'ana.lopez@empresa.com',
            'password' => Hash::make('password'),
            'role' => UserRole::COACHEE,
            'coach_id' => $coach1->id,
        ]);

        User::create([
            'name' => 'Pedro Martínez',
            'email' => 'pedro.martinez@empresa.com',
            'password' => Hash::make('password'),
            'role' => UserRole::COACHEE,
            'coach_id' => $coach1->id,
        ]);

        User::create([
            'name' => 'Laura Sánchez',
            'email' => 'laura.sanchez@empresa.com',
            'password' => Hash::make('password'),
            'role' => UserRole::COACHEE,
            'coach_id' => $coach2->id,
        ]);

        User::create([
            'name' => 'Roberto Torres',
            'email' => 'roberto.torres@empresa.com',
            'password' => Hash::make('password'),
            'role' => UserRole::COACHEE,
            'coach_id' => $coach2->id,
        ]);

        // Agregar un coachee al administrador (que también es coach)
        User::create([
            'name' => 'Sofía Ramírez',
            'email' => 'sofia.ramirez@empresa.com',
            'password' => Hash::make('password'),
            'role' => UserRole::COACHEE,
            'coach_id' => $admin->id,
        ]);
    }
}
