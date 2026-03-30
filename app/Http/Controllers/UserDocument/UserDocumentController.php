<?php

namespace App\Http\Controllers\UserDocument;

use App\Http\Controllers\Controller;
use App\Services\UserDocument\UserDocumentService;
use App\Http\Requests\UserDocument\StoreUserDocumentRequest;
use App\Http\Requests\UserDocument\UpdateUserDocumentRequest;
use App\Http\Resources\UserDocumentResource;
use App\Models\UserDocument;
use App\Services\UserService\UserServiceClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserDocumentController extends Controller
{
    protected UserDocumentService $service;

    public function __construct(UserDocumentService $service)
    {
        $this->service = $service;

        $this->authorizeResource(UserDocument::class, 'userDocument');
    }

    public function index(UserServiceClient $userClient, UserDocumentService $service): JsonResponse
    {
        try {
            $usersFromApi = $userClient->all();
            $userCollection = collect($usersFromApi);

            $userIds = $userCollection->pluck('id')->toArray();

            $groupedDocuments = $service->getDocumentsByUserIds($userIds);

            // 4. Transformasi data
            $combinedData = $userCollection->map(function ($user) use ($groupedDocuments) {
                $userId = $user['id'];

                return [
                    'user' => [
                        'id' => $userId,
                        'nama' => $user['nama'] ?? null,
                        'nip' => $user['nip'] ?? null,
                        'departmentname' => $user['department']['name'] ?? null,
                        'jabatanname' =>
                            $user['jabatan']['name'] ?? ($user['jabatan']['jabatan'] ?? null),
                        'lokasiname' => $user['lokasi']['name'] ?? null,
                        'projectname' => $user['project']['name'] ?? null,
                    ],
                    'documents' => UserDocumentResource::collection(
                        $groupedDocuments->get($userId, collect()),
                    ),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $combinedData,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function store(StoreUserDocumentRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data = array_merge($data, [
            'created_by' => $request->user()->id,
            'file' => $request->file('file'),
        ]);

        $result = $this->service->store($data);

        return (new UserDocumentResource($result))
            ->additional([
                'success' => true,
                'message' => 'UserDocument created successfully.',
            ])
            ->response()
            ->setStatusCode(201);
    }

    public function show(UserDocument $userDocument): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'UserDocument retrieved successfully.',
            'data' => new UserDocumentResource($userDocument),
            'user' => auth()->user(),
        ]);
    }

    public function update(
        UpdateUserDocumentRequest $request,
        UserDocument $userDocument,
    ): JsonResponse {
        try {
            $data = $request->validated();

            $data['updated_by'] = auth()->id();

            $result = $this->service->update($userDocument, $data);

            return response()->json([
                'success' => true,
                'message' => 'User Document updated successfully.',
                'data' => new UserDocumentResource($result),
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

    public function destroy(UserDocument $userDocument): JsonResponse
    {
        $this->service->delete($userDocument);

        return response()->json([
            'success' => true,
            'message' => 'UserDocument deleted successfully.',
            'data' => null,
            'deleted_by' => auth()->id(),
        ]);
    }
}
