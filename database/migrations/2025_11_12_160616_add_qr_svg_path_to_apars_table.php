<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('apars', function (Blueprint $table) {
            if (!Schema::hasColumn('apars', 'qr_svg_path')) {
                $table->string('qr_svg_path')->nullable()->after('barcode');
            }
        });
    }

    public function down(): void {
        Schema::table('apars', function (Blueprint $table) {
            if (Schema::hasColumn('apars', 'qr_svg_path')) {
                $table->dropColumn('qr_svg_path');
            }
        });
    }
};
