<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id_db_1' => $this->user_id_db_1,
            'document_type' => $this->document_type,
            'document_name' => $this->document_name,
            'document_number' => $this->document_number,
            'document_path' => $this->document_path,
            'issued_date' => $this->issued_date,
            'expired_date' => $this->expired_date,
            'notes' => $this->notes,
        ];
    }
}
