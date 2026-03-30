<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id_db_1' => ['sometimes', 'integer'],
            'document_type' => ['sometimes', 'in:award,certificate'],
            'document_name' => ['sometimes', 'string', 'max:100'],
            'document_number' => ['sometimes', 'nullable', 'string', 'max:100'],
            'file' => ['sometimes', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'issued_date' => ['sometimes', 'date'],
            'expired_date' => ['sometimes', 'date'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
