@extends('layouts.app')

@section('content')
<!-- Hero Section dengan copywriting kuat -->
<section class="hero overflow-hidden">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
        <p class="text-uppercase fw-bold mb-2" style="color: #ffd966;">✨ Percetakan No.1 di Jakarta Timur</p>
        <h1>Cetak Kilat 1 Jam Jadi! <br>Kualitas Premium, Harga Merakyat</h1>
        <p class="mb-4">Jangan buang waktu antri di tempat lain. Toko Percetakan siap melayani cetak banner, buku, stiker, dan kebutuhan promosi Anda dengan kecepatan kilat dan hasil yang memukau. Dijamin puas atau uang kembali!</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="https://wa.me/6283171125657?text=Halo%20Toko%20Percetakan%2C%20saya%20mau%20konsultasi%20cetak%20sekarang." class="btn btn-wa" target="_blank">
            <i class="bi bi-whatsapp"></i> Konsultasi Gratis
          </a>
          <a href="#stats" class="btn btn-outline-light btn-lg">Lihat Bukti</a>
          <a href="#faq" class="btn btn-outline-light btn-lg">Cara Order</a>
        </div>
        <!-- Google Review Style -->
        <div class="google-review">
          <span class="stars">★★★★★</span>
          <span class="rating-text">4.9 / 5</span>
          <span class="total-reviews">(500+ ulasan)</span>
        </div>
        <div class="mt-4 d-flex gap-4">
          <div><i class="bi bi-check-circle-fill text-warning"></i> 10+ Tahun Pengalaman</div>
          <div><i class="bi bi-check-circle-fill text-warning"></i> 1500+ Klien Puas</div>
        </div>
      </div>
      <div class="mt-4 col-md-6 text-center" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
        <img src="{{ asset('images/hero.png') }}" alt="Ilustrasi Percetakan" class="img-fluid float-1">
      </div>
    </div>
  </div>
</section>

<!-- Statistik (dengan angka animasi) -->
<section class="py-5 overflow-hidden" id="stats">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-6 col-md-3">
        <div class="year stat-number counter" data-target="10">10+</div>
        <p class="fw-bold">Tahun Pengalaman</p>
      </div>
      <div class="col-6 col-md-3">
        <div class="clients stat-number counter" data-target="1500">1500+</div>
        <p class="fw-bold">Klien Puas</p>
      </div>
      <div class="col-6 col-md-3">
        <div class="projects stat-number counter" data-target="5000">5000+</div>
        <p class="fw-bold">Proyek Selesai</p>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-number counter" data-target="24">24/7</div>
        <p class="fw-bold">Dukungan</p>
      </div>
    </div>
  </div>
</section>

<!-- Kategori Produk (Carousel dengan teks marketing) -->
<section class="products-categories mt-3 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Pilih Kebutuhan <span>Cetak Anda</span></h2>
    <div id="carouselExampleCaptions" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
         @foreach($navbarCategories as $index => $category)
           <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
             @if($category->image)
              <img onclick="window.location.href='/kategori/{{ $category->slug }}'" src="{{ asset($category->image) }}" class="d-block w-100 img-carousel position-relative img-carousel-1" alt="{{ $category->name }}">
             @endif
             <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
               <h3 class="fw-bold">{{ $category->name }}</h3>
               <p class="fs-5">{{ $category->description }}</p>
                @if($category->price_text)
                   <p class="price-badge">{{ $category->price_text }}</p>
                @endif
             </div>
           </div>
         @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

 <!-- ═══════════════════════════════════════════════════════ -->
 <!-- TAB "Daftar Harga" - DINAMIS dengan Bootstrap Tabs!    -->
 <!-- ═══════════════════════════════════════════════════════ -->
 <section id="harga-section" class="py-5 bg-light">
     <div class="container">
         <h2 class="text-center mb-4">Daftar Harga</h2>
         
         <!-- Tab Navigation -->
         <ul class="nav nav-tabs" role="tablist">
             @foreach($navbarCategories as $index => $category)
                 <li class="nav-item" role="presentation">
                     <button 
                         class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                         data-bs-toggle="tab" 
                         data-bs-target="#tab-{{ $category->slug }}"
                         type="button">
                         {{ $category->name }}
                     </button>
                 </li>
             @endforeach
         </ul>
         
         <!-- Tab Content -->
         <div class="tab-content p-4 bg-white">
             @foreach($navbarCategories as $index => $category)
                 <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                      id="tab-{{ $category->slug }}">
                     <h4>Harga {{ $category->name }}</h4>
                     <table class="table">
                         <tbody>
                             @foreach($category->products as $product)
                                 <tr>
                                     <td>{{ $product->name }}</td>
                                     <td>{{ $product->formatPrice() }}{{ $product->price_unit ?? '' }}</td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             @endforeach
         </div>
     </div>
 </section>

