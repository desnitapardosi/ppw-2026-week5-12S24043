<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = collect([
            ['KTG-INF', 'Informatika & Pemrograman'],
            ['KTG-SIS', 'Sistem Informasi'],
            ['KTG-ELK', 'Teknik Elektro'],
            ['KTG-MAT', 'Matematika & Statistika'],
            ['KTG-MNJ', 'Manajemen & Bisnis'],
        ])->map(fn ($k) => Kategori::create([
            'kode_kategori' => $k[0],
            'nama_kategori' => $k[1],
        ]));

        // 24 buku, kategorinya diacak dari 5 kategori di atas
        Buku::factory(24)->recycle($kategoris)->create();
    }
}