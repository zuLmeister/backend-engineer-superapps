<?php

namespace App\Services\Document;

use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function getAll(int $perPage = 10)
    {
        return Document::with([])->paginate($perPage);
    }

    public function getDocumentsByUserIds(array $userIds)
    {
        return Document::get();
    }

    public function store(array $data): Document
    {
        return DB::transaction(function () use ($data) {
            if (isset($data['file'])) {
                $data['document_path'] = $data['file']->store('internal/documents', 'public');
            }

            $document = Document::create($data);

            return $document->load([]);
        });
    }

    public function update(Document $document, array $data): Document
    {
        return DB::transaction(function () use ($document, $data) {
            if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
                if (
                    $document->document_path &&
                    Storage::disk('public')->exists($document->document_path)
                ) {
                    Storage::disk('public')->delete($document->document_path);
                }

                $data['document_path'] = $data['file']->store('internal/documents', 'public');

                unset($data['file']);
            }

            $document->update($data);

            return $document->fresh();
        });
    }

    public function delete(Document $document): void
    {
        DB::transaction(function () use ($document) {
            $document->delete();
        });
    }
}
