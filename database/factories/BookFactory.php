<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = fake()->numberBetween(1, 10);

        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'category_id' => Category::factory(),
            'description' => fake()->optional(0.7)->paragraph(),
            'total_quantity' => $total,
            'available_quantity' => $total,
        ];
    }
}
