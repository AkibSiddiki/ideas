<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store()
    {
        // dump(request()->all());
        request()->validate([
            "idea" => "required|min:2|max:240",
        ]);
        idea::create(['idea' => request()->get('idea', null)]);
        return   redirect()->route('dashboard')->with('success', 'Idea created Successfully!');
    }
}