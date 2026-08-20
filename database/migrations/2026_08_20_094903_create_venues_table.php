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
    Schema::create('venues', function (Blueprint $table) {
        $table->id();
        $table->string('nama_venue');
        $table->string('slug')->unique();
        $table->text('deskripsi')->nullable();
        $table->integer('kapasitas')->default(0);
        $table->string('lokasi')->nullable();
        $table->string('foto')->nullable();
        $table->enum('status', ['available', 'maintenance'])->default('available');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
