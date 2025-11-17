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
        Schema::create('box_hydrants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('barcode')->unique();
            $table->string('serial_no')->unique();
            $table->string('location_code')->nullable();
            $table->string('type')->nullable(); // Box, Hose, Nozzle
            $table->string('status')->nullable(); // BAIK, RUSAK
            $table->text('notes')->nullable();
            $table->string('qr_svg_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_hydrants');
    }
};
