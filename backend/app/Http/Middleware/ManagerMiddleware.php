<?php

// ManagerMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() && auth()->user()->role === 'manager') {
            return $next($request);
        }
        return response()->json(['message' => 'Acesso não autorizado.'], 403);
    }
}

