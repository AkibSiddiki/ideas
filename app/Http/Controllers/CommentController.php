<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(idea $idea)
    {
        // dd(request()->all());
        // dd($idea);
        request()->validate([
            "comment" => "required|min:2|max:240",
        ]);

        comment::create([
            'idea_id' => $idea->id,
            'comment' => request('comment'),
        ]);

        return redirect()->route('ideas.show', $idea)->with('success', 'Comment posted Successfully!');
    }
}
