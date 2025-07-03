<?php

namespace App\Policies;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskListPolicy
{
    /**
     * Determine whether the user can view any models.
     * ! UNUSED
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TaskList $taskList): bool
    {
        return $user->id === $taskList->user_id;
    }

    /**
     * Determine whether the user can create models.
     * ! UNUSED
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TaskList $taskList): bool
    {
        return $user->id === $taskList->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskList $taskList): bool
    {
        return $user->id === $taskList->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     * ! UNUSED
     */
    public function restore(User $user, TaskList $taskList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     * ! UNUSED
     */
    public function forceDelete(User $user, TaskList $taskList): bool
    {
        return false;
    }
}
