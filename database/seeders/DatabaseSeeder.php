<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       if (Setting::count() === 0) {
          $this->call([SettingSeeder::class]);
       }

       if (User::count() === 0) {
          User::factory()->admin()->create([
             'name' => 'Admin',
             'email' => 'admin@digitalprinting.com',
          ]);
          
          User::factory()->create([
             'name' => 'User',
             'email' => 'user@gmail.com',
          ]);
          
          $this->call([
             SettingSeeder::class,
             CategorySeeder::class,
             ProductSeeder::class,
             TestimonialSeeder::class,
          ]);
       }
       

       
       //  Category::factory()->count(6)->create()->each(function ($category) {
       //     Product::factory()
       //        ->count(fake()->numberBetween(3, 8))
       //        ->create(['category_id' => $category->id]);
       //  });

       // Order::factory()->count(5)->create();
       
       // Testimonial::factory()->count(6)->create();
    }
}
