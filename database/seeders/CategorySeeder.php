<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
              'title' => 'Cetak Banner Kilat, Jaminan Selesai Tepat Waktu.', 
              'description' => 'Jangan korbankan kualitas demi waktu. Toko Percetakan menjamin Anda mendapatkan Cetak Banner Express 1 Jam Jadi dengan Kualitas Premium Tahan Cuaca, plus Harga Promo Spanduk', 
              'slogan' => 'Banner Kilat, 1 Jam jadi!',
              'price_text' => 'Mulai Rp 18.000/m²', 
              'image' => null, 
              'show_in_navbar' => true, 
              'sort_order' => 1,
           ],
          [
             'name' => 'Stiker & Label', 
             'title' => 'Cetak Stiker Kemasan Potong Custom, Daya Rekat Ekstra.', 
             'description' => 'Tingkatkan nilai jual produk Anda dengan stiker label kemasan premium. Tersedia bahan Vinyl, Transparan, dan Cromo dengan cetakan tajam anti luntur serta potongan Kiss-Cut/Die-Cut presisi.', 
             'slogan' => 'Stiker Label, Tempel Langsung Jual!',
             'price_text' => 'Mulai Rp 10.000/lembar A3', 
             'image' => null, 
             'show_in_navbar' => true, 
             'sort_order' => 2,
         ],
         [
             'name' => 'Stempel Otomatis', 
             'title' => 'Bikin Stempel Flash Kilat, Tanpa Bantalan Tinta.', 
             'description' => 'Lengkapi kebutuhan administrasi bisnis Anda dengan stempel otomatis (flash) pengerjaan ekspres. Tinta langsung terisi di dalam, hasil cap tajam, cepat kering, dan tersedia berbagai pilihan warna menarik.', 
             'slogan' => 'Stempel Ekspres, 10 Menit Jadi!',
             'price_text' => 'Mulai Rp 35.000/pcs', 
             'image' => null, 
             'show_in_navbar' => true, 
             'sort_order' => 3,
         ],
         [
             'name' => 'Kartu Nama', 
             'title' => 'Cetak Kartu Nama Profesional, Kesan Pertama Begitu Berharga.', 
             'description' => 'Bangun relasi bisnis yang meyakinkan dengan kartu nama premium. Dicetak menggunakan bahan Art Carton tebal berperekat dua sisi (Laminasi Glossy/Doft) untuk tampilan mewah dan eksklusif.', 
             'slogan' => 'Kartu Nama Mewah, Mitra Percaya!',
             'price_text' => 'Mulai Rp 25.000/box', 
             'image' => null, 
             'show_in_navbar' => true, 
             'sort_order' => 4,
         ],
         [
             'name' => 'Undangan Pernikahan & Acara', 
             'title' => 'Cetak Undangan Custom Mewah, Desain Elegan Kekinian.', 
             'description' => 'Abadikan momen spesial Anda dengan undangan yang memikat hati para tamu. Kami menyediakan cetak undangan Softcover maupun Hardcover dengan kertas tekstur premium, aksen emas (Foil), dan emboss timbul.', 
             'slogan' => 'Undangan Elegan, Momen Tak Terlupakan!',
             'price_text' => 'Mulai Rp 1.500/pcs', 
             'image' => null, 
             'show_in_navbar' => true, 
             'sort_order' => 5,
         ],
         [
             'name' => 'Buku, Jurnal & Majalah', 
             'title' => 'Cetak Buku & Penjilidan Dokumen, Rapih Sesuai Standar Penerbit.', 
             'description' => 'Layanan cetak buku kustom, novel, majalah, portofolio, hingga buku tahunan sekolah. Didukung pilihan jilid terlengkap mulai dari Jilid Kawat, Jilid Spiral, hingga Jilid Lem Panas (Perfect Binding) standar pabrik.', 
             'slogan' => 'Cetak Buku Satuan, Jilid Kuat Rapi!',
             'price_text' => 'Mulai Rp 50/halaman', 
             'image' => null, 
             'show_in_navbar' => true, 
             'sort_order' => 6,
         ],
          [
             'name' => 'Hadiah Custom & Merchandise', 
             'title' => 'Cetak Hadiah Custom Unik, Souvenir Eksklusif Desain Suka-Suka.', 
             'description' => 'Berikan kesan mendalam dengan hadiah kustom berkualitas tinggi. Cocok untuk kado ulang tahun, wisuda, pernikahan, maupun merchandise perusahaan. Tersedia cetak Mug, Tumblr, Pin, Kaos Sablon, hingga Gantungan Kunci dengan hasil cetak sublimasi tajam dan awet.', 
             'slogan' => 'Kado Kustom Unik, Lebih Berkesan!',
             'price_text' => 'Mulai Rp 15.000/pcs', 
             'image' => null, 
             'show_in_navbar' => true, 
             'sort_order' => 7,
         ],
      ];
      
      foreach ($categories as $data) {
          Category::firstOrCreate(
             ['slug' => Str::slug($data['name'])],
             $data
          );
      }
    }
}