<!-- Katalog Produk Lengkap -->
<section class="py-5 overflow-hidden" id="katalog">
  <div class="container">
    <h2 class="section-title">Katalog <span>Produk</span> Kami</h2>
     
    <div class="row g-4 product-catalog">
       @foreach($navbarCategories as $category)
         <div class="col-md-6 col-lg-4">
           <div class="card h-100">
             <img onclick="openLightbox(this.src)" style="cursor:pointer" src="assets/banner.jpg" class="card-img-top" alt="Banner">
             <div class="card-body">
               <h5 class="card-title">{{ $category->name }}</h5>
               <p class="card-text">{{ $category->description }}</p>

               @if($category->price_text)
               <p class="text-muted">{{ $category->price_text }}</p>
               @endif
               <a href="/kategori/{{ $category->slug }}" class="">Lihat Pilihan</a>
             </div>
           </div>
         </div>
       @endforeach
    </div>
  </div>
</section>

<!-- Galeri Contoh Hasil (dengan tambahan 8 gambar baru) -->
<section class="py-5 bg-light overflow-hidden">
  <div class="container">
    <h2 class="section-title">Contoh <span>Hasil</span> Cetakan</h2>
    <div class="row g-4">
      <!-- 4 gambar existing -->
      <div class="col-md-3 col-6">
        <img src="assets/new-product-1.jpg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/new-product-2.jpg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/new-product-3.jpg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/new-product-4.jpg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <!-- 8 gambar baru dari user -->
      <div class="col-md-3 col-6">
        <img src="assets/album.jpeg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/backdrop.jpeg" class="img-fluid rounded-3 shadow h-100" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/kaos.jpeg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/mug.jpg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/yasin.jpeg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/paper-bag.jpeg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/kalender.jpeg" class="img-fluid rounded-3 shadow" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
      <div class="col-md-3 col-6">
        <img src="assets/stempel.jpeg" class="img-fluid rounded-3 shadow h-100" onclick="openLightbox(this.src)" style="cursor:pointer">
      </div>
    </div>
  </div>
</section>

<!-- New Products (Produk Terlaris) -->
<section class="product py-5 overflow-hidden" id="produk-terlaris">
  <div class="container">
    <h2 class="section-title">Produk <span>Terbaru</span> Paling Laris</h2>
    <div class="row g-4">
       @foreach($featuredProducts as $product)
         <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
           <div class="card position-relative">
              @if($product->badge)
             <span class="badge bg-danger position-absolute top-0 end-0 m-3">{{ $product->badge }}!</span>
              @endif
             <img onclick="openLightbox(this.src)" src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
             <div class="card-body">
               <h5 class="card-title">{{ $product->name }}</h5>
               <p class="card-text">{{ $product->description }}</p>
               <p class="price">{{ $product->formatPrice() }}{{ $product->price_unit ?? '' }}</p>
               <a href="javascript:void(0)" class="btn btn-wa w-100 mt-2" onclick="openOrderModal('Spanduk Custom')">Pesan Sekarang</a>
             </div>
           </div>
         </div>
       @endforeach
    </div>
  </div>
</section>

