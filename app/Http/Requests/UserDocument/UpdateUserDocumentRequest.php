<?php

namespace App\Http\Requests\UserDocument;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id_db_1' => ['sometimes', 'integer'],
            'file_type' => ['sometimes', 'in:mcu,medpass,sertif_training,sertif_bnsp'],
            'file_name' => ['sometimes', 'string', 'max:100'],
            'file_number' => ['sometimes', 'nullable', 'string', 'max:100'],
            'file' => ['sometimes', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'issued_date' => ['sometimes', 'date'],
            'expired_date' => ['sometimes', 'date'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
