<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CoacheeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user->isCoach() && !$user->isAdmin()) {
            abort(403, 'No tienes permisos para ver coachees.');
        }

        $coachees = $user->coachees()->with(['coachSessions' => function ($query) {
            $query->latest()->limit(3);
        }])->get();

        return view('coachees.index', compact('coachees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if (!$user->isCoach() && !$user->isAdmin()) {
            abort(403, 'No tienes permisos para crear coachees.');
        }

        return view('coachees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isCoach() && !$user->isAdmin()) {
            abort(403, 'No tienes permisos para crear coachees.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $coachee = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => UserRole::COACHEE,
            'coach_id' => $user->id, // Asignar automáticamente al coach actual
        ]);

        return redirect()->route('coachees.index')->with('success', 'Coachee creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $coachee)
    {
        $user = Auth::user();
        
        // Verificar que el coachee pertenece al coach
        if (!$user->isAdmin() && $coachee->coach_id !== $user->id) {
            abort(403, 'No tienes permisos para ver este coachee.');
        }

        $coachee->load(['coachSessions.commitments', 'coach']);
        
        // Estadísticas del coachee
        $totalSessions = $coachee->coacheeSessions()->count();
        $completedSessions = $coachee->coacheeSessions()->where('status', 'completed')->count();
        $pendingCommitments = $coachee->coacheeSessions()
            ->with('commitments')
            ->get()
            ->pluck('commitments')
            ->flatten()
            ->where('status', 'pending')
            ->count();

        return view('coachees.show', compact('coachee', 'totalSessions', 'completedSessions', 'pendingCommitments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $coachee)
    {
        $user = Auth::user();
        
        // Verificar que el coachee pertenece al coach
        if (!$user->isAdmin() && $coachee->coach_id !== $user->id) {
            abort(403, 'No tienes permisos para editar este coachee.');
        }

        return view('coachees.edit', compact('coachee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $coachee)
    {
        $user = Auth::user();
        
        // Verificar que el coachee pertenece al coach
        if (!$user->isAdmin() && $coachee->coach_id !== $user->id) {
            abort(403, 'No tienes permisos para editar este coachee.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $coachee->id,
        ]);

        $coachee->update($validated);

        return redirect()->route('coachees.show', $coachee)->with('success', 'Coachee actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $coachee)
    {
        $user = Auth::user();
        
        // Solo admin puede eliminar coachees
        if (!$user->isAdmin()) {
            abort(403, 'No tienes permisos para eliminar coachees.');
        }

        $coachee->delete();

        return redirect()->route('coachees.index')->with('success', 'Coachee eliminado exitosamente.');
    }
}
