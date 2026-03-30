<?php

namespace App\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class GenericUser extends Authenticatable
{
    protected $fillable = ['id', 'nama', 'nip', 'department_id', 'divisi'];

    public $timestamps = false;
    protected $table = null;
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function save(array $options = [])
    {
        return false;
    }
}
