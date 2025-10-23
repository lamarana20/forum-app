<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    /**
     * Determine if the user can view any threads.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Tout le monde peut voir la liste des threads
    }

    /**
     * Determine if the user can view the thread.
     */
    public function view(?User $user, Thread $thread): bool
    {
        return true; // Tout le monde peut voir un thread
    }

    /**
     * Determine if the user can create threads.
     */
    public function create(User $user): bool
    {
        return true; // Tous les utilisateurs connectés peuvent créer
    }

    /**
     * Determine if the user can update the thread.
     */
    public function update(User $user, Thread $thread): bool
    {
        return $user->id === $thread->user_id;
    }

    /**
     * Determine if the user can delete the thread.
     */
    public function delete(User $user, Thread $thread): bool
    {
        return $user->id === $thread->user_id;
    }

    /**
     * Determine if the user can restore the thread.
     */
    public function restore(User $user, Thread $thread): bool
    {
        return $user->id === $thread->user_id;
    }

    /**
     * Determine if the user can permanently delete the thread.
     */
    public function forceDelete(User $user, Thread $thread): bool
    {
        return $user->id === $thread->user_id;
    }
}