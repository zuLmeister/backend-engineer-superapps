<?php

namespace App\Services\RegulasiPerusahaan;

use App\Models\RegulasiPerusahaan;
use Illuminate\Support\Facades\DB;

class RegulasiPerusahaanService
{
    public function getAll(int $perPage = 10)
    {
        return RegulasiPerusahaan::with([])->paginate($perPage);
    }

    public function store(array $data): RegulasiPerusahaan
    {
        return DB::transaction(function () use ($data) {
            $regulasiPerusahaan = RegulasiPerusahaan::create($data);

            return $regulasiPerusahaan->load([]);
        });
    }

    public function update(RegulasiPerusahaan $regulasiPerusahaan, array $data): RegulasiPerusahaan
    {
        return DB::transaction(function () use ($regulasiPerusahaan, $data) {
            $regulasiPerusahaan->update($data);

            return $regulasiPerusahaan->load([]);
        });
    }

    public function delete(RegulasiPerusahaan $regulasiPerusahaan): void
    {
        DB::transaction(function () use ($regulasiPerusahaan) {
            $regulasiPerusahaan->delete();
        });
    }
}
