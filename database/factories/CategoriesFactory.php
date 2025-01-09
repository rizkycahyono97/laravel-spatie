<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Gaji', 'Operasional', 'Investasi']), // Nama kategori
            'description' => $this->faker->sentence(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
