<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Storage;

class QrService
{
    /**
     * Generate QR sebagai SVG string dan simpan ke storage/app/public/<dir>/<safe>.svg
     * @return string path relatif pada disk 'public' (mis. qrcodes/APR-250101-ABC123.svg)
     */
    public static function makeAndStore(string $text, string $dir = 'qrcodes'): string
    {
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_Q,   // koreksi error menengah
            'scale'      => 6,               // ukuran modul
            'imageBase64'=> false,
            'markupDark' => '#0f172a',       // slate-900
            'markupLight'=> 'transparent',
            'quietzoneSize' => 2,
        ]);

        $svg = (new QRCode($options))->render($text);

        $safe = preg_replace('/[^A-Za-z0-9_\-]/', '_', $text);
        $path = "{$dir}/{$safe}.svg";

        Storage::disk('public')->put($path, $svg);
        return $path;
    }
}
