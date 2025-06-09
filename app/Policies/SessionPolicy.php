<?php

namespace App\Policies;

use App\Models\Session;
use App\Models\User;
use App\UserRole;

class SessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos los usuarios autenticados pueden ver la lista
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Session $session): bool
    {
        // Admin puede ver todas las sesiones
        if ($user->isAdmin()) {
            return true;
        }
        
        // Coach puede ver sus propias sesiones
        if ($user->isCoach() && $session->coach_id === $user->id) {
            return true;
        }
        
        // Coachee puede ver sus propias sesiones
        if ($user->isCoachee() && $session->coachee_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo admin y coach pueden crear sesiones
        return $user->isAdmin() || $user->isCoach();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Session $session): bool
    {
        // Admin puede editar todas las sesiones
        if ($user->isAdmin()) {
            return true;
        }
        
        // Coach puede editar sus propias sesiones
        if ($user->isCoach() && $session->coach_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Session $session): bool
    {
        // Admin puede eliminar todas las sesiones
        if ($user->isAdmin()) {
            return true;
        }
        
        // Coach puede eliminar sus propias sesiones
        if ($user->isCoach() && $session->coach_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Session $session): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Session $session): bool
    {
        return $user->isAdmin();
    }
}
