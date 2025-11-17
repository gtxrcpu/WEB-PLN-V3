<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKendali extends Model
{
    use HasFactory;

    // SESUAIKAN dengan nama tabel di database kamu
    protected $table = 'kartu_kendali'; // kalau di DB namanya lain, ganti di sini

    protected $fillable = [
        'apar_id',
        'pg',
        'pin',
        'selang',
        'klem',
        'handle',
        'fisik',
        'kesimpulan',
        'masa_berlaku',
        'tgl_periksa',
        'tgl_surat',
        'petugas',
        'pengawas',
    ];

    protected $casts = [
        'tgl_periksa' => 'date',
        'tgl_surat'   => 'date',
    ];

    public function apar()
    {
        return $this->belongsTo(Apar::class, 'apar_id');
    }
}
