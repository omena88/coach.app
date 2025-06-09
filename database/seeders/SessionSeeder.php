<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Session;
use App\Models\User;
use App\Models\Commitment;
use App\SessionMode;
use App\SessionStatus;
use App\CommitmentStatus;
use App\UserRole;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coaches = User::where('role', UserRole::COACH)->get();
        $coachees = User::where('role', UserRole::COACHEE)->get();

        // Crear sesiones de prueba
        foreach ($coaches as $coach) {
            $coachCoachees = $coachees->where('coach_id', $coach->id);
            
            foreach ($coachCoachees as $coachee) {
                // Sesión completada
                $session1 = Session::create([
                    'coach_id' => $coach->id,
                    'coachee_id' => $coachee->id,
                    'date' => now()->subDays(7),
                    'time' => '10:00:00',
                    'mode' => SessionMode::VIRTUAL,
                    'status' => SessionStatus::COMPLETED,
                    'goals' => 'Definir objetivos profesionales para el próximo trimestre',
                    'notes' => 'Sesión muy productiva. El coachee mostró gran claridad en sus metas.',
                ]);

                // Crear compromisos para la sesión completada
                Commitment::create([
                    'session_id' => $session1->id,
                    'description' => 'Elaborar plan de desarrollo profesional detallado',
                    'due_date' => now()->subDays(3),
                    'status' => CommitmentStatus::FULFILLED,
                    'evaluation_coach' => 'Excelente trabajo, muy detallado y realista',
                    'evaluation_coachee' => 'Me ayudó mucho a clarificar mis objetivos',
                ]);

                // Sesión programada
                Session::create([
                    'coach_id' => $coach->id,
                    'coachee_id' => $coachee->id,
                    'date' => now()->addDays(3),
                    'time' => '14:00:00',
                    'mode' => SessionMode::IN_PERSON,
                    'status' => SessionStatus::SCHEDULED,
                    'goals' => 'Revisar avances y definir siguientes pasos',
                    'notes' => null,
                ]);

                // Sesión reprogramada
                Session::create([
                    'coach_id' => $coach->id,
                    'coachee_id' => $coachee->id,
                    'date' => now()->addDays(10),
                    'time' => '16:00:00',
                    'mode' => SessionMode::PHONE,
                    'status' => SessionStatus::RESCHEDULED,
                    'goals' => 'Sesión de seguimiento mensual',
                    'notes' => 'Reprogramada por conflicto de agenda del coachee',
                ]);
            }
        }
    }
}
