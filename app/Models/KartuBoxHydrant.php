<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KartuBoxHydrant extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tgl_periksa' => 'date',
    ];

    public function boxHydrant(): BelongsTo
    {
        return $this->belongsTo(BoxHydrant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
