<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id_db_1',
        'file_type',
        'file_name',
        'file_number',
        'file_path',
        'issued_date',
        'expired_date',
        'notes',
    ];
}
