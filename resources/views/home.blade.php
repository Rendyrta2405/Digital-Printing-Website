@extends('layouts.app')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="hero overflow-hidden">
  <div class="container position-relative">
    <div class="row align-items-center g-5">
      {{-- Kiri: fokus, tidak lagi sesak --}}
      <div class="col-lg-6" data-aos="fade-right">
        <p class="tagline text-uppercase mb-2">✨ {{ $site->tagline }}</p>
        <h1 class="fw-extrabold">{{ $site->title }}</h1>
        <p class="hero-desc">{{ $site->description }}</p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="https://wa.me/{{ $site->whatsapp_number }}?text=Halo%20{{ urlencode($site->site_name) }}%2C%20saya%20mau%20konsultasi%20cetak%20sekarang."
             class="btn btn-wa btn-lg" target="_blank">
            <i class="bi bi-whatsapp"></i> Konsultasi Gratis
          </a>
          <a href="#faq" class="btn btn-outline-light btn-lg">Cara Order</a>
        </div>
      </div>

      {{-- Kanan: gambar + kartu bukti sosial yang melayang --}}
      <div class="col-lg-6" data-aos="fade-left" data-aos-delay="150">
        <div class="hero-visual">
          <img src="{{ asset('images/hero.png') }}" alt="Ilustrasi Percetakan" class="img-fluid hero-img">
          <div class="hero-badge badge-top">
            <i class="bi bi-lightning-charge-fill"></i> Cetak Kilat 1 Jam Jadi
          </div>
          <div class="hero-badge badge-bottom">
            <span class="stars">★</span> 4.9/5 · 500+ ulasan puas
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══ STATISTIK ═══ --}}
<section class="py-5 overflow-hidden" id="stats">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-6 col-md-3" data-aos="fade-up">
        <div class="stat-number counter" data-target="10" data-suffix="+">10+</div>
        <p class="fw-bold mb-0">Tahun Pengalaman</p>
      </div>
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-number counter" data-target="1500" data-suffix="+">1500+</div>
        <p class="fw-bold mb-0">Klien Puas</p>
      </div>
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-number counter" data-target="5000" data-suffix="+">5000+</div>
        <p class="fw-bold mb-0">Proyek Selesai</p>
      </div>
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="stat-number">24/7</div>
        <p class="fw-bold mb-0">Dukungan</p>
      </div>
    </div>
  </div>
</section>

{{-- ═══ CAROUSEL KATEGORI ═══ --}}
@if ($carouselItems->isNotEmpty())
<section class="py-5 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Pilih Kebutuhan <span>Cetak Anda</span></h2>
    <div id="carouselCategory" data-bs-wrap="false"
       class="carousel slide shadow-lg rounded-4 overflow-hidden">
      <div class="carousel-inner">
        @foreach($carouselItems as $index => $item)
          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            @if($item->image)
              <img src="{{ asset('storage/' . $item->image) }}" 
                 class="d-block w-100 img-carousel"
                   alt="{{ $item->name }}" 
                 onclick="window.location.href='{{ route('categories.show', $item->slug) }}'">
            @endif
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
              <h4 class="fw-bold">{{ $item->name }}</h4>
              <p class="fs-5 mb-2">{{ Str::limit($item->description, 100) }}</p>
              @if($item->price_text)
                <span class="price-badge">{{ $item->price_text }}</span>
              @endif
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" 
         data-bs-target="#carouselCategory" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" 
         data-bs-target="#carouselCategory" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>
@endif

