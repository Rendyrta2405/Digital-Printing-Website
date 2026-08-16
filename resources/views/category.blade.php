@extends('layouts.app')

@section('title', $category->name . ' - ' . $site->site_name)

@section('content')
{{-- ═══ HERO KATEGORI ═══ --}}
<section class="category-hero">
  <div class="container position-relative">
    <div class="row align-items-center g-4">
      <div class="col-lg-7" data-aos="fade-right">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb breadcrumb-light mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
          </ol>
        </nav>
        <h1 class="fw-extrabold display-4">{{ $category->name }}</h1>
        <p class="lead mb-4" style="color:rgba(255,255,255,.9)">{{ $category->description }}</p>
        @if($category->price_text)
          <span class="price-badge price-badge-lg">{{ $category->price_text }}</span>
        @endif
      </div>
      <div class="col-lg-5 text-center" data-aos="fade-left">
        @if($category->image)
          <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid rounded-4 shadow-lg category-hero-img" alt="{{ $category->name }}">
        @endif
      </div>
    </div>
  </div>
</section>

{{-- ═══ DAFTAR HARGA ═══ --}}
<section class="py-5 bg-white">
  <div class="container">
    <h2 class="section-title">Daftar Harga <span>{{ $category->name }}</span></h2>
    <div class="card shadow-sm border-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="ps-4">Produk</th>
              <th class="text-end pe-4">Harga</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products as $product)
              <tr>
                <td class="ps-4 fw-semibold">
                  {{ $product->name }}
                  @if($product->description)
                    <div class="small text-muted fw-normal">{{ Str::limit($product->description, 60) }}</div>
                  @endif
                </td>
                <td class="text-end pe-4 fw-bold text-primary">
                  {{ $product->formatPrice() }}{{ $product->price_unit ?? '' }}
                </td>
              </tr>
            @empty
              <tr><td colspan="2" class="text-center py-4 text-muted">Belum ada produk di kategori ini.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

{{-- ═══ FILTER & GRID PRODUK ═══ --}}
<section class="py-5" style="background:#f7f8fb">
  <div class="container">
    <h2 class="section-title">Pilih <span>Produk</span></h2>
    
    {{-- Filter Chips (Dinamis dari Database) --}}
    @if($tags->count() > 0)
      <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
        <button class="chip-btn active" data-filter="semua">Semua</button>
        @foreach($tags as $tag)
          <button class="chip-btn" data-filter="{{ $tag }}">{{ $tag }}</button>
        @endforeach
      </div>
    @endif

    {{-- Grid Produk --}}
    <div class="row g-4">
      @forelse($products as $product)
        <div class="col-md-6 col-lg-4 product-item" data-tag="{{ $product->tag }}">
          <div class="card h-100 border-0 shadow-sm hover-lift">
            @if($product->image)
              <div class="img-zoom position-relative">
                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                @if($product->badge)
                  <span class="badge bg-danger position-absolute top-0 end-0 m-3 px-3 py-2">{{ $product->badge }}!</span>
                @endif
              </div>
            @endif
            <div class="card-body d-flex flex-column">
              @if($product->tag)
                <span class="badge bg-primary bg-opacity-10 text-primary align-self-start mb-2 px-2 py-1 small">{{ $product->tag }}</span>
              @endif
              <h5 class="card-title fw-bold">{{ $product->name }}</h5>
              <p class="card-text text-muted flex-grow-1 small">{{ $product->description }}</p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="price">{{ $product->formatPrice() }}<small class="text-muted fw-normal">{{ $product->price_unit ?? '' }}</small></span>
                <button class="btn btn-wa btn-sm" type="button"
                  data-product-id="{{ $product->id }}"
                  data-name="{{ $product->name }}"
                  data-price="{{ $product->price }}"
                  data-unit="{{ $product->price_unit }}"
                  data-bs-toggle="modal" data-bs-target="#orderModal">
                  <i class="bi bi-whatsapp"></i> Pesan
                </button>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted fs-5">Belum ada produk di kategori ini.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- ═══ CTA BANTUAN DESAIN ═══ --}}
<section class="py-5 bg-white">
  <div class="container">
    <div class="card border-0 shadow-lg p-4 p-md-5 text-center" style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe);">
      <h3 class="fw-bold mb-3">Butuh Bantuan Desain {{ $category->name }}?</h3>
      <p class="text-muted mb-4">Tim desainer kami siap membantu membuatkan desain sesuai kebutuhan Anda. Gratis konsultasi!</p>
      <a href="https://wa.me/{{ $site->whatsapp_number }}?text=Halo%20saya%20butuh%20bantuan%20desain%20{{ urlencode($category->name) }}" 
         class="btn btn-wa btn-lg" target="_blank">
        <i class="bi bi-whatsapp"></i> Konsultasi Desain Gratis
      </a>
    </div>
  </div>
</section>

{{-- ═══ JS FILTER CHIPS ═══ --}}
<script>
  document.querySelectorAll('.chip-btn').forEach(chip => {
    chip.addEventListener('click', function() {
      document.querySelectorAll('.chip-btn').forEach(c => c.classList.remove('active'));
      this.classList.add('active');
      
      const filter = this.dataset.filter;
      document.querySelectorAll('.product-item').forEach(item => {
        if (filter === 'semua' || item.dataset.tag === filter) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
</script>
@endsection