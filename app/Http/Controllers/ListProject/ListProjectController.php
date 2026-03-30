<?php

namespace App\Http\Controllers\ListProject;

use App\Http\Controllers\Controller;
use App\Models\ListProject;
use App\Services\ListProject\ListProjectService;
use App\Http\Requests\ListProject\StoreListProjectRequest;
use App\Http\Requests\ListProject\UpdateListProjectRequest;
use App\Http\Resources\ListProject\ListProjectResource;
use Illuminate\Http\JsonResponse;

class ListProjectController extends Controller
{
    protected ListProjectService $service;

    public function __construct(ListProjectService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();

        return response()->json([
            'success' => true,
            'message' => 'ListProject list retrieved successfully.',
            'data' => ListProjectResource::collection($data),
        ]);
    }

    public function store(StoreListProjectRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'ListProject created successfully.',
            'data' => new ListProjectResource($data),
        ], 201);
    }

    public function show(ListProject $listProject): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'ListProject retrieved successfully.',
            'data' => new ListProjectResource($listProject),
        ]);
    }

    public function update(UpdateListProjectRequest $request, ListProject $listProject): JsonResponse
    {
        $data = $this->service->update($listProject, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'ListProject updated successfully.',
            'data' => new ListProjectResource($data),
        ]);
    }

    public function destroy(ListProject $listProject): JsonResponse
    {
        $this->service->delete($listProject);

        return response()->json([
            'success' => true,
            'message' => 'ListProject deleted successfully.',
            'data' => null,
        ]);
    }
}
