<?php

namespace Database\Factories;

use App\Models\JenisLayanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengajuanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'jenis_layanan_id' => JenisLayanan::factory(),
            'nomor_antrean' => fake()->unique()->bothify('??########0001'),
            'nim' => fake()->numerify('#############'),
            'nama_lengkap' => fake()->name(),
            'email' => fake()->safeEmail(),
            'whatsapp' => fake()->numerify('08##########'),
            'tanggal_wisuda' => fake()->date(),
            'keperluan' => fake()->sentence(),
        ];
    }
}
