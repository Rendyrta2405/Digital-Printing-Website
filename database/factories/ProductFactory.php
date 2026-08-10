<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Otomatis membuat kategori baru untuk setiap produk
            'category_id' => Category::factory(), 
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(10000, 500000),
            'price_unit' => $this->faker->randomElement(['/pcs', '/box', '/m²']),
            'image' => 'assets/' . $this->faker->word() . '.png',
            'badge' => $this->faker->randomElement(['HOT', 'NEW', 'TERLARIS', 'PROMO', null]),
            'tag' => $this->faker->randomElement(['Semua', 'Promosi', 'Event', 'Dekorasi', 'Custom', null]),
            'is_featured' => $this->faker->boolean(20), // 20% peluang true
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 20),
        ];
    }
}
