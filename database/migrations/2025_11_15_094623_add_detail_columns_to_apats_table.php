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
        Schema::table('apats', function (Blueprint $table) {
            // tambahin kolom kalau belum ada
            if (!Schema::hasColumn('apats', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('serial_no');
            }

            if (!Schema::hasColumn('apats', 'jenis')) {
                $table->string('jenis')->nullable()->after('lokasi');
            }

            if (!Schema::hasColumn('apats', 'kapasitas')) {
                $table->string('kapasitas')->nullable()->after('jenis');
            }

            if (!Schema::hasColumn('apats', 'status')) {
                $table->string('status')->nullable()->after('kapasitas');
            }

            if (!Schema::hasColumn('apats', 'notes')) {
                $table->text('notes')->nullable()->after('status');
            }

            if (!Schema::hasColumn('apats', 'qr_svg_path')) {
                $table->string('qr_svg_path')->nullable()->after('notes');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apats', function (Blueprint $table) {
            if (Schema::hasColumn('apats', 'qr_svg_path')) {
                $table->dropColumn('qr_svg_path');
            }
            if (Schema::hasColumn('apats', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('apats', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('apats', 'kapasitas')) {
                $table->dropColumn('kapasitas');
            }
            if (Schema::hasColumn('apats', 'jenis')) {
                $table->dropColumn('jenis');
            }
            if (Schema::hasColumn('apats', 'lokasi')) {
                $table->dropColumn('lokasi');
            }
        });
    }
};
