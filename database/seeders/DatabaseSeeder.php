<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@digitalprinting.com',
        ]);
       
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
        ]);

       //  Category::factory()->count(6)->create()->each(function ($category) {
       //     Product::factory()
       //        ->count(fake()->numberBetween(3, 8))
       //        ->create(['category_id' => $category->id]);
       //  });

       // Order::factory()->count(5)->create();
       
       // Testimonial::factory()->count(6)->create();

       $this->call([
          SettingSeeder::class,
       ]);
    }
}
