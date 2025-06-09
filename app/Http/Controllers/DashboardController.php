<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Session;
use App\Models\Commitment;
use App\UserRole;
use App\SessionStatus;
use App\CommitmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Dashboard para coachees
        if ($user->isCoachee()) {
            return $this->coacheeDashboard($user);
        }
        
        // Dashboard para coaches y admins
        if ($user->isCoach() || $user->isAdmin()) {
            return $this->coachDashboard($user);
        }

        return redirect()->route('sessions.index');
    }

    private function coacheeDashboard($user)
    {
        // Estadísticas de compromisos del coachee
        $allCommitments = Commitment::whereHas('session', function ($query) use ($user) {
            $query->where('coachee_id', $user->id);
        })->get();

        $fulfilledCommitments = $allCommitments->where('status', CommitmentStatus::FULFILLED)->count();
        $pendingCommitments = $allCommitments->where('status', CommitmentStatus::PENDING)->count();
        $overdueCommitments = $allCommitments->where('status', CommitmentStatus::PENDING)
            ->where('due_date', '<', now())->count();

        // Próximas sesiones del coachee
        $upcomingSessions = $user->coacheeSessions()
            ->with(['coach'])
            ->where('status', SessionStatus::SCHEDULED)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->orderBy('time')
            ->limit(5)
            ->get();

        // Compromisos pendientes recientes
        $recentCommitments = Commitment::whereHas('session', function ($query) use ($user) {
            $query->where('coachee_id', $user->id);
        })
        ->with(['session.coach'])
        ->where('status', CommitmentStatus::PENDING)
        ->orderBy('due_date')
        ->limit(5)
        ->get();

        // Total de sesiones
        $totalSessions = $user->coacheeSessions()->count();
        $completedSessions = $user->coacheeSessions()->where('status', SessionStatus::COMPLETED)->count();

        return view('dashboard.coachee', compact(
            'fulfilledCommitments',
            'pendingCommitments', 
            'overdueCommitments',
            'upcomingSessions',
            'recentCommitments',
            'totalSessions',
            'completedSessions'
        ));
    }

    private function coachDashboard($user)
    {
        // Obtener coachees del coach
        $coachees = $user->coachees()->get();
        
        // Estadísticas del coach
        $totalCoachees = $coachees->count();
        $totalSessions = $user->coachSessions()->count();
        $completedSessions = $user->coachSessions()->where('status', SessionStatus::COMPLETED)->count();
        $scheduledSessions = $user->coachSessions()->where('status', SessionStatus::SCHEDULED)->count();
        
        // Estadísticas adicionales para administradores
        $adminStats = [];
        if ($user->isAdmin()) {
            $adminStats = [
                'total_coaches' => User::whereIn('role', [UserRole::COACH, UserRole::ADMIN])->count(),
                'total_all_coachees' => User::where('role', UserRole::COACHEE)->count(),
                'total_all_sessions' => Session::count(),
                'coaches_with_coachees' => User::whereIn('role', [UserRole::COACH, UserRole::ADMIN])->has('coachees')->count(),
            ];
        }
        
        // Próximas sesiones
        $upcomingSessions = $user->coachSessions()
            ->with(['coachee'])
            ->where('status', SessionStatus::SCHEDULED)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->orderBy('time')
            ->limit(5)
            ->get();
        
        // Compromisos pendientes
        $pendingCommitments = Commitment::whereHas('session', function ($query) use ($user) {
            $query->where('coach_id', $user->id);
        })
        ->with(['session.coachee'])
        ->where('status', CommitmentStatus::PENDING)
        ->orderBy('due_date')
        ->limit(5)
        ->get();
        
        // Compromisos vencidos
        $overdueCommitments = Commitment::whereHas('session', function ($query) use ($user) {
            $query->where('coach_id', $user->id);
        })
        ->with(['session.coachee'])
        ->where('status', CommitmentStatus::PENDING)
        ->where('due_date', '<', now())
        ->count();

        return view('dashboard.index', compact(
            'coachees',
            'totalCoachees',
            'totalSessions',
            'completedSessions',
            'scheduledSessions',
            'upcomingSessions',
            'pendingCommitments',
            'overdueCommitments',
            'adminStats'
        ));
    }
}
