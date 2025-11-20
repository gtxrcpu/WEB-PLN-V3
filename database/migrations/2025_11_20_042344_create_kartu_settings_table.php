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
        Schema::create('kartu_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, number, date
            $table->string('label');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('kartu_settings')->insert([
            [
                'key' => 'no_dokumen',
                'value' => 'FR.04-PT.20.K3L',
                'type' => 'text',
                'label' => 'No. Dokumen',
                'description' => 'Nomor dokumen kartu kendali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'revisi',
                'value' => '05',
                'type' => 'text',
                'label' => 'Revisi',
                'description' => 'Nomor revisi dokumen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'tanggal_berlaku',
                'value' => '24 Januari 2025',
                'type' => 'text',
                'label' => 'Tanggal Berlaku',
                'description' => 'Tanggal mulai berlaku dokumen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'halaman',
                'value' => '1 dari 1 halaman',
                'type' => 'text',
                'label' => 'Halaman',
                'description' => 'Informasi halaman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_settings');
    }
};
