<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

trait JwtUserTrait
{
    protected function getUserFromToken(Request $request): array
    {
        $payload = $request->attributes->get('jwt_payload');

        return [
            'id' => $payload->get('sub'),
            'nama' => $payload->get('nama'),
            'nip' => $payload->get('nip'),
            'divisi' => $payload->get('divisi') ?? null,
            'department_id' => $payload->get('department_id'),
        ];
    }
}
