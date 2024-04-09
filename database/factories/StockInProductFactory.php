<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockInProduct>
 */
class StockInProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'stok_produk_id' => 1,
            'vendor_id' => $this->faker->numberBetween(1, 15),
            'tanggal_masuk' => $this->faker->date(),
            'jumlah_masuk' => $this->faker->randomNumber(),
        ];
    }
}
