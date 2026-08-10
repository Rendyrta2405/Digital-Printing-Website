<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
          [
           'name' => 'Banner & Spanduk', 
           'slug' => 'banner', 
           'description' => 'Cetak 1 jam jadi, bahan berkualitas, tahan cuaca!', 
           'price_text' => 'Mulai Rp 18.000/m²', 
           'image' => 'assets/banner-hero-1.jpg', 
           'show_in_navbar' => true, 
           'sort_order' => 1
           ],
          [
           'name' => 'Stiker', 
           'slug' => 'stiker', 
           'description' => 'Cutting, vinyl, bening, label. Bebas desain!', 
           'price_text' => 'Mulai Rp 5.000', 
           'image' => null, 
           'show_in_navbar' => true, 
           'sort_order' => 2
           ],
          [
           'name' => 'Stempel', 
           'slug' => 'stempel', 
           'description' => 'Flash, kayu, warna, tanggal, pocket, emboss.', 
           'price_text' => 'Mulai Rp 25.000', 
           'image' => 'assets/hero-stempel.jpg', 
           'show_in_navbar' => true, 
           'sort_order' => 3
           ],
          [
           'name' => 'Kartu Nama', 
           'slug' => 'kartu-nama', 
           'description' => 'Art paper, doff, glossy, premium, hingga custom.', 
           'price_text' => 'Mulai Rp 50.000/box', 
           'image' => 'assets/hero-kartu-nama.jpg', 
           'show_in_navbar' => true, 
           'sort_order' => 4
           ],
          [
           'name' => 'Undangan', 
           'slug' => 'undangan', 
           'description' => 'Pernikahan, ulang tahun, khitanan, akad.', 
           'price_text' => 'Mulai Rp 2.000/lembar', 
           'image' => null, 
           'show_in_navbar' => true, 
           'sort_order' => 5
           ],
          [
           'name' => 'Buku', 
           'slug' => 'buku', 
           'description' => 'Softcover, hardcover, jilid benang, spiral.', 
           'price_text' => 'Mulai Rp 75.000', 
           'image' => 'assets/hero-buku.jpeg', 
           'show_in_navbar' => true, 
           'sort_order' => 6
           ],
          [
           'name' => 'Hadiah Custom', 
           'slug' => 'hadiah-custom', 
           'description' => 'Frame foto, kalender, mug, dan souvenir custom.', 
           'price_text' => 'Harga bersahabat', 
           'image' => null, 
           'show_in_navbar' => false, 
           'sort_order' => 7
           ],
      ];
      
      foreach ($categories as $data) {
          Category::create($data);
      }
    }
}
