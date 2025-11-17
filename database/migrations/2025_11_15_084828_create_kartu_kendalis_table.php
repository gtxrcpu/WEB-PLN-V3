<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_kendalis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apar_id')
                  ->constrained('apars')
                  ->cascadeOnDelete();

            // Kolom-kolom pemeriksaan
            $table->string('pg')->nullable();       // Pressure Gauge
            $table->string('pin')->nullable();
            $table->string('selang')->nullable();
            $table->string('klem')->nullable();
            $table->string('handle')->nullable();
            $table->string('fisik')->nullable();
            $table->string('kesimpulan')->nullable(); // BAIK / TIDAK BAIK

            $table->date('tgl_periksa')->nullable();
            $table->date('tgl_surat')->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_kendalis');
    }
};
