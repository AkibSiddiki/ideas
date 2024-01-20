<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
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

        if ($AuthUser) {
            $notFollowingUsers = User::whereNotIn('id', $AuthUser->following()->pluck('following_id')->prepend($AuthUser->id))->limit(4)->get();
        } else {
            $notFollowingUsers = User::latest()->limit(4)->get();
        }

        return view("home", compact('ideas', 'notFollowingUsers'));
    }

    public function store(IdeaRequest $request)
    {

        $idea = new Idea();
        $idea->idea = $request->idea;
        $idea->user_id = auth()->user()->id;
        $idea->save();
        return redirect()->route('home')->with('success', 'Idea created Successfully!');
    }

    public function show(idea $idea)
    {
        return view("show", compact('idea'));
    }

    public function edit(idea $idea)
    {
        $this->authorize('update', $idea);

        $edit = true;
        return view("show", compact('idea', 'edit'));
    }

    public function update(IdeaRequest $request, idea $idea)
    {

        $this->authorize('update', $idea);

        $idea->idea = $request->idea;
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
        $this->authorize('delete', $idea);

        $idea->delete();
        return redirect()->route('home')->with('success', 'Idea deleted Successfully!');
    }
}
