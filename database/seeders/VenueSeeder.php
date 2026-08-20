<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VenueSeeder extends Seeder
{
    public function run(): void
    {
        $venues = [
            [
                'nama_venue' => 'Auditorium Utama',
                'slug'       => Str::slug('Auditorium Utama'),
                'deskripsi'  => 'Ruangan aula besar yang dilengkapi dengan panggung, sound system profesional, dan proyektor HD.',
                'kapasitas'  => 300,
                'lokasi'     => 'Gedung A, Lantai 3',
                'status'     => 'available',
            ],
            [
                'nama_venue' => 'Ruang Rapat VIP',
                'slug'       => Str::slug('Ruang Rapat VIP'),
                'deskripsi'  => 'Ruang rapat eksklusif dengan meja oval, kursi ergonomis, dan fasilitas video conference.',
                'kapasitas'  => 20,
                'lokasi'     => 'Gedung B, Lantai 2',
                'status'     => 'available',
            ],
            [
                'nama_venue' => 'Laboratorium Komputer',
                'slug'       => Str::slug('Laboratorium Komputer'),
                'deskripsi'  => 'Ruang pelatihan dengan 30 PC spesifikasi tinggi dan koneksi internet cepat.',
                'kapasitas'  => 30,
                'lokasi'     => 'Gedung C, Lantai 1',
                'status'     => 'available',
            ],
        ];

        foreach ($venues as $venue) {
            Venue::create($venue);
        }
    }
}