<!-- Custom Hadiah -->
<section class="custom-reward py-5 bg-light overflow-hidden" id="custom">
  <div class="container">
    <h2 class="section-title">Hadiah Custom <span>Unik & Berkesan</span></h2>
    <p class="text-center mb-5 fs-5">Ciptakan hadiah personal untuk orang tersayang atau kebutuhan promosi perusahaan Anda. Kami bantu wujudkan!</p>
    <div class="row g-4">
       @foreach($customProducts as $product)
         <div class="col-lg-4 col-md-6" data-aos="flip-left" data-aos-delay="100">
           <div class="card">
             <img onclick="openLightbox(this.src)" src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
             <div class="card-body">
                @if($product->badge)
                  <span class="badge bg-danger">
                     {{ $product->badge }}!
                  </span>
                 @endif
               <h5 class="card-title">{{ $product->name }}</h5>
               <p class="card-text">{{ $product->description }}</p>
               <a href="javascript:void(0)" class="btn btn-wa w-100" onclick="openCustomModal('Frame Foto Custom', 'custom')">Pesan Sekarang</a>
             </div>
           </div>
         </div>
       @endforeach
    </div>
  </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
  <span class="close" onclick="closeLightbox()">&times;</span>
  <span class="prev" onclick="prevImage()">&#10094;</span>
  <span class="next" onclick="nextImage()">&#10095;</span>
  <img id="lightbox-img" src="">
</div>

<!-- Modal Order Steps - Akan diisi dinamis oleh JavaScript -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Pesan <span id="modalProductName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Konten akan diisi oleh JavaScript -->
        <p>Loading...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn-modal-order" onclick="sendOrderViaWA()">Pesan via WhatsApp</button>
      </div>
    </div>
  </div>
</div>

<!-- Why Us (keunggulan) -->
<section class="why-us py-5 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Mengapa Ribuan Pelanggan <span>Memilih Kami?</span></h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-card">
          <img src="assets/icon1.png" alt="Cepat">
          <h3>⚡ Proses Kilat</h3>
          <p>Cetak banner 1 jam jadi, buku 3 hari selesai. Kami paham deadline Anda berharga.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="why-card">
          <img src="assets/icon2.png" alt="24 Jam">
          <h3>📞 Layanan 24/7</h3>
          <p>Konsultasi kapan saja via WhatsApp. Tim kami siap membantu bahkan di luar jam kerja.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="why-card">
          <img src="assets/icon3.png" alt="Harga">
          <h3>💰 Harga Termurah</h3>
          <p>Langsung dari pabrik, tanpa perantara. Dapatkan harga terbaik untuk kualitas premium.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex gap-5 justify-content-center align-items-center fs-3 mt-3 flex-wrap">
    <span>✔ Mesin cetak modern</span>
    <span>✔ Proses cepat</span>
    <span>✔ Bisa cetak satuan</span>
    <span>✔ Harga transparan</span>
  </div>
</section>

<!-- Video (YouTube) -->
<section class="video py-5 bg-light overflow-hidden">
  <div class="container">
    <h2 class="section-title">Lihat <span>Proses Cetak</span> Kami</h2>
    <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden" data-aos="zoom-in">
      <iframe src="https://www.youtube.com/embed/dps7f1J6FMo" title="YouTube video" allowfullscreen></iframe>
    </div>
  </div>
</section>

<!-- Tentang Kami -->
<section class="about py-5 overflow-hidden">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right">
        <img src="assets/img-about.jpeg" class="img-fluid rounded-4 shadow-lg" alt="Tentang Kami">
      </div>
      <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
        <h2 class="fw-bold mb-4">Tentang <span style="color: var(--primary);">Toko Percetakan</span></h2>
        <p class="fs-5">Sejak 2016, Toko Percetakan telah menjadi mitra percetakan terpercaya bagi ribuan pelanggan, dari UMKM hingga perusahaan besar. Kami menggabungkan teknologi modern dengan sentuhan tradisional untuk menghasilkan cetakan berkualitas tinggi.</p>
        <p class="fs-5">Kami percaya bahwa setiap cetakan adalah representasi dari usaha Anda. Itulah mengapa kami selalu mengutamakan ketelitian, kecepatan, dan kepuasan pelanggan.</p>
        <div class="d-flex gap-3 mt-4">
          <div><i class="bi bi-check-lg text-success fs-3"></i> Berpengalaman 10+ tahun</div>
          <div><i class="bi bi-check-lg text-success fs-3"></i> 1500+ proyek sukses</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Fasilitas -->
