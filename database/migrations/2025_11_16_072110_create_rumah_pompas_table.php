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
        Schema::create('rumah_pompas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name')->default('Rumah Pompa 1');
            $table->string('serial_no')->nullable()->unique();
            $table->string('barcode')->nullable()->unique();
            $table->string('location_code')->nullable();
            $table->string('type')->nullable();
            $table->string('zone')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('rumah_pompas');
    }
};
