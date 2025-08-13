<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyGuests
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return redirect()->route('/');
        }

        return $next($request);
    }

}
