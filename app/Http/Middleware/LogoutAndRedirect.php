<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogoutAndRedirect
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            Auth::logout();
            return redirect('/login');
        }


    }
}




