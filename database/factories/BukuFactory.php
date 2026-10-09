<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Buku> */
class BukuFactory extends Factory
{
    private const JUDUL = [
        'Pemrograman Web dengan Laravel', 'Dasar-dasar Algoritma dan Struktur Data',
        'Basis Data Relasional dan SQL', 'Rekayasa Perangkat Lunak Modern',
        'Jaringan Komputer dan Keamanan Informasi', 'Pengantar Kecerdasan Buatan',
        'Pemrograman Berorientasi Objek dengan PHP', 'Analisis dan Perancangan Sistem Informasi',
        'Machine Learning untuk Pemula', 'Sistem Operasi: Konsep dan Praktik',
        'Rangkaian Listrik dan Elektronika Dasar', 'Sistem Digital dan Mikroprosesor',
        'Pengolahan Sinyal Digital', 'Kalkulus untuk Teknik dan Informatika',
        'Aljabar Linear dan Aplikasinya', 'Statistika dan Probabilitas untuk Data Science',
        'Matematika Diskrit', 'Manajemen Proyek Teknologi Informasi',
        'Kewirausahaan Digital', 'Etika Profesi dan Hukum Siber',
        'Desain Antarmuka dan Pengalaman Pengguna', 'Komputasi Awan dan DevOps',
        'Pengujian Perangkat Lunak', 'Pemrograman Mobile dengan Flutter',
        'Data Mining dan Business Intelligence', 'Internet of Things: Teori dan Implementasi',
        'Tata Kelola Teknologi Informasi', 'Arsitektur dan Organisasi Komputer',
        'Pemrograman Python untuk Sains Data', 'Keamanan Aplikasi Web',
    ];

    private const PENERBIT = [
        'Informatika Bandung', 'Andi Offset', 'Gramedia Pustaka Utama',
        'Erlangga', 'Graha Ilmu', 'Penerbit Del Press', 'Deepublish',
    ];

    public function definition(): array
    {
        $judul = $this->faker->unique()->randomElement(self::JUDUL);

        return [
            'isbn' => $this->faker->unique()->isbn13(),
            'judul' => $judul,
            'penulis' => fake('id_ID')->name(),
            'penerbit' => $this->faker->randomElement(self::PENERBIT),
            'tahun_terbit' => $this->faker->numberBetween(2010, (int) date('Y')),
            'kategori_id' => Kategori::factory(),
            'stok' => $this->faker->numberBetween(0, 25),
            'sinopsis' => "Buku \"{$judul}\" membahas konsep dasar hingga penerapan praktis secara bertahap, "
                . 'dilengkapi contoh kasus, latihan soal, dan studi kasus yang relevan '
                . 'bagi mahasiswa maupun praktisi.',
        ];
    }
}