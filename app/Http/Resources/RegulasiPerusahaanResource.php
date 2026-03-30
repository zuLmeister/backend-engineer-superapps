<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegulasiPerusahaanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'nomor' => $this->nomor,
            'tipe' => $this->tipe,
            'status' => $this->status,
            'tanggal_terbit' => $this->tanggal_terbit,
            'tanggal_berlaku' => $this->tanggal_berlaku,
            'tanggal_berakhir' => $this->tanggal_berakhir,
        ];
    }
}
