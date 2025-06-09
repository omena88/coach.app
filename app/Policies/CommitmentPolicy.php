<?php

namespace App\Policies;

use App\Models\Commitment;
use App\Models\User;
use App\UserRole;

class CommitmentPolicy
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
    public function view(User $user, Commitment $commitment): bool
    {
        // Admin puede ver todos los compromisos
        if ($user->isAdmin()) {
            return true;
        }
        
        // Coach puede ver compromisos de sus sesiones
        if ($user->isCoach() && $commitment->session->coach_id === $user->id) {
            return true;
        }
        
        // Coachee puede ver compromisos de sus sesiones
        if ($user->isCoachee() && $commitment->session->coachee_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo admin y coach pueden crear compromisos
        return $user->isAdmin() || $user->isCoach();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Commitment $commitment): bool
    {
        // Admin puede editar todos los compromisos
        if ($user->isAdmin()) {
            return true;
        }
        
        // Coach puede editar compromisos de sus sesiones
        if ($user->isCoach() && $commitment->session->coach_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Commitment $commitment): bool
    {
        // Admin puede eliminar todos los compromisos
        if ($user->isAdmin()) {
            return true;
        }
        
        // Coach puede eliminar compromisos de sus sesiones
        if ($user->isCoach() && $commitment->session->coach_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Commitment $commitment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Commitment $commitment): bool
    {
        return $user->isAdmin();
    }
}