<section class="facility py-5 bg-light overflow-hidden">
  <div class="container">
    <h2 class="section-title">Fasilitas & <span>Teknologi</span> Terkini</h2>
    <div class="row g-4">
      <div class="col-6 col-md-4 col-lg-2" data-aos="zoom-in" data-aos-delay="100">
        <div class="card">
          <img onclick="openLightbox(this.src)" src="assets/fasilitas1.jpg" class="card-img-top" alt="Mesin Cetak Offset">
          <div class="card-body p-2">
            <p class="card-title text-center">Offset Printing</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2" data-aos="zoom-in" data-aos-delay="150">
        <div class="card">
          <img onclick="openLightbox(this.src)" src="assets/fasilitas2.jpg" class="card-img-top" alt="Digital Printing">
          <div class="card-body p-2">
            <p class="card-title text-center">Digital Printing</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2" data-aos="zoom-in" data-aos-delay="200">
        <div class="card">
          <img onclick="openLightbox(this.src)" src="assets/fasilitas3.jpg" class="card-img-top" alt="Laminating">
          <div class="card-body p-2">
            <p class="card-title text-center">Laminating</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2" data-aos="zoom-in" data-aos-delay="250">
        <div class="card">
          <img onclick="openLightbox(this.src)" src="assets/fasilitas4.jpg" class="card-img-top" alt="Cutting Sticker">
          <div class="card-body p-2">
            <p class="card-title text-center">Cutting Sticker</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2" data-aos="zoom-in" data-aos-delay="300">
        <div class="card">
          <img onclick="openLightbox(this.src)" src="assets/fasilitas5.jpg" class="card-img-top" alt="Binding">
          <div class="card-body p-2">
            <p class="card-title text-center">Binding Buku</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2" data-aos="zoom-in" data-aos-delay="350">
        <div class="card">
          <img onclick="openLightbox(this.src)" src="assets/fasilitas6.jpg" class="card-img-top" alt="UV Printing">
          <div class="card-body p-2">
            <p class="card-title text-center">UV Printing</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimoni -->
<section class="testimoni py-5 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Apa Kata <span>Mereka</span> yang Sudah Cetak di Toko Percetakan</h2>
    <div class="row g-4">
       @foreach($testimonials as $testimonial)
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="testimonial-card">
          <img src="{{ asset('images/' . $testimonial->image) }}" alt="Budi">
          <div class="rating">
             @for($i = 0; $i < $testimonial->rating; $i++)
               <i class="bi bi-star-fill"></i>
             @endfor
          </div>
          <p>
             "{{ $testimonial->content }}"
          </p>
          <h5 class="mb-0">{{ $testimonial->name }}</h5>
          <small class="text-muted">{{ $testimonial->role }}</small>
        </div>
      </div>
       @endforeach
    </div>
  </div>
</section>

<!-- Brand Partner -->
<section class="brand py-5 bg-light overflow-hidden">
  <div class="container">
    <h2 class="section-title">Dipercaya oleh <span>Brand Ternama</span></h2>
    <div class="row g-4 align-items-center justify-content-center">
      <div class="col-6 col-md-3" data-aos="fade" data-aos-delay="100">
        <img src="assets/brand1.png" class="img-fluid" alt="Brand 1">
      </div>
      <div class="col-6 col-md-3" data-aos="fade" data-aos-delay="150">
        <img src="assets/brand2.png" class="img-fluid" alt="Brand 2">
      </div>
      <div class="col-6 col-md-3" data-aos="fade" data-aos-delay="200">
        <img src="assets/brand3.png" class="img-fluid" alt="Brand 3">
      </div>
      <div class="col-6 col-md-3" data-aos="fade" data-aos-delay="250">
        <img src="assets/brand4.png" class="img-fluid" alt="Brand 4">
      </div>
    </div>
  </div>
</section>
@endsection