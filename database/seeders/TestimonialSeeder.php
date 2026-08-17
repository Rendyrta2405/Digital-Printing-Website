<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
           [
              'name' => 'Budi Santoso',
              'role' => 'Pemilik Toko Kelontong',
              'content' => 'Beneran 1 jam jadi! Banner toko saya langsung jadi dan kualitasnya bagus banget. Harga juga bersahabat. Pasti balik lagi!',
              'sort_order' => 1,
              'image' => null,
           ],
           [
              'name' => 'Siti Aminah',
              'role' => 'Guru SMA',
              'content' => 'Cetak buku tahunan sekolah 200 eksemplar cepet banget, hasilnya rapi dan sesuai desain. Pelayanannya ramah dan responsif. Rekomended banget!',
              'sort_order' => 2,
              'image' => null,
           ],
           [
              'name' => 'Rizky Pratama',
              'role' => 'Owner UMKM Minuman',
              'content' => 'Stiker cutting untuk brand minuman saya, kualitas top! Desain rumit bisa dieksekusi dengan sempurna. Pengiriman cepat dan admin fast respon.',
              'sort_order' => 3,
              'image' => null,
           ],
        ];

        foreach($testimonials as $testimonial) {
           Testimonial::firstOrCreate($testimonial);
        }
    }
}
