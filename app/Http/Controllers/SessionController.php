<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use App\SessionMode;
use App\SessionStatus;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SessionController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $sessions = Session::with(['coach', 'coachee'])->orderBy('date', 'desc')->paginate(10);
        } elseif ($user->isCoach()) {
            $sessions = $user->coachSessions()->with(['coachee'])->orderBy('date', 'desc')->paginate(10);
        } else {
            $sessions = $user->coacheeSessions()->with(['coach'])->orderBy('date', 'desc')->paginate(10);
        }

        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->isCoach()) {
            $coachees = $user->coachees;
            $coaches = collect();
        } elseif ($user->isAdmin()) {
            $coaches = User::where('role', UserRole::COACH)->get();
            $coachees = User::where('role', UserRole::COACHEE)->get();
        } else {
            abort(403, 'No tienes permisos para crear sesiones.');
        }

        $modes = SessionMode::cases();
        $statuses = SessionStatus::cases();

        return view('sessions.create', compact('coachees', 'modes', 'statuses', 'coaches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'coach_id' => 'required|exists:users,id',
            'coachee_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'mode' => 'required|in:' . implode(',', array_column(SessionMode::cases(), 'value')),
            'status' => 'required|in:' . implode(',', array_column(SessionStatus::cases(), 'value')),
            'goals' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Si es coach, solo puede crear sesiones para sí mismo
        if ($user->isCoach()) {
            $validated['coach_id'] = $user->id;
        }

        Session::create($validated);

        return redirect()->route('sessions.index')->with('success', 'Sesión creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        Gate::authorize('view', $session);
        
        $session->load(['coach', 'coachee', 'commitments']);
        
        return view('sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        Gate::authorize('update', $session);
        
        $user = Auth::user();
        
        if ($user->isCoach()) {
            $coachees = $user->coachees;
            $coaches = collect();
        } elseif ($user->isAdmin()) {
            $coaches = User::where('role', UserRole::COACH)->get();
            $coachees = User::where('role', UserRole::COACHEE)->get();
        }

        $modes = SessionMode::cases();
        $statuses = SessionStatus::cases();

        return view('sessions.edit', compact('session', 'coachees', 'modes', 'statuses', 'coaches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        Gate::authorize('update', $session);
        
        $user = Auth::user();
        
        $validated = $request->validate([
            'coach_id' => 'required|exists:users,id',
            'coachee_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'mode' => 'required|in:' . implode(',', array_column(SessionMode::cases(), 'value')),
            'status' => 'required|in:' . implode(',', array_column(SessionStatus::cases(), 'value')),
            'goals' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Si es coach, solo puede editar sus propias sesiones
        if ($user->isCoach()) {
            $validated['coach_id'] = $user->id;
        }

        $session->update($validated);

        return redirect()->route('sessions.index')->with('success', 'Sesión actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        Gate::authorize('delete', $session);
        
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Sesión eliminada exitosamente.');
    }
}
