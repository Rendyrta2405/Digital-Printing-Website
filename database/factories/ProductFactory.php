<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => Str::title(fake()->unique()->words(3, true)),
            'description' => fake()->sentence(),
            'price' => fake()->randomElement([null, fake()->numberBetween(5, 200) * 1000]),
            'price_unit' => fake()->randomElement([null, '/m²', '/box', '/pcs', '/lembar']),
            'image' => 'https://picsum.photos/seed/' . fake()->unique()->word() . '/400/300',
            'badge' => fake()->randomElement([null, null, 'HOT', 'NEW', 'TERLARIS', 'PROMO']),
            'tag' => fake()->randomElement([null, 'Promosi', 'Event', 'Dekorasi', 'Custom']),
            'is_featured' => fake()->boolean(30),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}