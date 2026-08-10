<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
   {
       $cat = fn (string $slug) => Category::where('slug', $slug)->first()->id;
   
       // "Mini factory": isi default, lalu $extra menimpa yang perlu
       $make = function (int $catId, string $name, ?int $price, array $extra = []) {
           return array_merge([
               'category_id' => $catId,
               'name'        => $name,
               'price'       => $price,
               'price_unit'  => null,
               'description' => null,
               'image'       => null,
               'badge'       => null,
               'tag'         => null,
               'is_featured' => false,
               'sort_order'  => 0,
           ], $extra);
       };
   
       $products = [
           // ═══ BANNER ═══
           $make($cat('banner'), 'Spanduk Custom', 18000, ['price_unit' => '/m²', 'badge' => 'HOT', 'tag' => 'Promosi', 'is_featured' => true, 'sort_order' => 1, 'image' => 'assets/spanduk.jpeg', 'description' => 'Bahan flexi 280g tahan cuaca, cetak 1 jam jadi.']),
           $make($cat('banner'), 'Banner Promosi Ukuran Besar', 85000, ['tag' => 'Promosi', 'sort_order' => 2, 'image' => 'assets/banner-promosi-ukuran-besar.jpg', 'description' => 'Cocok untuk toko, outlet, atau acara promosi outdoor.']),
           $make($cat('banner'), 'Banner Backdrop Event', 150000, ['tag' => 'Event', 'sort_order' => 3, 'image' => 'assets/banner-backdrop-event.jpeg', 'description' => 'Untuk meeting, pernikahan, gathering.']),
           $make($cat('banner'), 'Banner Hias Dekorasi', 65000, ['tag' => 'Dekorasi', 'sort_order' => 4, 'image' => 'assets/banner-hias-dekorasi.jpeg', 'description' => 'Dekorasi ruangan, cafe, studio.']),
           $make($cat('banner'), 'X-Banner Standing', 120000, ['badge' => 'PROMO', 'tag' => 'Promosi', 'is_featured' => true, 'sort_order' => 5, 'image' => 'assets/x-banner-standing.jpeg', 'description' => 'Lengkap dengan standing, cocok untuk pameran & seminar.']),
           $make($cat('banner'), 'Roll Banner (Standing)', 200000, ['badge' => 'TERLARIS', 'tag' => 'Event', 'is_featured' => true, 'sort_order' => 6, 'image' => 'assets/roll-banner-standing.jpeg', 'description' => 'Praktis dibawa, mudah dipasang.']),
           $make($cat('banner'), 'Foamboard', 25000, ['badge' => 'NEW', 'tag' => 'Custom', 'is_featured' => true, 'sort_order' => 7, 'image' => 'assets/foamboard.png', 'description' => 'Berbagai ukuran, cocok untuk signage & dekorasi.']),
           $make($cat('banner'), 'Human Stand', null, ['tag' => 'Promosi', 'sort_order' => 8, 'image' => 'assets/human-stand.jpg', 'description' => 'Cutting seukuran manusia untuk promosi mencolok.']),
           $make($cat('banner'), 'Tripod Banner', null, ['tag' => 'Event', 'sort_order' => 9, 'image' => 'assets/tripod-banner.jpeg', 'description' => 'Banner dengan dudukan tripod, praktis untuk event.']),
   
           // ═══ STIKER (dari tab harga di home) ═══
           $make($cat('stiker'), 'Stiker Cutting', 1500, ['price_unit' => '/cm', 'sort_order' => 1]),
           $make($cat('stiker'), 'Stiker Vinyl', 50000, ['price_unit' => '/m²', 'sort_order' => 2]),
           $make($cat('stiker'), 'Stiker Label', 2000, ['price_unit' => '/lembar', 'sort_order' => 3]),
           $make($cat('stiker'), 'Stiker Bening', 1800, ['price_unit' => '/cm²', 'sort_order' => 4]),
           $make($cat('stiker'), 'Stiker Custom', null, ['sort_order' => 5, 'description' => 'Harga tergantung kerumitan, konsultasikan.']),
   
           // ═══ STEMPEL ═══
           $make($cat('stempel'), 'Stempel Flash', 35000, ['sort_order' => 1, 'image' => 'assets/stempel-flash.jpg', 'description' => 'Tinta terintegrasi, siap pakai tanpa bantalan.']),
           $make($cat('stempel'), 'Stempel Kayu', 25000, ['sort_order' => 2, 'image' => 'assets/stempel-kayu.jpg', 'description' => 'Ekonomis dan tahan lama.']),
           $make($cat('stempel'), 'Stempel Warna', 45000, ['sort_order' => 3, 'image' => 'assets/stempel-warna.jpg', 'description' => 'Bisa mencetak lebih dari satu warna.']),
           $make($cat('stempel'), 'Stempel Tanggal', 50000, ['sort_order' => 4, 'image' => 'assets/stempel-tanggal.jpg', 'description' => 'Roda tanggal bisa diputar, cocok untuk administrasi.']),
           $make($cat('stempel'), 'Stempel Pocket', 30000, ['sort_order' => 5, 'image' => 'assets/stempel-pocket.jpg', 'description' => 'Kecil, praktis, mudah dibawa.']),
           $make($cat('stempel'), 'Stempel Emboss', 75000, ['sort_order' => 6, 'image' => 'assets/stempel-emboss.jpg', 'description' => 'Cetakan timbul tanpa tinta, kesan profesional.']),
           $make($cat('stempel'), 'Stempel Clear/Bening', 40000, ['sort_order' => 7, 'image' => 'assets/stempel-bening.jpg', 'description' => 'Transparan untuk penempatan presisi.']),
           $make($cat('stempel'), 'Stempel Custom', 60000, ['sort_order' => 8, 'image' => 'assets/stempel-custom.jpg', 'description' => 'Bentuk bulat, oval, bintang, karakter, dll.']),
   
           // ═══ KARTU NAMA ═══
           $make($cat('kartu-nama'), 'Kartu Nama Art Paper 260gsm', 50000, ['price_unit' => '/box', 'sort_order' => 1, 'image' => 'assets/kartu-nama-art-paper.jpg', 'description' => 'Permukaan halus, hasil cetak tajam.']),
           $make($cat('kartu-nama'), 'Kartu Nama Art Carton 310gsm', 65000, ['price_unit' => '/box', 'sort_order' => 2, 'image' => 'assets/kartu-nama-art-carton.jpg', 'description' => 'Lebih tebal dan kokoh.']),
           $make($cat('kartu-nama'), 'Kartu Nama Doff / Matte', 70000, ['price_unit' => '/box', 'sort_order' => 3, 'image' => 'assets/kartu-nama-doff.jpg', 'description' => 'Elegan, tidak reflektif, tidak mudah kotor.']),
           $make($cat('kartu-nama'), 'Kartu Nama Glossy', 75000, ['price_unit' => '/box', 'sort_order' => 4, 'image' => 'assets/kartu-nama-glossy.jpg', 'description' => 'Mengilap, tahan air, warna hidup.']),
           $make($cat('kartu-nama'), 'Kartu Nama Premium / Emboss', 100000, ['price_unit' => '/box', 'sort_order' => 5, 'image' => 'assets/kartu-nama-premium.jpg', 'description' => 'Efek timbul, kesan mewah.']),
   
           // ═══ BUKU (dengan tag untuk filter) ═══
           $make($cat('buku'), 'Buku Tahunan Sekolah', 150000, ['tag' => 'Buku Tahunan', 'sort_order' => 1, 'image' => 'assets/buku-tahunan-sekolah.jpg', 'description' => 'Hard/soft cover, warna tajam.']),
           $make($cat('buku'), 'Cetak Novel / Buku Fiksi', 75000, ['tag' => 'Novel', 'sort_order' => 2, 'image' => 'assets/buku-novel.jpg', 'description' => 'Wujudkan naskah Anda menjadi buku nyata.']),
           $make($cat('buku'), 'Buku Catatan / Jurnal Custom', 25000, ['tag' => 'Buku Catatan', 'sort_order' => 3, 'image' => 'assets/buku-jurnal.jpeg', 'description' => 'Desain sampul sesuai keinginan.']),
           $make($cat('buku'), 'Buku Company Profile', 200000, ['tag' => 'Company Profile', 'sort_order' => 4, 'image' => 'assets/buku-company.jpeg', 'description' => 'Kertas berkualitas, desain eksklusif.']),
           $make($cat('buku'), 'Buku Tahunan Kampus', 180000, ['tag' => 'Buku Tahunan', 'sort_order' => 5, 'image' => 'assets/buku-tahunan-kampus.png', 'description' => 'Abadikan momen kebersamaan.']),
   
           // ═══ UNDANGAN (dari tab harga di home) ═══
           $make($cat('undangan'), 'Undangan Per Lembar', 2500, ['price_unit' => '/lembar', 'sort_order' => 1]),
           $make($cat('undangan'), 'Undangan Minimal 50 Lembar', 2000, ['price_unit' => '/lembar', 'sort_order' => 2]),
   
           // ═══ HADIAH CUSTOM ═══
           $make($cat('hadiah-custom'), 'Frame Foto Custom', null, ['sort_order' => 1, 'description' => 'Bingkai berkualitas dengan desain pribadi.']),
           $make($cat('hadiah-custom'), 'Kalender Dinding Custom', null, ['sort_order' => 2, 'description' => 'Hadiah promosi yang efektif.']),
           $make($cat('hadiah-custom'), 'Mug Custom', null, ['sort_order' => 3, 'description' => 'Gelas keramik desain unik untuk souvenir.']),
       ];
   
       foreach ($products as $data) {
           Product::create($data);
       }
   }
}