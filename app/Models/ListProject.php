<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ListProject extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'list_project';

    protected $fillable = [
        'pjo_name',
        'phone',
        'location',
        'position',
        'status',
        'start_date',
        'end_date',
        'notes',
        'project_type'
    ];







}
