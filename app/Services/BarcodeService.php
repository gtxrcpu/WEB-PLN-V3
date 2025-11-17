<?php

namespace App\Services;

use Picqer\Barcode\BarcodeGeneratorSVG;
use Illuminate\Support\Facades\Storage;

class BarcodeService
{
    public static function makeAndStore(string $code, string $dir = 'barcodes'): string
    {
        $gen = new BarcodeGeneratorSVG();
        $svg = $gen->getBarcode($code, $gen::TYPE_CODE_128, 2, 60); // scale & height

        $safe = preg_replace('/[^A-Za-z0-9_\-]/', '_', $code);
        $path = "{$dir}/{$safe}.svg";                    // public/barcodes/<code>.svg
        Storage::disk('public')->put($path, $svg);      // simpan ke storage/app/public

        return $path; // simpan path ini ke DB (kolom barcode_svg_path)
    }
}
