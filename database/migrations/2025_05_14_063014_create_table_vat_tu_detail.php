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
        Schema::create('chitietvattu', function (Blueprint $table) {
            $table->string('MaVatTu', 20)->primary();
            $table->string('ThuongHieu', 100)->nullable();
            $table->string('KichThuoc', 50)->nullable();
            $table->string('XuatXu', 100)->nullable();
            $table->text('MoTa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietvattu');
    }
};
