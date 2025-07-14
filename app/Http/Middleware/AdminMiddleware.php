<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if ($user->email === 'dashboardadmin@medical.com' || 
            str_contains($user->email, 'dashboardadmin') || 
            $user->name === 'Dashboard Admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized access. Admin only.');
    }
}