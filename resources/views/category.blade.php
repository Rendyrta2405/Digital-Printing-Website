@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<!-- Hero Kategori -->
<section class="hero mb-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
         <p>{{ $category->slogan ?? '' }}</p>
        <h1>{{ $category->title }}</h1>
        <p class="mb-4">{{ $category->description }}</p>
         @if($category->price_text)
            <span class="badge bg-success fs-6 mb-3">
               {{ $category->price_text }} !!!
            </span>
         @endif
        <div class="d-flex flex-wrap gap-3">
          <a href="https://wa.me/6283171125657?text=Halo%20Toko%20Percetakan%2C%20saya%20ingin%20konsultasi%20cetak%20banner." class="btn btn-wa" target="_blank">
            <i class="bi bi-whatsapp"></i> Konsultasi Gratis
          </a>
          <a href="#faq" class="btn btn-outline-light">Cara Order</a>
        </div>
        <!-- Google Review Style -->
        <div class="google-review">
          <span class="stars">★★★★★</span>
          <span class="rating-text">4.9 / 5</span>
          <span class="total-reviews">(500+ ulasan)</span>
        </div>
      </div>
      <div class="mt-4 col-md-6 text-center" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
        <img src="{{ asset('storage/' . $category->image) }}" 
           alt="{{ $category->name }}" class="img-fluid rounded">
      </div>
    </div>
  </div>
</section>

<!-- Section Harga -->
@if($products->isNotEmpty())
<section class="py-5 bg-light" id="harga-section">
  <div class="container">
    <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Daftar Harga <span>{{ $category->name }}</span></h2>
    <div class="row g-4">
      <div class="col-12 mx-auto">
        <div class="price-section">
           @foreach($products as $product)
             <div class="price-item">
               <span class="size">{{ $product->name }}</span>
               <span class="price">{{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : 'Konsultasi Harga'  }}{{ $product->price_unit ?? '' }}</span>
             </div>
           @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@else
<div class="bg-light py-5 text-center shadow">
   Belum ada Produk di Kategori ini 😶
   <br>
   📞 Silahkan hubungi kami untuk info lebih lanjut
   <br>
   Atau coba temukan produk di Kategori lainnya.
</div>
@endif

<!-- Filter Kategori Product -->
@if($tags->count() > 0)
<section class="container filter-container">
  <div class="text-center">
    <button class="btn-filter active" data-filter="all" data-aos="flip-up" data-aos-delay="100">Semua</button>
     @foreach($tags as $tag)
       <button class="btn-filter" data-filter="{{ $tag }}" data-aos="flip-up" data-aos-delay="150">{{ $tag }}</button>
     @endforeach
  </div>
</section>
@endif

{{-- ═══ GRID PRODUK ═══ --}}
<!-- Grid Produk Banner -->
<section class="container overflow-hidden" id="product">
  <div class="row g-4" id="product-grid">
     @foreach($products as $product)
       <div class="col-md-6 col-sm-4 product-item" data-kategori="{{ $product->tag }}" data-aos="" data-aos-delay="">
         <div class="product-card">
           <div class="product-image">
             <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" onclick="openLightbox(this.src)">
              @if($product->badge)
                <span class="product-badge">{{ $product->badge }}</span>
              @endif
           </div>
           <div class="product-info">
             <h3>{{ $product->name }}</h3>
             <p>{{ $product->description }}</p>
              <button type="button" class="btn-order"
                 data-product-id="{{ $product->id }}"
                 data-name="{{ $product->name }}"
                 data-price="{{ $product->price }}"
                 data-unit="{{ $product->price_unit }}"
                 data-bs-toggle="modal"
                 data-bs-target="#orderModal">
                 {{ $product->formatPrice() }}{{ $product->price_unit ?? '' }}
              </button>
             {{-- <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Banner Promosi')">{{ $product->formatPrice() }}{{ $product->price_unit ?? '' }}</a> --}}
           </div>
         </div>
       </div>
     @endforeach
  </div>
</section>

<script>
   // Filter functionality
  const filterBtns = document.querySelectorAll('.btn-filter');
  const products = document.querySelectorAll('.product-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filterValue = btn.getAttribute('data-filter');

      products.forEach(product => {
        const kategori = product.getAttribute('data-kategori');
        if (filterValue === 'all' || kategori === filterValue) {
          product.style.display = 'block';
          product.style.animation = 'fadeInUp 0.6s';
        } else {
          product.style.display = 'none';
        }
      });
    });
  });
</script>
@endsection
