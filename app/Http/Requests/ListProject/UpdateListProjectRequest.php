<?php

namespace App\Http\Requests\ListProject;

use Illuminate\Foundation\Http\FormRequest;


class UpdateListProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pjo_name' => ['sometimes', 'string', 'max:100'],
            'phone' => ['sometimes', 'string', 'max:15'],
            'location' => ['sometimes', 'string', 'max:100'],
            'position' => ['sometimes', 'string', 'max:100'],
            'status' => ['sometimes', 'in:pending,active,completed,cancelled'],
            'start_date' => ['sometimes', 'date'],
            'end_date' => ['sometimes', 'date'],
            'notes' => ['nullable','sometimes', 'string'],
            'project_type' => ['sometimes', 'string', 'max:50'],
        ];
    }
}
