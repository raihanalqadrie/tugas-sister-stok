<?php

namespace Database\Factories;

use Database\Factories\Data\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangTransfer>
 */
class BarangTransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'barang_id' => fake()->numberBetween(1, 50),
            'deskripsi' => join(" ", fake()->words(8)),
            'tipe' => fake()->randomElement(['masuk', 'masuk', 'masuk', 'masuk', 'keluar']),
            'jumlah' => fake()->randomNumber(2),
            'harga_satuan' => fake()->randomNumber(4),
            'penerima' => fake()->name(),
        ];
    }
}
