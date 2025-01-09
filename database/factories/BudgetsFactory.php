<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budgets>
 */
class BudgetsFactory extends Factory
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
            'amount_requested' => $this->faker->numberBetween(1000, 100000), // Jumlah yang diminta
            'amount_approved' => $this->faker->numberBetween(1000, 100000), // Jumlah yang disetujui
            'status' => $this->faker->randomElement(['mengunggu persetujuan', 'disetujui', 'ditolak']), // Status
            'reason' => $this->faker->sentence(), // Alasan pengajuan
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
