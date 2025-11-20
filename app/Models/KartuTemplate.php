<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuTemplate extends Model
{
    protected $fillable = [
        'module',
        'title',
        'subtitle',
        'header_fields',
        'inspection_fields',
        'footer_fields',
        'is_active'
    ];

    protected $casts = [
        'header_fields' => 'array',
        'inspection_fields' => 'array',
        'footer_fields' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getTemplate($module)
    {
        return self::where('module', $module)->where('is_active', true)->first();
    }

    public static function getModules()
    {
        return [
            'apar' => 'APAR - Alat Pemadam Api Ringan',
            'apat' => 'APAT - Alat Pemadam Api Tradisional',
            'apab' => 'APAB - Alat Pemadam Api Berat',
            'fire-alarm' => 'Fire Alarm - Panel & Titik Alarm',
            'box-hydrant' => 'Box Hydrant - Box, Hose, Nozzle',
            'rumah-pompa' => 'Rumah Pompa - Hydrant Rumah Pompa',
            'p3k' => 'P3K - Kotak & Isi P3K',
        ];
    }
}
