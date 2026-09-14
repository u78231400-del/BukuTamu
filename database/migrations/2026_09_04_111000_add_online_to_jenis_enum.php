<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            $this->migrateSqlite(true);
        } else {
            DB::statement("ALTER TABLE venue_schedules MODIFY COLUMN jenis ENUM('offline', 'internal', 'blocked', 'online') NOT NULL");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            $this->migrateSqlite(false);
        } else {
            DB::statement("ALTER TABLE venue_schedules MODIFY COLUMN jenis ENUM('offline', 'internal', 'blocked') NOT NULL");
        }
    }

    private function migrateSqlite(bool $addOnline): void
    {
        $enumValues = $addOnline
            ? ['offline', 'internal', 'blocked', 'online']
            : ['offline', 'internal', 'blocked'];

        Schema::create('venue_schedules_temp', function (Blueprint $table) use ($enumValues) {
            $table->id();
            $table->foreignId('venue_id')->constrained('venues')->onDelete('cascade');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->onDelete('cascade');
            $table->string('judul');
            $table->enum('jenis', $enumValues);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        DB::statement("INSERT INTO venue_schedules_temp (id, venue_id, owner_id, reservation_id, judul, jenis, tanggal_mulai, tanggal_selesai, waktu_mulai, waktu_selesai, keterangan, created_at, updated_at) SELECT id, venue_id, owner_id, reservation_id, judul, jenis, tanggal_mulai, tanggal_selesai, waktu_mulai, waktu_selesai, keterangan, created_at, updated_at FROM venue_schedules");

        Schema::drop('venue_schedules');
        Schema::rename('venue_schedules_temp', 'venue_schedules');
    }
};
