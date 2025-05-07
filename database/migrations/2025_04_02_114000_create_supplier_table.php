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
        // Create nhacungcap table
        Schema::create('doitac', function (Blueprint $table) {
            $table->string('MaSoThue_DoiTac', 20)->primary();
            $table->string('TenDoiTac', 255);
            $table->string('Email', 255);
            $table->string('SDT', 10);
            $table->string('DiaChi', 255);  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doitac');
    }
};
