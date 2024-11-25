<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $role = null): Response
    {
        if ($request->user()->role_id === User::ADMIN_ROLE) {
            return $next($request);
        }

        if ($request->user()->role_id === $role) {
            return $next($request);
        }

        throw new AuthorizationException('Access denied');
    }
}