{{-- ═══ TAB DAFTAR HARGA ═══ --}}
@if($navbarCategories->isNotEmpty() && ($productsCount ?? 0) !== 0)
<section id="harga-section" class="py-5" style="background:#eef2f7">
  <div class="container">
    <h2 class="section-title">Daftar <span>Harga</span></h2>
    <ul class="nav nav-tabs" role="tablist">
      @foreach($navbarCategories as $index => $category)
        <li class="nav-item" role="presentation">
          <button class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                  data-bs-target="#tab-{{ $category->slug }}" type="button">
            {{ $category->name }}
          </button>
        </li>
      @endforeach
    </ul>
    <div class="tab-content p-4 bg-white mt-3">
      @foreach($navbarCategories as $index => $category)
        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="tab-{{ $category->slug }}">
          <h4 class="fw-bold mb-3">Harga {{ $category->name }}</h4>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
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
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ═══ KATALOG KATEGORI ═══ --}}
@if($navbarCategories->isNotEmpty())
<section class="py-5 overflow-hidden" id="katalog">
  <div class="container">
    <h2 class="section-title">Kategori <span>Produk</span> Kami</h2>
    <div class="row g-4">
      @foreach($navbarCategories as $category)
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
          <div class="card h-100">
            @if($category->image)
              <div class="img-zoom">
                <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}"
                     onclick="openLightbox(this.src, '{{ $category->name }}')" style="cursor:pointer">
              </div>
            @endif
            <div class="card-body">
              <h5 class="card-title fw-bold">{{ $category->name }}</h5>
              <p class="card-text">{{ Str::limit($category->description, 100) }}</p>
              @if($category->price_text)
                <p class="text-muted mb-2">{{ $category->price_text }}</p>
              @endif
              <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-ink w-100 mt-2">Lihat Kategori</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ═══ GALERI ═══ --}}
@if(isset($galleries) && $galleries->isNotEmpty())
<section class="py-5 overflow-hidden" style="background:#eef2f7">
  <div class="container">
    <h2 class="section-title">Contoh <span>Hasil</span> Cetakan</h2>
    <div class="row g-3">
      @foreach($galleries as $g)
        <div class="col-md-3 col-6" data-aos="zoom-in">
          <div class="img-zoom rounded-4 shadow">
            <img src="{{ asset('storage/' . $g->image) }}" class="img-fluid rounded-4 w-100"
                 style="height:180px;object-fit:cover;cursor:pointer"
                 data-description="{{ $g->description ?? 'Tidak ada deskripsi' }}"
                 onclick="openLightbox(this.src, this.dataset.description)" alt="Galeri">
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ═══ PRODUK TERLARIS ═══ --}}
@if(isset($featuredProducts) && $featuredProducts->isNotEmpty())
<section class="py-5 overflow-hidden" id="produk-terlaris">
  <div class="container">
    <h2 class="section-title">Produk <span>Paling Laris</span></h2>
    <div class="row g-4">
      @foreach($featuredProducts as $product)
        <div class="col-lg-4 col-md-6" data-aos="zoom-in">
          <div class="card position-relative h-100">
            @if($product->badge)
              <span class="badge bg-danger position-absolute top-0 end-0 m-3 z-2">{{ $product->badge }}!</span>
            @endif
            @if($product->image)
              <div class="img-zoom">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                     onclick="openLightbox(this.src, '{{ $product->name }}')" style="cursor:pointer">
              </div>
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold">{{ $product->name }}</h5>
              <p class="card-text flex-grow-1">{{ $product->description }}</p>
              <p class="price mb-2">{{ $product->formatPrice() }}{{ $product->price_unit ?? '' }}</p>
              <button class="btn btn-wa w-100" type="button"
                data-product-id="{{ $product->id }}" data-name="{{ $product->name }}"
                data-price="{{ $product->price }}" data-unit="{{ $product->price_unit }}"
                data-bs-toggle="modal" data-bs-target="#orderModal">Pesan Sekarang</button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ═══ HADIAH CUSTOM ═══ --}}
