<?php

namespace App\Http\Controllers;

use App\Http\Requests\commentRequest;
use App\Models\comment;
use App\Models\idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(commentRequest $request, idea $idea)
    {
        $request->validated;

        comment::create([
            'user_id' => auth()->user()->id,
            'idea_id' => $idea->id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('ideas.show', $idea)->with('success', 'Comment posted Successfully!');
    }
}
