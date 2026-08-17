<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
       
       User::firstOrCreate(
          ['email' => 'admin@digitalprinting.com'],
          ['name' => 'Admin', 'password' => bcrypt('password'), 'is_admin' => true],
       );
       
       User::firstOrCreate(
          ['email' => 'user@gmail.com'],
          ['name' => 'User', 'password' => bcrypt('password'), 'is_admin' => false],
       );

       $this->call([
          SettingSeeder::class,
          CategorySeeder::class,
          ProductSeeder::class,
       ]);
       
       //  Category::factory()->count(6)->create()->each(function ($category) {
       //     Product::factory()
       //        ->count(fake()->numberBetween(3, 8))
       //        ->create(['category_id' => $category->id]);
       //  });

       // Order::factory()->count(5)->create();
       
       // Testimonial::factory()->count(6)->create();
    }
}
