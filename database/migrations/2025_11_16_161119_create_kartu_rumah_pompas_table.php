<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_rumah_pompas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rumah_pompa_id')->constrained('rumah_pompas')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('pompa_utama');
            $table->string('pompa_cadangan');
            $table->string('jockey_pump');
            $table->string('panel_kontrol');
            $table->string('uji_fungsi');
            $table->string('kesimpulan');
            $table->date('tgl_periksa');
            $table->string('petugas');
            $table->string('pengawas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_rumah_pompas');
    }
};
