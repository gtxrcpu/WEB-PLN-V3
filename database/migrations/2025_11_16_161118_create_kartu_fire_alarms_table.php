<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_fire_alarms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fire_alarm_id')->constrained('fire_alarms')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('panel_kontrol');
            $table->string('detector');
            $table->string('manual_call_point');
            $table->string('alarm_bell');
            $table->string('battery_backup');
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
        Schema::dropIfExists('kartu_fire_alarms');
    }
};
