<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id_db_1' => $this->user_id_db_1,
            'file_type' => $this->file_type,
            'file_name' => $this->file_name,
            'file_number' => $this->file_number,
            'file_path' => $this->file_path,
            'issued_date' => $this->issued_date,
            'expired_date' => $this->expired_date,
            'notes' => $this->notes,
        ];
    }
}
