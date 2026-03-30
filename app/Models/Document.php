<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'documents';

    protected $fillable = [
        'user_id_db_1',
        'document_type',
        'document_name',
        'document_number',
        'document_path',
        'issued_date',
        'expired_date',
        'notes',
    ];
}
