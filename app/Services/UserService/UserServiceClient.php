<?php

namespace App\Services\UserService;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class UserServiceClient
{
    public function all(): array
    {
        return Cache::remember('all_users_list', 3600, function () {
            $response = Http::timeout(5)
                ->retry(2, 200)
                ->withToken(request()->bearerToken())
                ->get(config('services.user_service.url') . '/users');

            if (!$response->successful()) {
                throw new \Exception('Gagal mengambil data dari User Service');
            }

            return $response->json();
        });
    }
}
