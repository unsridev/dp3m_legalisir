<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JenisLayananFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->words(3, true),
            'kode' => fake()->unique()->lexify('????'),
            'aktif' => true,
        ];
    }
}
