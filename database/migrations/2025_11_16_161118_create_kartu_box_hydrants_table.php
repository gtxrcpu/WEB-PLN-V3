<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_box_hydrants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_hydrant_id')->constrained('box_hydrants')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('pilar_hydrant');
            $table->string('box_hydrant');
            $table->string('nozzle');
            $table->string('selang');
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
        Schema::dropIfExists('kartu_box_hydrants');
    }
};
