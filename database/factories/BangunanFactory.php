<?php

namespace Database\Factories;

use App\Models\Tanah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bangunan>
 */
class BangunanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_bangunan' => fake()->word(),
            'kode_bangunan' => fake()->unique()->word(),
            // Pakai Tanah yang sudah ada jika tersedia, kalau tidak buat baru lewat factory
            'tanah_id' => function() {
                $exists = Tanah::inRandomOrder()->first();
                return $exists ? $exists->id : Tanah::factory();
            },
        ];
    }
}
