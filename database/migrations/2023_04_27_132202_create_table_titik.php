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
        Schema::create('titik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_titik');
            $table->text('koordinat');
            $table->integer('status')->comment('1. Aktif, 2. Non-aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titik');
    }
};
