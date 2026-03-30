<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RegulasiPerusahaan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'regulasi_perusahaan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'nomor',
        'tipe',
        'status',
        'tanggal_terbit',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'created_by',
        'updated_by',
    ];
}
