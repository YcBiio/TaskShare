<?php

namespace App\Policies;

use App\Models\TaskList;
use App\Models\User;

class TaskListPolicy
{
    public function view(User $user, TaskList $taskList): bool
    {
        return $taskList->owner_id === $user->id || $taskList->sharedWith->contains($user);
    }

    public function update(User $user, TaskList $taskList): bool
    {
        return $taskList->owner_id === $user->id || (
                $taskList->sharedWith->contains($user) &&
                $taskList->sharedWith()->where('user_id', $user->id)->first()->pivot->can_edit
            );
    }

    public function delete(User $user, TaskList $taskList): bool
    {
        return $taskList->owner_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function restore(User $user, TaskList $taskList): bool
    {
        return false;
    }

    public function forceDelete(User $user, TaskList $taskList): bool
    {
        return false;
    }
}
