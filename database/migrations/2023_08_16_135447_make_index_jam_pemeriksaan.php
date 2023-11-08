<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('monitoring', function (Blueprint $table) {
            $table->index('jam_pemeriksaan', 'idx_jam_pemeriksaan');
        });
    }

    public function down()
    {
        Schema::table('monitoring', function (Blueprint $table) {
            $table->dropIndex('idx_jam_pemeriksaan');
        });
    }
};
