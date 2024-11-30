<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureSessionWithToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('api/login') || $request->is('api/logout') || $request->is('api/contato')) {
            return $next($request);
        }

        $token = $request->bearerToken();
        if (!$token) {
            return response()->json([
                'message' => 'JWT not sent',
            ], 400); // Bad Request
        }

        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid token or user not authenticated',
            ], 400); // Bad Request
        }

        session(['user_id' => $user->id]);

        return $next($request);
    }
}
