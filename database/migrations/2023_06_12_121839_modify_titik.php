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
        Schema::table('titik', function (Blueprint $table) {
            $table->string('kode_barcode')->nullable(true);
        });

        Schema::table('user', function (Blueprint $table) {
            $table->string('nip')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('titik', function (Blueprint $table) {
            $table->dropColumn('kode_barcode');
        });

        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('nip');
        });
    }
};
