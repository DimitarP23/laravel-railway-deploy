<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ErrorPage;
use App\Models\User;

class ErrorPagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Users can view their own stocks
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ErrorPage $errorPage): bool
    {
        // IDOR Prevention: User can only view their own stocks
        return $user->id === $errorPage->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Authenticated users can create stocks
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ErrorPage $errorPage): bool
    {
        // IDOR Prevention: User can only update their own stocks
        return $user->id === $errorPage->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ErrorPage $errorPage): bool
    {
        // IDOR Prevention: User can only delete their own stocks
        return $user->id === $errorPage->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ErrorPage $errorPage): bool
    {
        // IDOR Prevention: User can only restore their own stocks
        return $user->id === $errorPage->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ErrorPage $errorPage): bool
    {
        // IDOR Prevention: User can only force delete their own stocks
        return $user->id === $errorPage->user_id;
    }
}
