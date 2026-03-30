<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Auth\GenericUser;

class JwtFromDb1
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->bearerToken();

            if (!$token) {
                return response()->json(['message' => 'Token not provided'], 401);
            }

            $payload = JWTAuth::setToken($token)->getPayload();

            $genericUser = new GenericUser([
                'id' => $payload->get('sub'),
                'nama' => $payload->get('nama'),
                'nip' => $payload->get('nip'),
                'department_id' => $payload->get('department_id'),
                'divisi' => $payload->get('divisi') ?? null,
            ]);

            auth()->setUser($genericUser);

            $request->attributes->set('jwt_payload', $payload);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Invalid token: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
