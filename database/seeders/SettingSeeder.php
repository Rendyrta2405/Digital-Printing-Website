<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
           'site_name' => 'Digital Printing',
           'tagline' => 'Digital Printing nomor 1 di Jakarta Raya',
           'whatsapp_number' => '6283171125657',
           'email' => 'digital@printing.com',
           'address' => 'Jl. Soekarno Hatta No. 01, Jakarta Pusat, DKI Jakarta 19900',
           'opening_hours' => 'Senin - Sabtu, 09.00 - 19.00 WIB',
           'about_text' => 'Sejak 2016, Digital Printing telah menjadi mitra percetakan terpercaya bagi ribuan pelanggan, dari UMKM hingga perusahaan besar. Kami menggabungkan teknologi modern dengan sentuhan tradisional untuk menghasilkan cetakan berkualitas tinggi.
           
Kami percaya bahwa setiap cetakan adalah representasi dari usaha Anda. Itulah mengapa kami selalu mengutamakan ketelitian, kecepatan, dan kepuasan pelanggan.',
           'about_img' => null,
           'title' => 'Cetak Kilat 1 Jam Jadi!
Kualitas Premium, Harga Merakyat',
           'description' => 'Jangan buang waktu antri di tempat lain. Digital Printing siap melayani cetak banner, buku, stiker, dan kebutuhan promosi Anda dengan kecepatan kilat dan hasil yang memukau. Dijamin puas atau uang kembali!',
           'maps_query' => '-6.1827085, 106.9467213',
        ];

       Setting::firstOrCreate($settings);
    }
}
