<?php

namespace App\Console\Commands;

use App\Models\Apat;
use Illuminate\Console\Command;

class ApatQrBackfill extends Command
{
    /**
     * Nama command artisan.
     *
     * Contoh pemakaian:
     *  php artisan apat:qr-backfill
     *  php artisan apat:qr-backfill --force
     */
    protected $signature = 'apat:qr-backfill {--force : Regenerate semua QR APAT meskipun sudah ada}';

    protected $description = 'Generate / regenerate QR SVG untuk semua data APAT';

    public function handle(): int
    {
        $this->info('Generate QR untuk semua APAT...');

        $query = Apat::query();

        // Default: hanya yang qr_svg_path masih null / kosong
        if (! $this->option('force')) {
            $query->whereNull('qr_svg_path');
        }

        $total = 0;

        $query->chunkById(100, function ($apats) use (&$total) {
            foreach ($apats as $apat) {
                $label = $apat->barcode ?? $apat->serial_no ?? ('ID ' . $apat->id);
                $this->line(" - APAT ID {$apat->id} ({$label}) ...");

                $apat->refreshQrSvg();
                $total++;
            }
        });

        if ($total === 0) {
            $this->info('Tidak ada APAT yang perlu digenerate (tabel kosong atau semua sudah punya QR).');
        } else {
            $this->info("Selesai. {$total} QR APAT dibuat/diperbarui.");
        }

        return self::SUCCESS;
    }
}
