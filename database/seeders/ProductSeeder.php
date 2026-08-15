<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cat = fn (string $slug) => Category::where('slug', $slug)->firstOrFail()->id;

        // "Mini factory": default + override
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
            // ═══════════ BANNER & SPANDUK ═══════════
            $make($cat('banner-spanduk'), 'Spanduk Custom', 18000, ['price_unit' => '/m²', 'badge' => 'HOT', 'tag' => 'Promosi', 'is_featured' => true, 'sort_order' => 1, 'description' => 'Bahan flexi 280g tahan cuaca, cetak kilat 1 jam jadi.']),
            $make($cat('banner-spanduk'), 'Banner Promosi Ukuran Besar', 85000, ['price_unit' => '/pcs', 'tag' => 'Promosi', 'sort_order' => 2, 'description' => 'Cocok untuk toko, outlet, atau acara promosi outdoor.']),
            $make($cat('banner-spanduk'), 'Banner Backdrop Event', 150000, ['price_unit' => '/pcs', 'tag' => 'Event', 'sort_order' => 3, 'description' => 'Untuk meeting, pernikahan, gathering. Bahan flexi atau albatros.']),
            $make($cat('banner-spanduk'), 'Banner Hias Dekorasi', 65000, ['price_unit' => '/pcs', 'tag' => 'Dekorasi', 'sort_order' => 4, 'description' => 'Dekorasi ruangan, cafe, atau studio.']),
            $make($cat('banner-spanduk'), 'Banner Custom Desain', 75000, ['price_unit' => '/pcs', 'tag' => 'Custom', 'sort_order' => 5, 'description' => 'Bebas desain sesuai keinginan Anda.']),
            $make($cat('banner-spanduk'), 'X-Banner Standing', 120000, ['price_unit' => '/set', 'badge' => 'PROMO', 'tag' => 'Promosi', 'is_featured' => true, 'sort_order' => 6, 'description' => 'Lengkap dengan standing, cocok untuk pameran & seminar.']),
            $make($cat('banner-spanduk'), 'Roll Banner (Standing)', 200000, ['price_unit' => '/set', 'badge' => 'TERLARIS', 'tag' => 'Event', 'is_featured' => true, 'sort_order' => 7, 'description' => 'Praktis dibawa, mudah dipasang.']),
            $make($cat('banner-spanduk'), 'Foamboard', 25000, ['price_unit' => '/pcs', 'badge' => 'NEW', 'tag' => 'Custom', 'is_featured' => true, 'sort_order' => 8, 'description' => 'Berbagai ukuran, cocok untuk signage & dekorasi.']),
            $make($cat('banner-spanduk'), 'Human Stand', null, ['tag' => 'Promosi', 'sort_order' => 9, 'description' => 'Cutting seukuran manusia untuk promosi mencolok.']),
            $make($cat('banner-spanduk'), 'Tripod Banner', null, ['tag' => 'Event', 'sort_order' => 10, 'description' => 'Banner dengan dudukan tripod, praktis untuk event.']),

            // ═══════════ STIKER & LABEL ═══════════
            $make($cat('stiker-label'), 'Stiker Cutting', 1500, ['price_unit' => '/cm', 'sort_order' => 1, 'description' => 'Cutting rapi mengikuti pola desain Anda.']),
            $make($cat('stiker-label'), 'Stiker Vinyl', 50000, ['price_unit' => '/m²', 'sort_order' => 2, 'description' => 'Tahan air & cuaca, cocok untuk outdoor.']),
            $make($cat('stiker-label'), 'Stiker Label', 2000, ['price_unit' => '/lembar', 'sort_order' => 3, 'description' => 'Label produk, barcode, dan kemasan.']),
            $make($cat('stiker-label'), 'Stiker Bening', 1800, ['price_unit' => '/cm²', 'sort_order' => 4, 'description' => 'Transparan, cocok untuk kaca & botol.']),
            $make($cat('stiker-label'), 'Stiker Nama', 1500, ['price_unit' => '/cm²', 'sort_order' => 5, 'description' => 'Nama untuk helm, buku, perlengkapan sekolah.']),
            $make($cat('stiker-label'), 'Stiker Custom', null, ['sort_order' => 6, 'description' => 'Bentuk & bahan sesuai keinginan, konsultasikan.']),

            // ═══════════ STEMPEL ═══════════
            $make($cat('stempel-otomatis'), 'Stempel Flash', 35000, ['price_unit' => '/pcs', 'sort_order' => 1, 'description' => 'Tinta terintegrasi, siap pakai tanpa bantalan.']),
            $make($cat('stempel-otomatis'), 'Stempel Kayu', 25000, ['price_unit' => '/pcs', 'sort_order' => 2, 'description' => 'Ekonomis dan tahan lama.']),
            $make($cat('stempel-otomatis'), 'Stempel Warna', 45000, ['price_unit' => '/pcs', 'sort_order' => 3, 'description' => 'Bisa mencetak lebih dari satu warna.']),
            $make($cat('stempel-otomatis'), 'Stempel Tanggal', 50000, ['price_unit' => '/pcs', 'sort_order' => 4, 'description' => 'Roda tanggal bisa diputar untuk administrasi.']),
            $make($cat('stempel-otomatis'), 'Stempel Pocket', 30000, ['price_unit' => '/pcs', 'sort_order' => 5, 'description' => 'Kecil, praktis, mudah dibawa.']),
            $make($cat('stempel-otomatis'), 'Stempel Emboss', 75000, ['price_unit' => '/pcs', 'sort_order' => 6, 'description' => 'Cetakan timbul tanpa tinta, kesan profesional.']),
            $make($cat('stempel-otomatis'), 'Stempel Clear / Bening', 40000, ['price_unit' => '/pcs', 'sort_order' => 7, 'description' => 'Transparan untuk penempatan presisi.']),
            $make($cat('stempel-otomatis'), 'Stempel Custom', 60000, ['price_unit' => '/pcs', 'sort_order' => 8, 'description' => 'Bentuk bulat, oval, bintang, karakter, dll.']),

            // ═══════════ KARTU NAMA ═══════════
            $make($cat('kartu-nama'), 'Kartu Nama Art Paper 260gsm', 50000, ['price_unit' => '/box', 'sort_order' => 1, 'description' => 'Permukaan halus, hasil cetak tajam. 1 box = 100 lembar.']),
            $make($cat('kartu-nama'), 'Kartu Nama Art Carton 310gsm', 65000, ['price_unit' => '/box', 'sort_order' => 2, 'description' => 'Lebih tebal dan kokoh.']),
            $make($cat('kartu-nama'), 'Kartu Nama Doff / Matte', 70000, ['price_unit' => '/box', 'sort_order' => 3, 'description' => 'Elegan, tidak reflektif, tidak mudah kotor.']),
            $make($cat('kartu-nama'), 'Kartu Nama Glossy / Laminasi', 75000, ['price_unit' => '/box', 'sort_order' => 4, 'description' => 'Mengilap, tahan air, warna hidup.']),
            $make($cat('kartu-nama'), 'Kartu Nama Premium / Emboss', 100000, ['price_unit' => '/box', 'sort_order' => 5, 'description' => 'Efek timbul, kesan mewah.']),
            $make($cat('kartu-nama'), 'Kartu Nama Custom', 60000, ['price_unit' => '/box', 'sort_order' => 6, 'description' => 'Bentuk, ukuran, dan bahan sesuai keinginan.']),

            // ═══════════ UNDANGAN ═══════════
            $make($cat('undangan-pernikahan-acara'), 'Undangan Per Lembar', 2500, ['price_unit' => '/lembar', 'sort_order' => 1, 'description' => 'Kertas BC 260gr, berbagai pilihan desain.']),
            $make($cat('undangan-pernikahan-acara'), 'Undangan Minimal 50 Lembar', 2000, ['price_unit' => '/lembar', 'sort_order' => 2, 'description' => 'Harga spesial pembelian minimal 50 lembar.']),
            $make($cat('undangan-pernikahan-acara'), 'Undangan Blangko', 1500, ['price_unit' => '/lembar', 'sort_order' => 3, 'description' => 'Isi kosong untuk Anda tulis sendiri.']),
            $make($cat('undangan-pernikahan-acara'), 'Undangan Exclusive', null, ['sort_order' => 4, 'description' => 'Hardcover, softcover, finishing premium. Konsultasikan.']),

            // ═══════════ BUKU, JURNAL & MAJALAH ═══════════
            $make($cat('buku-jurnal-majalah'), 'Buku Tahunan Sekolah', 150000, ['price_unit' => '/eks', 'tag' => 'Buku Tahunan', 'sort_order' => 1, 'description' => 'Hard/soft cover, warna tajam.']),
            $make($cat('buku-jurnal-majalah'), 'Cetak Novel / Buku Fiksi', 75000, ['price_unit' => '/eks', 'tag' => 'Novel', 'sort_order' => 2, 'description' => 'Wujudkan naskah Anda menjadi buku nyata.']),
            $make($cat('buku-jurnal-majalah'), 'Buku Catatan / Jurnal Custom', 25000, ['price_unit' => '/eks', 'tag' => 'Buku Catatan', 'sort_order' => 3, 'description' => 'Desain sampul sesuai keinginan.']),
            $make($cat('buku-jurnal-majalah'), 'Buku Company Profile', 200000, ['price_unit' => '/eks', 'tag' => 'Company Profile', 'sort_order' => 4, 'description' => 'Kertas berkualitas, desain eksklusif.']),
            $make($cat('buku-jurnal-majalah'), 'Buku Tahunan Kampus', 180000, ['price_unit' => '/eks', 'tag' => 'Buku Tahunan', 'sort_order' => 5, 'description' => 'Abadikan momen kebersamaan.']),
            $make($cat('buku-jurnal-majalah'), 'Buku Agenda Custom', 50000, ['price_unit' => '/eks', 'tag' => 'Buku Catatan', 'sort_order' => 6, 'description' => 'Branding perusahaan, cocok untuk hadiah.']),

            // ═══════════ HADIAH CUSTOM & MERCHANDISE ═══════════
            $make($cat('hadiah-custom-merchandise'), 'Frame Foto Custom', null, ['sort_order' => 1, 'description' => 'Bingkai berkualitas dengan desain pribadi.']),
            $make($cat('hadiah-custom-merchandise'), 'Kalender Dinding Custom', null, ['sort_order' => 2, 'description' => 'Hadiah promosi yang efektif.']),
            $make($cat('hadiah-custom-merchandise'), 'Mug Custom', null, ['sort_order' => 3, 'description' => 'Gelas keramik desain unik untuk souvenir.']),
            $make($cat('hadiah-custom-merchandise'), 'Tote Bag Custom', 15000, ['price_unit' => '/pcs', 'sort_order' => 4, 'description' => 'Kanvas tebal, sablon desain Anda.']),
            $make($cat('hadiah-custom-merchandise'), 'Kaos Custom', 55000, ['price_unit' => '/pcs', 'sort_order' => 5, 'description' => 'Bahan cotton combed, sablon berkualitas.']),
            $make($cat('hadiah-custom-merchandise'), 'Gantungan Kunci Custom', 5000, ['price_unit' => '/pcs', 'sort_order' => 6, 'description' => 'Akrilik dengan desain karakter atau logo.']),
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['category_id' => $data['category_id'], 'name' => $data['name']],
                $data
            );
        }
    }
}