<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
   {
       return [
           'name' => fake()->name(),
           'role' => fake()->jobTitle(),
           'content' => fake()->sentence(12),
           'rating' => fake()->numberBetween(4, 5),
           'is_approved' => fake()->boolean(0),
           'sort_order' => fake()->numberBetween(1, 100),
       ];
   }
}
