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
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('nomor_hp')->nullable()->change();
            $table->string('instansi')->nullable()->change();
            $table->string('keperluan')->nullable()->change();
            $table->string('tujuan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            //
        });
    }
};
