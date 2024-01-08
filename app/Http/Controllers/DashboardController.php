<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = idea::orderBy("created_at", "desc")->paginate(3);
        return view("dashboard", compact('ideas'));
    }
}
