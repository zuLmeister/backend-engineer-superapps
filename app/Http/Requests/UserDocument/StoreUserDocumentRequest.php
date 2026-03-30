<?php

namespace App\Http\Requests\UserDocument;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id_db_1' => ['required', 'integer'],
            'file_type' => ['required', 'in:mcu,medpass,sertif_training,sertif_bnsp'],
            'file_name' => ['required', 'string', 'max:100'],
            'file_number' => ['nullable', 'string', 'max:100'],
            'file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'issued_date' => ['required', 'date'],
            'expired_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
