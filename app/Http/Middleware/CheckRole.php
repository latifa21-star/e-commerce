<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$request->user() || !$request->user()->role) {
            return redirect('/');
        }

        $userRole = $request->user()->role->name;
        
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès non autorisé');
    }
}