<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id_db_1' => ['required', 'integer'],
            'document_type' => ['required', 'in:award,certificate'],
            'document_name' => ['required', 'string', 'max:100'],
            'document_number' => ['nullable', 'string', 'max:100'],
            'file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'issued_date' => ['required', 'date'],
            'expired_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
