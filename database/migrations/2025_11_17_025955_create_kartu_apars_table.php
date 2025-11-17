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
        Schema::create('kartu_apars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apar_id')->constrained('apars')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            // Komponen pemeriksaan APAR
            $table->string('pressure_gauge');      // baik / tidak_baik
            $table->string('pin_segel');           // baik / tidak_baik
            $table->string('selang');              // baik / tidak_baik
            $table->string('tabung');              // baik / tidak_baik / berkarat
            $table->string('label');               // baik / tidak_baik / pudar
            $table->string('kondisi_fisik');       // baik / tidak_baik
            
            // Kesimpulan & meta
            $table->string('kesimpulan');          // baik / tidak_baik
            $table->date('tgl_periksa');
            $table->string('petugas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_apars');
    }
};
