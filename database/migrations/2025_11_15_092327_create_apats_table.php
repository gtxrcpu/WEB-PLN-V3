<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apats', function (Blueprint $table) {
            $table->id();

            // siapa yang input (boleh null)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // data utama APAT
            $table->string('name');                 // Nama APAT (label)
            $table->string('barcode')->unique();    // "APAT A2.001"
            $table->string('serial_no')->nullable(); // "A2.001" (opsional)

            $table->string('lokasi')->nullable();    // lokasi fisik
            $table->string('jenis')->nullable();     // jenis alat tradisional
            $table->string('kapasitas')->nullable(); // misal jumlah drum / ember

            $table->string('status', 50)->default('baik'); // BAik / Rusak / dll
            $table->text('notes')->nullable();

            // path file QR di public (storage/qr/apat-1.svg)
            $table->string('qr_svg_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apats');
    }
};
