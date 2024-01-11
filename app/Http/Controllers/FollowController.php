<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return abort(404, 'BUG YOU');
        }
        // Check if the user is not already following
        if (!(auth()->user()->isFollowing($user))) {
            // Create a new follower relationship
            Follower::create([
                'follower_id' => auth()->user()->id,
                'following_id' => $user->id,
            ]);
        }

        return redirect()->back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollow(User $user)
    {
        // Check if the user is following before attempting to unfollow
        if (auth()->user()->isFollowing($user)) {
            // Remove the follower relationship
            auth()->user()->following()->where('following_id', $user->id)->delete();
        }

        return redirect()->back()->with('success', 'You have unfollowed ' . $user->name);
    }
}
