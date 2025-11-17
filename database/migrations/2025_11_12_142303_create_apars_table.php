<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('apars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // pemilik/penginput
            $table->string('name', 120);
            $table->string('barcode', 64)->unique();       // CODE128/EAN13/QR yang dipakai
            $table->string('serial_no', 64)->nullable();    // nomor seri pabrik
            $table->string('type', 32)->nullable();         // Dry Chemical, CO2, Foam, dll.
            $table->string('capacity', 32)->nullable();     // mis. 3 kg, 6 kg
            $table->string('agent', 32)->nullable();        // isi media: Powder/CO2/Foam
            $table->string('location_code', 80)->nullable();// kode lokasi internal (gudang/lantai)
            $table->timestamp('last_inspection_at')->nullable();
            $table->timestamp('next_inspection_at')->nullable();
            $table->enum('status', ['baik','rusak','perbaikan','dipensiunkan'])->default('baik');
            $table->string('photo_path')->nullable();       // path foto (storage)
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'status']);
            $table->index(['location_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apars');
    }
};
