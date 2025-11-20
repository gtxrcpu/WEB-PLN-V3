<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add signature_id to all kartu tables
        $tables = [
            'kartu_apars',
            'kartu_apats',
            'kartu_apabs',
            'kartu_fire_alarms',
            'kartu_box_hydrants',
            'kartu_rumah_pompas',
            'kartu_p3ks',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->foreignId('signature_id')->nullable()->constrained('signatures')->onDelete('set null');
                });
            }
        }
    }

    public function down(): void
    {
        $tables = [
            'kartu_apars',
            'kartu_apats',
            'kartu_apabs',
            'kartu_fire_alarms',
            'kartu_box_hydrants',
            'kartu_rumah_pompas',
            'kartu_p3ks',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropForeign(['signature_id']);
                    $table->dropColumn('signature_id');
                });
            }
        }
    }
};
