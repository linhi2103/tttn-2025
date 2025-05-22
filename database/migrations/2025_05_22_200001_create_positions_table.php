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
        Schema::create('chucvu', function (Blueprint $table) {
            $table->string('MaChucVu', 20)->primary();
            $table->string('MaPhongBan', 20)->nullable();
            $table->string('TenChucVu', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chucvu');
    }
};
