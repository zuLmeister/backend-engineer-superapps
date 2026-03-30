<?php

namespace App\Http\Requests\RegulasiPerusahaan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegulasiPerusahaanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'nomor' => ['required', 'string', 'max:50', 'unique:regulasi_perusahaan,nomor'],
            'tipe' => ['required', 'in:peraturan,kebijakan'],
            'status' => ['required', 'in:Y,N'],
            'tanggal_terbit' => ['required', 'date'],
            'tanggal_berlaku' => ['nullable', 'date'],
            'tanggal_berakhir' => ['nullable', 'date'],
            'created_by' => ['required', 'integer'],
            'updated_by' => ['nullable', 'integer'],
        ];
    }
}
