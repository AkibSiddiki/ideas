<?php

namespace App\Http\Controllers;

use App\Models\idea;
use App\Models\User;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        $AuthUser = auth()->user();
        if (request()->has('search')) {
            if ($AuthUser) {
                $ideas = Idea::with('user', 'comments.user')->whereIn('user_id', $AuthUser->following()->pluck('following_id')->prepend($AuthUser->id))->where('idea', 'like', '%' . request()->get('search', '') . '%')->orderBy("created_at", "desc")->paginate(3);
            } else {
                $ideas = idea::with('user', 'comments.user')->where('idea', 'like', '%' . request()->get('search', '') . '%')->orderBy("created_at", "desc")->paginate(3);
            }
        } else {
            if ($AuthUser) {
                $ideas = Idea::with('user', 'comments.user')->whereIn('user_id', $AuthUser->following()->pluck('following_id')->prepend($AuthUser->id))->orderBy("created_at", "desc")->paginate(3);
            } else {
                $ideas = idea::with('user', 'comments.user')->orderBy("created_at", "desc")->paginate(3);
            }
        }

        // $followingUsersIds = $AuthUser->following()->pluck('following_id')->prepend($AuthUser->id);
        // dd($followingUsersIds);
        if ($AuthUser) {
            $notFollowingUsers = User::with('user', 'comments.user')->whereNotIn('id', $AuthUser->following()->pluck('following_id')->prepend($AuthUser->id))->limit(4)->get();
        } else {
            $notFollowingUsers = User::with('user', 'comments.user')->latest()->limit(4)->get();
        }
        // dd($notFollowingUsers);
        return view("home", compact('ideas', 'notFollowingUsers'));
    }

    public function store()
    {
        $vali = request()->validate([
            "idea" => "required|min:2|max:240",
        ]);
        $vali['user_id'] = auth()->user()->id;
        idea::create($vali);
        return redirect()->route('home')->with('success', 'Idea created Successfully!');
    }

    public function show(idea $idea)
    {
        // dump($idea);
        return view("show", compact('idea'));
    }

    public function edit(idea $idea)
    {
        if ($idea['user_id'] != auth()->user()->id) {
            return abort(403, 'unauthorized');
        }
        $edit = true;
        return view("show", compact('idea', 'edit'));
    }

    public function update(idea $idea)
    {
        $vali = request()->validate([
            "idea" => "required|min:2|max:240",
        ]);

        if ($idea['user_id'] != auth()->user()->id) {
            return abort(403, 'unauthorized');
        }

        $idea->idea = $vali['idea'];
        $idea->save();

        return redirect()->route('ideas.show', $idea)->with('success', 'Idea Updated Successfully!');
    }

    public function like(idea $idea)
    {

        $idea['likes'] = $idea['likes'] + 1;
        $idea->save();

        return back();
    }

    public function destroy(idea $idea)
    {
        // $idea = idea::where('id', $idea)->first();
        if ($idea['user_id'] == auth()->user()->id) {
            $idea->delete();
            return redirect()->route('home')->with('success', 'Idea deleted Successfully!');
        } else {
            return abort(403, 'unauthorized');
        }
    }
}
