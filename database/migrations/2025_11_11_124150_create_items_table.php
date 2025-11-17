<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name', 160);
            $table->string('barcode', 64)->nullable()->index();
            $table->string('location', 120)->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->timestamps();
            $table->index(['name','location']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
