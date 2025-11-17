<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuApar extends Model
{
    use HasFactory;

    protected $table = 'kartu_apars';

    protected $fillable = [
        'apar_id',
        'user_id',
        'pressure_gauge',
        'pin_segel',
        'selang',
        'tabung',
        'label',
        'kondisi_fisik',
        'kesimpulan',
        'tgl_periksa',
        'petugas',
    ];

    protected $casts = [
        'tgl_periksa' => 'date',
    ];

    /**
     * Relasi ke APAR
     */
    public function apar()
    {
        return $this->belongsTo(Apar::class, 'apar_id');
    }

    /**
     * Relasi ke User yang menginput
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
