<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    /**
     * Check if user is admin.
     */
    private function checkAdminAccess()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Solo los administradores pueden gestionar coaches.');
        }
    }

    /**
     * Display a listing of coaches.
     */
    public function index()
    {
        $this->checkAdminAccess();
        
        // Incluir tanto coaches como administradores (que también pueden ser coaches)
        $coaches = User::whereIn('role', [UserRole::COACH, UserRole::ADMIN])
            ->withCount(['coachees', 'coachSessions'])
            ->orderBy('name')
            ->get();
            
        return view('coaches.index', compact('coaches'));
    }

    /**
     * Show the form for creating a new coach.
     */
    public function create()
    {
        $this->checkAdminAccess();
        
        return view('coaches.create');
    }

    /**
     * Store a newly created coach in storage.
     */
    public function store(Request $request)
    {
        $this->checkAdminAccess();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRole::COACH,
        ]);

        return redirect()->route('coaches.index')
            ->with('success', 'Coach creado exitosamente.');
    }

    /**
     * Display the specified coach.
     */
    public function show(User $coach)
    {
        $this->checkAdminAccess();
        
        if (!$coach->isCoach() && !$coach->isAdmin()) {
            abort(404, 'Coach no encontrado.');
        }

        $coach->load(['coachees', 'coachSessions' => function($query) {
            $query->latest()->limit(10);
        }]);

        $stats = [
            'total_coachees' => $coach->coachees->count(),
            'total_sessions' => $coach->coachSessions->count(),
            'completed_sessions' => $coach->coachSessions->where('status', \App\SessionStatus::COMPLETED)->count(),
            'scheduled_sessions' => $coach->coachSessions->where('status', \App\SessionStatus::SCHEDULED)->count(),
        ];

        return view('coaches.show', compact('coach', 'stats'));
    }

    /**
     * Show the form for editing the specified coach.
     */
    public function edit(User $coach)
    {
        $this->checkAdminAccess();
        
        if (!$coach->isCoach() && !$coach->isAdmin()) {
            abort(404, 'Coach no encontrado.');
        }

        return view('coaches.edit', compact('coach'));
    }

    /**
     * Update the specified coach in storage.
     */
    public function update(Request $request, User $coach)
    {
        $this->checkAdminAccess();
        
        if (!$coach->isCoach() && !$coach->isAdmin()) {
            abort(404, 'Coach no encontrado.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$coach->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $coach->update($updateData);

        return redirect()->route('coaches.index')
            ->with('success', 'Coach actualizado exitosamente.');
    }

    /**
     * Remove the specified coach from storage.
     */
    public function destroy(User $coach)
    {
        $this->checkAdminAccess();
        
        if (!$coach->isCoach() && !$coach->isAdmin()) {
            abort(404, 'Coach no encontrado.');
        }

        // No permitir eliminar administradores
        if ($coach->isAdmin()) {
            return redirect()->route('coaches.index')
                ->with('error', 'No se puede eliminar un administrador.');
        }

        // Verificar si el coach tiene coachees asignados
        if ($coach->coachees()->count() > 0) {
            return redirect()->route('coaches.index')
                ->with('error', 'No se puede eliminar el coach porque tiene coachees asignados.');
        }

        $coach->delete();

        return redirect()->route('coaches.index')
            ->with('success', 'Coach eliminado exitosamente.');
    }
} 