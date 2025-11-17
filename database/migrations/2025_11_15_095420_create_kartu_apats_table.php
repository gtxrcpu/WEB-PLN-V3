<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_apats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apat_id')->constrained('apats')->onDelete('cascade');

            // Komponen pemeriksaan
            $table->string('kondisi_fisik');   // baik / tidak baik
            $table->string('drum');
            $table->string('aduk_pasir');
            $table->string('sekop');
            $table->string('fire_blanket');
            $table->string('ember');

            // Kesimpulan & meta
            $table->string('kesimpulan');      // baik / tidak baik
            $table->date('tgl_periksa');
            $table->date('tgl_surat');
            $table->string('petugas')->nullable();
            $table->string('pengawas')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_apats');
    }
};
