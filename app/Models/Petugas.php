<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    
    protected $fillable = [
        'name',
        'nip',
        'phone',
        'email',
        'position',
        'department',
        'address',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
