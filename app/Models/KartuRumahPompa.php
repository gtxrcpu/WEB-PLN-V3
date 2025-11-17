<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KartuRumahPompa extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tgl_periksa' => 'date',
    ];

    public function rumahPompa(): BelongsTo
    {
        return $this->belongsTo(RumahPompa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
