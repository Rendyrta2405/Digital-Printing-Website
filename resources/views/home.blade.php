@extends('layouts.app')

@section('content')

@if (session('success'))
 <div class="bg-emerald-100 text-emerald-700 px-4 py-3 rounded-lg text-sm">
     ✅ {{ session('success') }}
 </div>
@endif

<!-- Hero Section dengan copywriting kuat -->
<section class="hero overflow-hidden">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
        <p class="text-uppercase fw-bold mb-2" style="color: #ffd966;">
           {{ $site->tagline }}
        </p>
        <h1>{{ $site->title }}</h1>
         <p>{{ $site->description }}</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="https://wa.me/{{ $site['whatsapp_number'] }}?text=Halo%20{{ $site['site_name'] }}%2C%20saya%20mau%20konsultasi%20cetak%20sekarang." class="btn btn-wa" target="_blank">
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
@if ($navbarCategories->pluck('image'))
<section class="products-categories mt-3 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Pilih Kebutuhan <span>Cetak Anda</span></h2>
    <div id="carouselExampleCaptions" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
         @foreach($navbarCategories as $index => $category)
           <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
             @if($category->image)
              <img onclick="window.location.href='/kategori/{{ $category->slug }}'" src="{{ asset('storage/' . $category->image) }}" class="d-block w-100 img-carousel position-relative img-carousel-1" alt="{{ $category->name }}">
             @endif
             <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
               <h4 class="fw-bold">{{ $category->name }}</h4>
               <p class="fs-5">{{ Str::limit($category->description, 100) }}</p>
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
@endif

 <!-- ═══════════════════════════════════════════════════════ -->
 <!-- TAB "Daftar Harga" - DINAMIS dengan Bootstrap Tabs!    -->
 <!-- ═══════════════════════════════════════════════════════ -->
@if(isset($navbarCategories) && $navbarCategories->isNotEmpty() && $productsCount !== 0)
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
@endif

<!-- Kategori Produk (Dinamis) -->
@if(isset($navbarCategories) && $navbarCategories->isNotEmpty())
<section class="py-5 overflow-hidden" id="katalog">
  <div class="container">
    <h2 class="section-title">Kategori <span>Produk</span> Kami</h2>
     
    <div class="row g-4 product-catalog">
       @foreach($navbarCategories as $category)
         <div class="col-md-6 col-lg-4">
           <div class="card h-100">
             <img onclick="openLightbox(this.src, null)" style="cursor:pointer" 
                src="{{ asset('storage/' . $category->image) }}" 
                class="card-img-top" alt="{{ $category->name }}">
             <div class="card-body">
               <h5 class="card-title">{{ $category->name }}</h5>
               <p class="card-text">{{ Str::limit($category->description, 100) }}</p>

               @if($category->price_text)
               <p class="text-muted">{{ $category->price_text }}</p>
               @endif
               <a href="{{ route('categories.index') }}" class="btn btn-wa w-100 mt-2">Lihat Kategori</a>
             </div>
           </div>
         </div>
       @endforeach
    </div>
  </div>
</section>
@endif

<!-- Galeri Dinamis -->
@if(isset($galleries) && $galleries->isNotEmpty())
<section class="py-5 bg-light overflow-hidden">
  <div class="container">
    <h2 class="section-title">Contoh <span>Hasil</span> Cetakan</h2>
    <div class="row g-4">
       @foreach($galleries as $g)
      <div class="col-md-3 col-6">
        <img src="{{ asset('storage/' . $g->image) }}" 
           class="img-fluid rounded-3 shadow"
           data-description="{{ $g->description ?? 'Tidak ada deskripsi' }}"
           onclick="openLightbox(this.src, this.dataset.description)" 
           style="cursor:pointer"
           alt="Galeri gambar">
      </div>
       @endforeach
    </div>
  </div>
</section>
@endif

<!-- New Products (Produk Terlaris) -->
@if(isset($featuredProducts) && $featuredProducts->isNotEmpty())
<section class="product py-5 overflow-hidden" id="produk-terlaris">
  <div class="container">
    <h2 class="section-title">Produk <span>Paling Laris</span></h2>
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
               <button class="btn btn-wa w-100 mt-2" type="button" 
                 data-product-id="{{ $product->id }}"
                 data-name="{{ $product->name }}"
                 data-price="{{ $product->price }}"
                 data-unit="{{ $product->price_unit }}"
                 data-bs-toggle="modal"
                 data-bs-target="#orderModal">Pesan Sekarang</button>
             </div>
           </div>
         </div>
       @endforeach
    </div>
  </div>
</section>
@endif

<!-- Custom Hadiah -->
@if(isset($customProducts) && $customProducts->isNotEmpty())
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
               <button class="btn btn-wa w-100 mt-2" type="button" 
                 data-product-id="{{ $product->id }}"
                 data-name="{{ $product->name }}"
                 data-price="{{ $product->price }}"
                 data-unit="{{ $product->price_unit }}"
                 data-bs-toggle="modal"
                 data-bs-target="#orderModal">Pesan Sekarang</button>
             </div>
           </div>
         </div>
       @endforeach
    </div>
  </div>
</section>
@endif

