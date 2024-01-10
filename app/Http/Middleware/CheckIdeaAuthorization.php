<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIdeaAuthorization
{
    public function handle(Request $request, Closure $next)
    {

        return $next($request);
    }
}