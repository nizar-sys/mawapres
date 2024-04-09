<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockOutProduct>
 */
class StockOutProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'produk_id' => $this->faker->numberBetween(1, 10),
            'warna_id' => $this->faker->numberBetween(1, 20),
            'vendor_id' => $this->faker->numberBetween(1, 15),
            'tanggal_keluar' => $this->faker->date(),
            'jumlah_keluar' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
        ];
    }
}