@if(isset($customProducts) && $customProducts->isNotEmpty())
<section class="py-5 overflow-hidden" id="custom" style="background:#eef2f7">
  <div class="container">
    <h2 class="section-title">Hadiah Custom <span>Unik & Berkesan</span></h2>
    <p class="text-center mb-5 fs-5">Ciptakan hadiah personal untuk orang tersayang atau kebutuhan promosi perusahaan Anda. Kami bantu wujudkan!</p>
    <div class="row g-4">
      @foreach($customProducts as $product)
        <div class="col-lg-4 col-md-6" data-aos="flip-left">
          <div class="card h-100">
            @if($product->image)
              <div class="img-zoom">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
              </div>
            @endif
            <div class="card-body d-flex flex-column">
              @if($product->badge)<span class="badge bg-danger align-self-start mb-2">{{ $product->badge }}!</span>@endif
              <h5 class="card-title fw-bold">{{ $product->name }}</h5>
              <p class="card-text flex-grow-1">{{ $product->description }}</p>
              <button class="btn btn-wa w-100 mt-2" type="button"
                data-product-id="{{ $product->id }}" data-name="{{ $product->name }}"
                data-price="{{ $product->price }}" data-unit="{{ $product->price_unit }}"
                data-bs-toggle="modal" data-bs-target="#orderModal">Pesan Sekarang</button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ═══ WHY US ═══ --}}
<section class="py-5 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Mengapa Ribuan Pelanggan <span>Memilih Kami?</span></h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up">
        <div class="why-card">
          <span class="icon-why-us"><i class="fas fa-bolt-lightning"></i></span>
          <h3 class="h5 fw-bold">Proses Kilat</h3>
          <p class="mb-0">Cetak banner 1 jam jadi, buku 3 hari selesai. Kami paham deadline Anda berharga.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-card">
          <span class="icon-why-us" style="background:linear-gradient(135deg,var(--cyan),var(--primary))">
            <i class="fas fa-phone"></i></span>
          <h3 class="h5 fw-bold">Layanan 24/7</h3>
          <p class="mb-0">Konsultasi kapan saja via WhatsApp. Tim kami siap membantu bahkan di luar jam kerja.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="why-card">
          <span class="icon-why-us" style="background:linear-gradient(135deg,var(--yellow),#f59e0b)">
            <i class="fas fa-sack-dollar"></i></span>
          <h3 class="h5 fw-bold">Harga Termurah</h3>
          <p class="mb-0">Langsung dari pabrik, tanpa perantara. Harga terbaik untuk kualitas premium.</p>
        </div>
      </div>
    </div>
    <div class="d-flex gap-4 justify-content-center align-items-center fs-5 mt-5 flex-wrap fw-semibold">
      <span>✔ Mesin cetak modern</span><span>✔ Proses cepat</span>
      <span>✔ Bisa cetak satuan</span><span>✔ Harga transparan</span>
    </div>
  </div>
</section>

{{-- ═══ VIDEO ═══ --}}
<section class="py-5 overflow-hidden" style="background:#eef2f7">
  <div class="container">
    <h2 class="section-title">Lihat <span>Proses Cetak</span> Kami</h2>
    <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden" data-aos="zoom-in">
      <iframe src="https://www.youtube.com/embed/dps7f1J6FMo" title="Proses cetak" allowfullscreen></iframe>
    </div>
  </div>
</section>

{{-- ═══ TENTANG ═══ --}}
<section class="py-5 overflow-hidden">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <img src="{{ $site->about_img ? asset('storage/' . $site->about_img) : asset('images/img-about.jpeg') }}"
             class="img-fluid rounded-4 shadow-lg w-100" alt="Foto {{ $site->site_name }}">
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <h2 class="fw-extrabold mb-4">Tentang <span style="color:var(--primary)">{{ $site->site_name }}</span></h2>
        <p class="fs-5">{{ $site->about_text }}</p>
        <div class="d-flex gap-4 mt-4 fw-semibold flex-wrap">
          <span><i class="bi bi-check-lg text-success fs-4"></i> Berpengalaman 10+ tahun</span>
          <span><i class="bi bi-check-lg text-success fs-4"></i> 1500+ proyek sukses</span>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══ FASILITAS ═══ --}}
@if($facilities->isNotEmpty())
<section class="py-5 overflow-hidden" style="background:#eef2f7">
  <div class="container">
    <h2 class="section-title">Fasilitas & <span>Teknologi</span> Terkini</h2>
    <div class="row g-4">
      @foreach($facilities as $f)
        <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in">
          <div class="card h-100">
            <div class="img-zoom">
              <img src="{{ asset('storage/' . $f->image) }}" class="card-img-top" style="height:160px"
                   alt="{{ $f->name }}" data-name="{{ $f->name }}"
                   onclick="openLightbox(this.src, this.dataset.name)" >
            </div>
            <div class="card-body p-2">
              <p class="card-title text-center fw-bold mb-0">{{ $f->name }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ═══ TESTIMONI ═══ --}}
