<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Mengambil user secara acak
            'category_id' => Categories::inRandomOrder()->first()->id, // Mengambil category secara acak
            'type' => $this->faker->randomElement(['pendapatan', 'pengeluaran']), // Jenis transaksi
            'amount' => $this->faker->numberBetween(1000, 100000), // Jumlah uang
            'description' => $this->faker->sentence(), // Deskripsi transaksi
            'status' => $this->faker->randomElement(['menunggu persetujuan', 'disetujui', 'ditolak']), // Status transaksi
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
