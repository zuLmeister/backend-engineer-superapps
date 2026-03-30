<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Services\Document\DocumentService;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    protected DocumentService $service;

    public function __construct(DocumentService $service)
    {
        $this->service = $service;

        $this->authorizeResource(Document::class, 'document');
    }

    public function index(DocumentService $service): JsonResponse
{
    $documents = $service->getAll();

    return response()->json([
        'success' => true,
        'data' => DocumentResource::collection($documents),
    ]);
}

    public function store(StoreDocumentRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data = array_merge($data, [
            'created_by' => $request->user()->id,
            'file' => $request->file('file'),
        ]);

        $result = $this->service->store($data);

        return (new DocumentResource($result))
            ->additional([
                'success' => true,
                'message' => 'Document created successfully.',
            ])
            ->response()
            ->setStatusCode(201);
    }

    public function show(Document $document): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Document retrieved successfully.',
            'data' => new DocumentResource($document),
            'user' => auth()->user(),
        ]);
    }

    public function update(
        UpdateDocumentRequest $request,
        Document $document,
    ): JsonResponse {
        try {
            $data = $request->validated();

            $data['updated_by'] = auth()->id();

            $result = $this->service->update($document, $data);

            return response()->json([
                'success' => true,
                'message' => 'User Document updated successfully.',
                'data' => new DocumentResource($result),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Update failed: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function destroy(Document $document): JsonResponse
    {
        $this->service->delete($document);

        return response()->json([
            'success' => true,
            'message' => 'Document deleted successfully.',
            'data' => null,
            'deleted_by' => auth()->id(),
        ]);
    }
}
