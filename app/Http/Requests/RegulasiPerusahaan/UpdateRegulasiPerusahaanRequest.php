<?php

namespace App\Http\Requests\RegulasiPerusahaan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRegulasiPerusahaanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['sometimes', 'string', 'max:100'],

            'deskripsi' => ['sometimes', 'nullable', 'string'],

            'nomor' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('regulasi_perusahaan', 'nomor')->ignore(
                    optional($this->route('regulasiPerusahaan'))->id,
                ),
            ],

            'tipe' => ['sometimes', Rule::in(['peraturan', 'kebijakan'])],

            'status' => ['sometimes', Rule::in(['Y', 'N'])],

            'tanggal_terbit' => ['sometimes', 'date'],

            'tanggal_berlaku' => ['sometimes', 'nullable', 'date', 'after_or_equal:tanggal_terbit'],

            'tanggal_berakhir' => [
                'sometimes',
                'nullable',
                'date',
                'after_or_equal:tanggal_berlaku',
            ],

            'created_by' => ['sometimes', 'integer'],

            'updated_by' => ['sometimes', 'nullable', 'integer'],
        ];
    }
}
