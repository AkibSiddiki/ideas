<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(idea $idea)
    {
        request()->validate([
            "comment" => "required|min:2|max:240",
        ]);

        comment::create([
            'user_id' => auth()->user()->id,
            'idea_id' => $idea->id,
            'comment' => request('comment'),
        ]);

        return redirect()->route('ideas.show', $idea)->with('success', 'Comment posted Successfully!');
    }
}