@if(isset($testimonials) && $testimonials->isNotEmpty())
<section class="py-5 overflow-hidden">
  <div class="container">
    <h2 class="section-title">Apa Kata <span>Mereka</span> yang Sudah Cetak di <span>{{ $site->site_name }}</span></h2>
    <div class="row g-4">
      @foreach($testimonials as $testimonial)
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
          <div class="testimonial-card">
            @if ($testimonial->image)
              <img src="{{ asset('storage/' . $testimonial->image) }}" 
                 alt="{{ $testimonial->name }}">
            @endif
            <div class="rating mb-2">
              @for($i = 0; $i < $testimonial->rating; $i++)
                <i class="bi bi-star-fill"></i>
              @endfor
            </div>
            <p class="text-break">"{{ $testimonial->content }}"</p>
            <h5 class="mb-0 fw-bold">{{ $testimonial->name }}</h5>
            <small class="text-muted">{{ $testimonial->role }}</small>
          </div>
        </div>
      @endforeach
    </div>
@endif

    {{-- Form Testimoni --}}
    <div class="card mt-5 shadow" data-aos="fade-up">
      <div class="card-body p-4 p-md-5">
        <h5 class="fw-extrabold text-center mb-4">
           {{ $testimonials->isNotEmpty() ? 'Bagikan Pengalaman Anda'
              : 'Jadilah Yang Pertama Memberikan Ulasan' }}
        </h5>
        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Nama</label>
              <input name="name" class="form-control" required
                 placeholder="Cth: Budi Santoso"
                 pattern="[a-zA-Z\s]{3,100}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Profesi (opsional)</label>
              <input name="role" class="form-control" 
                 placeholder="Cth: Guru"
                 pattern="[a-zA-Z\s]{3,100}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Foto (opsional)</label>
              <input type="file" name="image" class="form-control"
                 accept="image/*">
            </div>
            <div class="col-md-4">
              <label class="form-label">Rating</label>
              <select name="rating" class="form-select">
                @for ($i = 5; $i >= 1; $i--)
                  <option value="{{ $i }}">{{ str_repeat('⭐', $i) }} ({{ $i }})</option>
                @endfor
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Deskripsi</label>
              <textarea name="content" class="form-control" 
                 placeholder="Ceritakan pengalaman Anda… (Minimal 10 karakter)" 
                 required minlength="10" maxlength="200"></textarea>
            </div>
            <div class="col-12 text-center">
              <button class="btn btn-wa px-5">Kirim Ulasan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

{{-- ═══ BRAND PARTNER ═══ --}}
@if($partners->isNotEmpty())
<section class="py-5 overflow-hidden" style="background:#eef2f7">
  <div class="container">
    <h2 class="section-title">Dipercaya oleh <span>Brand Ternama</span></h2>
    <div class="row g-4 align-items-center justify-content-center">
      @foreach($partners as $p)
        <div class="col-6 col-md-3 col-lg-2" data-aos="fade">
          <div class="card p-3 text-center h-100">
            <img src="{{ asset('storage/' . $p->image) }}" class="img-fluid mx-auto" style="max-height:70px;object-fit:contain" alt="{{ $p->name ?? 'Brand' }}">
            <p class="mb-0 mt-2 fw-semibold small">{{ $p->name }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- Animasi counter statistik --}}
<script>
  document.querySelectorAll('.counter').forEach(el => {
    const target = +el.dataset.target, suffix = el.dataset.suffix || '';
    let current = 0;
    const step = Math.max(1, Math.ceil(target / 60));
    const timer = setInterval(() => {
      current += step;
      if (current >= target) { current = target; clearInterval(timer); }
      el.textContent = current + suffix;
    }, 25);
  });
</script>
@endsection