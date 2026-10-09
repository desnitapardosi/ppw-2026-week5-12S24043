<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Kategori> */
class KategoriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kode_kategori' => 'KTG-' . strtoupper($this->faker->unique()->lexify('???')),
            'nama_kategori' => $this->faker->unique()->words(2, true),
        ];
    }
}