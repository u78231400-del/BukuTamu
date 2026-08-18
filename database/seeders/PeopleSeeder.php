<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Budi Santoso', 'jabatan' => 'Kepala Dinas', 'divisi' => 'Pemerintahan'],
            ['nama' => 'Siti Rahayu', 'jabatan' => 'Sekretaris', 'divisi' => 'Umum'],
            ['nama' => 'Ahmad Hidayat', 'jabatan' => 'Kabag Keuangan', 'divisi' => 'Keuangan'],
            ['nama' => 'Dewi Lestari', 'jabatan' => 'Kabag Umum', 'divisi' => 'Umum'],
            ['nama' => 'Rudi Hermawan', 'jabatan' => 'Staff IT', 'divisi' => 'Teknologi'],
            ['nama' => 'Maya Putri', 'jabatan' => 'Kabag SDM', 'divisi' => 'Kepegawaian'],
        ];

        foreach ($data as $item) {
            People::create($item);
        }
    }
}
