<?php

namespace App\Http\Controllers;

use App\Models\Commitment;
use App\Models\Session;
use App\CommitmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommitmentController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $commitments = Commitment::with(['session.coach', 'session.coachee'])->orderBy('due_date', 'desc')->paginate(10);
        } elseif ($user->isCoach()) {
            $commitments = Commitment::whereHas('session', function ($query) use ($user) {
                $query->where('coach_id', $user->id);
            })->with(['session.coachee'])->orderBy('due_date', 'desc')->paginate(10);
        } else {
            $commitments = Commitment::whereHas('session', function ($query) use ($user) {
                $query->where('coachee_id', $user->id);
            })->with(['session.coach'])->orderBy('due_date', 'desc')->paginate(10);
        }

        return view('commitments.index', compact('commitments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $sessionId = $request->get('session_id');
        
        if ($sessionId) {
            $session = Session::findOrFail($sessionId);
            Gate::authorize('view', $session);
        }
        
        if ($user->isCoach()) {
            $sessions = $user->coachSessions()->with(['coachee'])->get();
        } elseif ($user->isAdmin()) {
            $sessions = Session::with(['coach', 'coachee'])->get();
        } else {
            abort(403, 'No tienes permisos para crear compromisos.');
        }

        $statuses = CommitmentStatus::cases();

        return view('commitments.create', compact('sessions', 'statuses', 'sessionId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|exists:coaching_sessions,id',
            'description' => 'required|string|max:1000',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:' . implode(',', array_column(CommitmentStatus::cases(), 'value')),
            'evaluation_coach' => 'nullable|string|max:1000',
            'evaluation_coachee' => 'nullable|string|max:1000',
        ]);

        $session = Session::findOrFail($validated['session_id']);
        Gate::authorize('view', $session);

        Commitment::create($validated);

        return redirect()->route('sessions.show', $session)->with('success', 'Compromiso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commitment $commitment)
    {
        Gate::authorize('view', $commitment);
        
        $commitment->load(['session.coach', 'session.coachee']);
        
        return view('commitments.show', compact('commitment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commitment $commitment)
    {
        Gate::authorize('update', $commitment);
        
        $user = Auth::user();
        
        if ($user->isCoach()) {
            $sessions = $user->coachSessions()->with(['coachee'])->get();
        } elseif ($user->isAdmin()) {
            $sessions = Session::with(['coach', 'coachee'])->get();
        } else {
            $sessions = collect();
        }

        $statuses = CommitmentStatus::cases();

        return view('commitments.edit', compact('commitment', 'sessions', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commitment $commitment)
    {
        Gate::authorize('update', $commitment);
        
        $validated = $request->validate([
            'session_id' => 'required|exists:coaching_sessions,id',
            'description' => 'required|string|max:1000',
            'due_date' => 'required|date',
            'status' => 'required|in:' . implode(',', array_column(CommitmentStatus::cases(), 'value')),
            'evaluation_coach' => 'nullable|string|max:1000',
            'evaluation_coachee' => 'nullable|string|max:1000',
        ]);

        $session = Session::findOrFail($validated['session_id']);
        Gate::authorize('view', $session);

        $commitment->update($validated);

        return redirect()->route('sessions.show', $session)->with('success', 'Compromiso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commitment $commitment)
    {
        Gate::authorize('delete', $commitment);
        
        $session = $commitment->session;
        $commitment->delete();

        return redirect()->route('sessions.show', $session)->with('success', 'Compromiso eliminado exitosamente.');
    }
}
