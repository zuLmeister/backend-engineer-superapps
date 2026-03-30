<?php

namespace App\Services\UserDocument;

use App\Models\UserDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserDocumentService
{
    public function getAll(int $perPage = 10)
    {
        return UserDocument::with([])->paginate($perPage);
    }

    public function getDocumentsByUserIds(array $userIds)
    {
        return UserDocument::whereIn('user_id_db_1', $userIds)->get()->groupBy('user_id_db_1');
    }

    public function store(array $data): UserDocument
    {
        return DB::transaction(function () use ($data) {
            if (isset($data['file'])) {
                $data['file_path'] = $data['file']->store('identities/documents', 'public');
            }

            $userDocument = UserDocument::create($data);

            return $userDocument->load([]);
        });
    }

    public function update(UserDocument $userDocument, array $data): UserDocument
    {
        return DB::transaction(function () use ($userDocument, $data) {
            if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
                if (
                    $userDocument->file_path &&
                    Storage::disk('public')->exists($userDocument->file_path)
                ) {
                    Storage::disk('public')->delete($userDocument->file_path);
                }

                $data['file_path'] = $data['file']->store('identities/documents', 'public');

                unset($data['file']);
            }

            $userDocument->update($data);

            return $userDocument->fresh();
        });
    }

    public function delete(UserDocument $userDocument): void
    {
        DB::transaction(function () use ($userDocument) {
            $userDocument->delete();
        });
    }
}
