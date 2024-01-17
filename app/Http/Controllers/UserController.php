<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $AuthUser = auth()->user();

        $user = User::where('id', $id)->first();
        if (request()->has('search')) {
            $Ideas = $user->ideas()->where('idea', 'like', '%' . request()->get('search', '') . '%')->paginate(3);
        } else {
            $Ideas = $user->ideas()->paginate(3);
        }

        if ($AuthUser) {
            $notFollowingUsers = User::whereNotIn('id', $AuthUser->following()->pluck('following_id')->prepend($AuthUser->id))->limit(4)->get();
        } else {
            $notFollowingUsers = User::latest()->limit(4)->get();
        }

        return view('profile', compact('user', 'Ideas', 'notFollowingUsers'));
    }

    public function edit($id)
    {
        $profileEdit = true;
        $user = User::where('id', $id)->first();
        $AuthUser = auth()->user();

        if ($id != $AuthUser->id) {
            return abort(403, 'unauthorized');
        }
        if (request()->has('search')) {
            $Ideas = $user->ideas()->where('idea', 'like', '%' . request()->get('search', '') . '%')->paginate(3);
        } else {
            $Ideas = $user->ideas()->paginate(3);
        }

        if ($AuthUser) {
            $notFollowingUsers = User::whereNotIn('id', $AuthUser->following()->pluck('following_id')->prepend($AuthUser->id))->limit(4)->get();
        } else {
            $notFollowingUsers = User::latest()->limit(4)->get();
        }

        return view('profile', compact('user', 'Ideas', 'profileEdit', 'notFollowingUsers'));
    }

    public function update(User $user)
    {
        if ($user->id != auth()->user()->id) {
            return abort(403, 'unauthorized');
        }

        $vali = request()->validate([
            "name" => "min:2|max:60|required",
            "bio" => "nullable|max:280",
            "image" => "image"
        ]);

        if (request('image')) {
            $imgPath = request()->file('image')->store('profile', 'public');
            $vali['image'] = $imgPath;

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        }


        // dd(request()->all());

        // $user->name = $vali['name'] ?? $user->name;
        // $user->bio = $vali['bio'] ?? $user->bio;
        // $user->save();
        $user->update($vali);


        return redirect()->route('Users.show', $user->id)->with('success', 'Profile is successfully Updated.');
    }
}