<!-- Why Us (keunggulan) -->
<section class="why-us py-5 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Mengapa Ribuan Pelanggan <span>Memilih Kami?</span></h2>
    <div class="row g-4">
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="why-card">
          <span class="icon-why-us fas fa-bolt-lightning"></span>
          <h3>Proses Kilat</h3>
          <p>Cetak banner 1 jam jadi, buku 3 hari selesai. Kami paham deadline Anda berharga.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="why-card">
         <span class="icon-why-us fas fa-phone"></span>
          <h3>Layanan 24/7</h3>
          <p>Konsultasi kapan saja via WhatsApp. Tim kami siap membantu bahkan di luar jam kerja.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="why-card">
            <span class="icon-why-us fas fa-sack-dollar"></span>
          <h3>Harga Termurah</h3>
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

<!-- Tentang Kami (Dinamis) -->
<section class="about py-5 overflow-hidden">
  <div class="container">
    <div class="row align-items-center text-center">
      <div class="col-md-12 col-lg-6 mb-3" data-aos="fade-right">
         @if(isset($site->about_img))
        <img src="{{ asset('storage/' . $site['about_img']) }}" 
           class="img-fluid rounded-4 shadow-lg" 
           alt="Foto {{ $site->site_name }}">
         @else
        <img src="{{ asset('images/img-about.jpeg') }}" 
           class="img-fluid rounded-4 shadow-lg" 
           alt="Foto {{ $site->site_name }}">
         @endif
      </div>
      <div class="col-md-12 col-lg-6" data-aos="fade-left" data-aos-delay="200">
        <h2 class="fw-bold mb-4">Tentang <span style="color: var(--primary);">{{ $site->site_name }}</span></h2>
        <p class="fs-5">{{ $site->about_text }}</p>
        <div class="d-flex gap-3 mt-4 align-items-center justify-content-center">
          <div><i class="bi bi-check-lg text-success fs-3"></i> Berpengalaman 10+ tahun</div>
          <div><i class="bi bi-check-lg text-success fs-3"></i> 1500+ proyek sukses</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Fasilitas (Dinamis) -->
@if($facilities->isNotEmpty())
<section class="facility py-5 bg-light overflow-hidden">
  <div class="container">
    <h2 class="section-title">Fasilitas & <span>Teknologi</span> Terkini</h2>
    <div class="row g-4">
       @foreach($facilities as $f)
      <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
        <div class="card">
          <img data-name="{{ $f->name }}"
             onclick="openLightbox(this.src, this.dataset.name)" 
             src="{{ asset('storage/' . $f->image) }}" 
             class="card-img-top" alt="{{ $f->name }}">
          <div class="card-body p-2">
            <p class="card-title text-center">{{ $f->name }}</p>
          </div>
        </div>
      </div>
       @endforeach
    </div>
  </div>
</section>
@endif

<!-- Testimoni (Dinamis) -->
@if(isset($testimonials) && $testimonials->isNotEmpty())
<section class="testimoni py-5 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Apa Kata <span>Mereka</span> yang Sudah Cetak di <span>{{ $site->site_name }}</span></h2>
    <div class="row g-4">
       @foreach($testimonials as $testimonial)
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="testimonial-card">
           @if ($testimonial->image)
             <img class="text-sm" src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
           @endif
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
@endif

<!-- Form Testimoni -->
<section>
   <div class="card mt-4">
      <div class="card-body">
        <h5 class="section-title">Bagikan Pengalaman Anda</h5>
         <form action="{{ route('testimonials.store') }}" method="post" 
            class="d-flex gap-3 flex-wrap justify-content-center align-items-center" enctype="multipart/form-data">
            @csrf
   
            <div class="col-8 col-md-4 mb-3">
               <label for="">Nama</label>
               <input name="name" class="form-control" placeholder="Nama anda.." required>
            </div>
            <div class="col-8 col-md-4 mb-3">
               <label for="">Profesi (opsional)</label>
               <input name="role" class="form-control" placeholder="Pekerjaan..">
            </div>
            <div class="col-8 col-md-4 mb-3">
               <label for="">Foto (opsional)</label>
               <input type="file" name="image" class="form-control">
            </div>
            <div class="col-8 col-md-4 mb-3">
               <label for="">Rating</label>
               <select name="rating" id="" class="form-select">
                  @for ($i = 5; $i >= 1; $i--)
                     <option value="{{ $i }}">{{ str_repeat('⭐', $i) . ' (' . $i . ')'  }}</option>
                  @endfor
               </select>
            </div>
            <div class="col-8 mb-3">
               <label for="">Deskripsi</label>
               <textarea name="content" class="form-control" 
                  placeholder="Ceritakan pengalaman Anda…" required></textarea>
            </div>
            <div class="col-8 mb-3">
               <button class="btn btn-success fw-bold">Kirim Ulasan</button>
            </div>
         </form>
      </div>
   </div>
</section>

<!-- Brand Partner (Dinamis) -->
@if($partners->isNotEmpty())
<section class="brand py-5 bg-light overflow-hidden">
  <div class="container">
    <h2 class="section-title">Dipercaya oleh <span>Brand Ternama</span></h2>
    <div class="row g-4 align-items-center justify-content-center">
       @foreach($partners as $p)
      <div class="col-6 col-md-3" data-aos="fade" data-aos-delay="100">
        <img src="{{ asset('storage/' . $p->image) }}" 
           class="img-fluid" alt="{{ $p->name ?? 'Brand' }}">
         <div class="card-body p-2">
            <p class="card-title text-center">{{ $p->name }}</p>
          </div>
      </div>
       @endforeach
    </div>
  </div>
</section>
@endif
@endsection