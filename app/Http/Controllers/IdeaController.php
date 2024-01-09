<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        if (request()->has('search')) {
            $ideas = idea::where('idea', 'like', '%' . request()->get('search', '') . '%')->orderBy("created_at", "desc")->paginate(3);
        } else {
            $ideas = idea::orderBy("created_at", "desc")->paginate(3);
        }
        return view("home", compact('ideas'));
    }

    public function store()
    {
        // dump(request()->all());
        $vali = request()->validate([
            "idea" => "required|min:2|max:240",
        ]);
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
        $edit = true;
        return view("show", compact('idea', 'edit'));
    }

    public function update(idea $idea)
    {
        $vali = request()->validate([
            "idea" => "required|min:2|max:240",
        ]);

        $idea->idea = $vali['idea'];
        $idea->save();

        return redirect()->route('ideas.show', $idea)->with('success', 'Idea Updated Successfully!');
    }

    public function destroy($id)
    {
        $idea = idea::where('id', $id)->first();
        if ($idea) {
            $idea->delete();
            return redirect()->route('home')->with('success', 'Idea deleted Successfully!');
        } else {
            return redirect()->route('home');
        }
    }
}
