<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kartu_templates', function (Blueprint $table) {
            $table->id();
            $table->string('module')->unique(); // apar, apat, fire-alarm, dll
            $table->string('title'); // KARTU KENDALI
            $table->string('subtitle'); // ALAT PEMADAM API RINGAN (APAR)
            $table->json('header_fields'); // No. Dokumen, Revisi, dll
            $table->json('inspection_fields'); // Field pemeriksaan
            $table->json('footer_fields'); // Lokasi, TTD, dll
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default template for APAR
        DB::table('kartu_templates')->insert([
            'module' => 'apar',
            'title' => 'KARTU KENDALI',
            'subtitle' => 'ALAT PEMADAM API RINGAN (APAR)',
            'header_fields' => json_encode([
                ['key' => 'no_dokumen', 'label' => 'No. Dokumen', 'value' => 'FR.04-PT.20.K3L'],
                ['key' => 'revisi', 'label' => 'Revisi', 'value' => '05'],
                ['key' => 'tanggal', 'label' => 'Tanggal', 'value' => '24 Januari 2025'],
                ['key' => 'halaman', 'label' => 'Halaman', 'value' => '1 dari 1 halaman'],
            ]),
            'inspection_fields' => json_encode([
                ['key' => 'kondisi_tabung', 'label' => 'Kondisi Tabung', 'type' => 'checkbox'],
                ['key' => 'kondisi_selang', 'label' => 'Kondisi Selang', 'type' => 'checkbox'],
                ['key' => 'kondisi_pin', 'label' => 'Kondisi Pin Pengaman', 'type' => 'checkbox'],
                ['key' => 'tekanan', 'label' => 'Tekanan', 'type' => 'text'],
                ['key' => 'berat', 'label' => 'Berat', 'type' => 'text'],
                ['key' => 'catatan', 'label' => 'Catatan', 'type' => 'textarea'],
            ]),
            'footer_fields' => json_encode([
                ['key' => 'lokasi', 'label' => 'Lokasi', 'value' => 'Surabaya'],
                ['key' => 'petugas_label', 'label' => 'Label Petugas', 'value' => 'Petugas Pemeriksa'],
                ['key' => 'pimpinan_label', 'label' => 'Label Pimpinan', 'value' => 'Mengetahui'],
            ]),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_templates');
    }
};
