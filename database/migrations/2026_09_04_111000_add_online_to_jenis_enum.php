<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE venue_schedules MODIFY COLUMN jenis ENUM('offline', 'internal', 'blocked', 'online') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE venue_schedules MODIFY COLUMN jenis ENUM('offline', 'internal', 'blocked') NOT NULL");
    }
};
