<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('email')->nullable()->after('nama');
            $table->string('nomor_hp')->after('email');
            $table->string('keperluan')->after('instansi');
            $table->string('tujuan')->after('keperluan');
            $table->dropColumn('kontak');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('kontak')->after('nama');
            $table->dropColumn(['email', 'nomor_hp', 'keperluan', 'tujuan']);
        });
    }
};
