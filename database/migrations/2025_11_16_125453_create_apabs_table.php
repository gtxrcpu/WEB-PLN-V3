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
        Schema::create('apabs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('serial_no')->nullable()->unique();
            $table->string('barcode')->nullable()->unique();
            $table->string('location_code')->nullable();
            $table->string('isi_apab')->nullable(); // CO2, Foam, dll
            $table->string('capacity')->nullable(); // 25 Kg, 50 Kg
            $table->date('masa_berlaku')->nullable();
            $table->string('status')->nullable(); // baik, tidak_baik
            $table->string('qr_svg_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apabs');
    }
};
