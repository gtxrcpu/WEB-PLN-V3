<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_apabs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apab_id')->constrained('apabs')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('pressure_gauge');
            $table->string('pin_segel');
            $table->string('selang');
            $table->string('klem_selang');
            $table->string('handle');
            $table->string('kondisi_fisik');
            $table->string('kesimpulan');
            $table->date('tgl_periksa');
            $table->string('petugas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_apabs');
    }
};
