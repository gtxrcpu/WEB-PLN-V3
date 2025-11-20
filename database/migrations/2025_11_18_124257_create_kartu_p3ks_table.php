<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_p3ks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p3k_id')->constrained('p3ks')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            // Komponen pemeriksaan P3K
            $table->string('kotak_p3k');           // baik / rusak
            $table->string('plester');             // lengkap / tidak_lengkap / kadaluarsa
            $table->string('perban');              // lengkap / tidak_lengkap / kadaluarsa
            $table->string('kasa_steril');         // lengkap / tidak_lengkap / kadaluarsa
            $table->string('antiseptik');          // lengkap / tidak_lengkap / kadaluarsa
            $table->string('gunting');             // ada / tidak_ada
            $table->string('sarung_tangan');       // lengkap / tidak_lengkap / kadaluarsa
            $table->string('masker');              // lengkap / tidak_lengkap / kadaluarsa
            $table->string('obat_luka');           // lengkap / tidak_lengkap / kadaluarsa
            $table->string('buku_panduan');        // ada / tidak_ada
            
            // Kesimpulan & meta
            $table->string('kesimpulan');          // lengkap / tidak_lengkap
            $table->date('tgl_periksa');
            $table->string('petugas');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_p3ks');
    }
};
