<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KartuFireAlarm extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tgl_periksa' => 'date',
    ];

    public function fireAlarm(): BelongsTo
    {
        return $this->belongsTo(FireAlarm::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
