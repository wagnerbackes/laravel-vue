<?php

// EmployeeMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user && $user->role === 'employee') {
            if ($request->is('api/enrollments') || $request->is('api/users/' . $user->id)) {
                return $next($request);
            }
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }
        return response()->json(['message' => 'Acesso não autorizado.'], 403);
    }
}

