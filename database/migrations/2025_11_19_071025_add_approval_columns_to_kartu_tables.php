<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
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
                    $table->foreignId('approved_by')->nullable()->after('signature_id')->constrained('users')->onDelete('set null');
                    $table->timestamp('approved_at')->nullable()->after('approved_by');
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
                    $table->dropForeign(['approved_by']);
                    $table->dropColumn(['approved_by', 'approved_at']);
                });
            }
        }
    }
};
