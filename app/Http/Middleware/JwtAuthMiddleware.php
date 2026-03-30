<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class JwtAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Ambil token dari header Authorization: Bearer <token>
            $token = $request->bearerToken();
            if (!$token) {
                return response()->json(['message' => 'Token not provided'], 401);
            }

            // Decode token (tanpa query DB)
            $payload = JWTAuth::setToken($token)->getPayload();

            // Bisa simpan user info di request
            $request->attributes->add(['jwt_payload' => $payload]);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Token invalid or expired'], 401);
        }

        return $next($request);
    }
}
