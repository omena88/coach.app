<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\UserRole;
use Illuminate\Support\Facades\Hash;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si existe un administrador
        $admin = User::where('role', UserRole::ADMIN)->first();
        
        if (!$admin) {
            // Crear usuario administrador que también es coach
            $admin = User::create([
                'name' => 'Administrador',
                'email' => 'admin@webcoaching.com',
                'password' => Hash::make('admin123'),
                'role' => UserRole::ADMIN,
            ]);
            
            echo "✅ Administrador creado como primer coach\n";
        } else {
            echo "✅ Administrador ya existe: {$admin->name}\n";
        }

        // Verificar si hay coaches además del admin
        $coachCount = User::where('role', UserRole::COACH)->count();
        
        if ($coachCount === 0) {
            // Crear algunos coaches de ejemplo
            $coaches = [
                [
                    'name' => 'María Elena González',
                    'email' => 'maria.gonzalez@webcoaching.com',
                    'password' => Hash::make('coach123'),
                ],
                [
                    'name' => 'Carlos Alberto Rodríguez',
                    'email' => 'carlos.rodriguez@webcoaching.com',
                    'password' => Hash::make('coach123'),
                ],
                [
                    'name' => 'Ana Isabel Martínez',
                    'email' => 'ana.martinez@webcoaching.com',
                    'password' => Hash::make('coach123'),
                ]
            ];

            foreach ($coaches as $coachData) {
                User::create([
                    'name' => $coachData['name'],
                    'email' => $coachData['email'],
                    'password' => $coachData['password'],
                    'role' => UserRole::COACH,
                ]);
            }
            
            echo "✅ " . count($coaches) . " coaches de ejemplo creados\n";
        } else {
            echo "✅ Ya existen {$coachCount} coaches en el sistema\n";
        }
    }
} 