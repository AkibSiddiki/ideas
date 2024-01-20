<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdeaPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Idea $idea)
    {
        return $user->id === $idea->user_id; // restrict this action to the idea's owner
    }

    public function delete(User $user, Idea $idea)
    {
        return $user->id === $idea->user_id; // restrict this action to the idea's owner
    }
}
