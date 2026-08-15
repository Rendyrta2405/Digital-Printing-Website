<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $price = fake()->numberBetween(10, 200) * 1000;
      $quantity = fake()->numberBetween(1, 10); 
       
        return [
            'order_number' => 'ORD-' . now()->format('ymd') . '-' 
                . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT),
           'product_id' => Product::factory(),
           'quantity' => $quantity,
           'design_option' => fake()->randomElement(['punya', 'buatkan']),
           'notes' => fake()->optional()->sentence(),
           'customer_name' => fake()->name(),
           'customer_phone' => '08' . fake()->numerify('##########'),
           'total' => $price * $quantity,
           'status' => fake()->randomElement(['baru', 'baru', 'diproses', 'selesai', 'selesai', 'ditolak']),
        ];
    }
}
