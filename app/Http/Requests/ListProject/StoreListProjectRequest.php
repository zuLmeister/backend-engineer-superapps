<?php

namespace App\Http\Requests\ListProject;

use Illuminate\Foundation\Http\FormRequest;


class StoreListProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pjo_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:15'],
            'location' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'project_type' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:pending,active,completed,cancelled'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
