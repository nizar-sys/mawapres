<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokProduk>
 */
class StokProdukFactory extends Factory
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
            'stok' => 0,
            'stok_awal' => 0,
            'stok_minimum' => $this->faker->randomNumber(),
            'status' => $this->faker->randomElement(['restock', 'stock_ok']),
        ];
    }
}
