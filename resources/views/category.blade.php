@extends('layouts.app')

@section('content')
<!-- Hero Kategori -->
<section class="hero mb-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
        <h1>{{ $category->name }}</h1>
        <p class="mb-4">{{ $category->description }}</p>
         @if($category->price_text)
            <span class="badge bg-success fs-6 mb-3">{{ $category->price_text }} !!!</span>
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
        <img src="/assets/banner-hero-1.jpg" alt="Ilustrasi Percetakan" class="img-fluid rounded">
      </div>
    </div>
  </div>
</section>

<!-- Section Harga -->
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
       <div class="col-md-4 col-sm-6 product-item" data-kategori="{{ $product->tag }}" data-aos="fade-up" data-aos-delay="100">
         <div class="product-card">
           <div class="product-image">
             <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" onclick="openLightbox(this.src)">
             <span class="product-badge">Promosi</span>
           </div>
           <div class="product-info">
             <h3>Banner Promosi Ukuran Besar</h3>
             <p>Cocok untuk toko, outlet, atau acara promosi outdoor. Bahan flexi 280g.</p>
             <div class="product-price">Rp 85.000</div>
             <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Banner Promosi')">Pesan via WA</a>
           </div>
         </div>
       </div>
     @endforeach
  </div>
</section>
@endsection
