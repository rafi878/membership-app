<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMembership
{
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->membership_type, $types)) {
            abort(403, 'Access denied. Your membership level does not have permission to access this resource.');
        }

        return $next($request);
    }
}