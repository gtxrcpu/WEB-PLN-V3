<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KartuApab extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tgl_periksa' => 'date',
    ];

    public function apab(): BelongsTo
    {
        return $this->belongsTo(Apab::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
