<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftarkan semua command custom di sini.
     */
    protected $commands = [
        \App\Console\Commands\AparQrBackfill::class, // kalau sudah ada
        \App\Console\Commands\ApatQrBackfill::class, // APAT QR backfill
    ];

    /**
     * Jadwal artisan (optional, bisa dikosongkan).
     */
    protected function schedule(Schedule $schedule): void
    {
        // Contoh (optional):
        // $schedule->command('apat:qr-backfill')->monthly();
    }

    /**
     * Load routes/console.php dll.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
