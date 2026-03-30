<?php

namespace App\Http\Controllers\RegulasiPerusahaan;

use App\Http\Controllers\Controller;
use App\Services\RegulasiPerusahaan\RegulasiPerusahaanService;
use App\Http\Requests\RegulasiPerusahaan\StoreRegulasiPerusahaanRequest;
use App\Http\Requests\RegulasiPerusahaan\UpdateRegulasiPerusahaanRequest;
use App\Http\Resources\RegulasiPerusahaanResource;
use App\Models\RegulasiPerusahaan;
use Illuminate\Http\JsonResponse;

class RegulasiPerusahaanController extends Controller
{
    protected RegulasiPerusahaanService $service;

    public function __construct(RegulasiPerusahaanService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();

        return response()->json([
            'success' => true,
            'message' => 'RegulasiPerusahaan list retrieved successfully.',
            'data' => RegulasiPerusahaanResource::collection($data),
        ]);
    }

    public function store(StoreRegulasiPerusahaanRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());

        return response()->json(
            [
                'success' => true,
                'message' => 'RegulasiPerusahaan created successfully.',
                'data' => new RegulasiPerusahaanResource($data),
            ],
            201,
        );
    }

    public function show(RegulasiPerusahaan $regulasiPerusahaan): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'RegulasiPerusahaan retrieved successfully.',
            'data' => new RegulasiPerusahaanResource($regulasiPerusahaan),
        ]);
    }

    public function update(
        UpdateRegulasiPerusahaanRequest $request,
        RegulasiPerusahaan $regulasiPerusahaan,
    ): JsonResponse {
        $data = $this->service->update($regulasiPerusahaan, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'RegulasiPerusahaan updated successfully.',
            'data' => new RegulasiPerusahaanResource($data),
        ]);
    }

    public function destroy(RegulasiPerusahaan $regulasiPerusahaan): JsonResponse
    {
        $this->service->delete($regulasiPerusahaan);

        return response()->json([
            'success' => true,
            'message' => 'RegulasiPerusahaan deleted successfully.',
            'data' => null,
        ]);
    }
}
