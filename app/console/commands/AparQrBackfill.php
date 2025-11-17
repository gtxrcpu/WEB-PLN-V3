<?php

namespace App\Console\Commands;

use App\Models\Apar;
use Illuminate\Console\Command;

class AparQrBackfill extends Command
{
    /**
     * Nama perintah artisan.
     */
    protected $signature = 'apar:qr-backfill';

    /**
     * Deskripsi.
     */
    protected $description = 'Generate / refresh QR SVG untuk semua APAR';

    public function handle(): int
    {
        $this->info('Generate QR untuk semua APAR...');

        Apar::orderBy('id')->chunk(50, function ($chunk) {
            foreach ($chunk as $apar) {
                $this->line(" - APAR ID {$apar->id} ({$apar->barcode}) ...");

                // Panggil helper di model
                $apar->refreshQrSvg();
            }
        });

        $this->info('Selesai.');

        return static::SUCCESS;
    }
}
