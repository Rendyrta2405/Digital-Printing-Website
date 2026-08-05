<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stiker - Percetakan Online</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    :root {
      --primary: #0f6a64;
      --primary-dark: #0b524d;
      --primary-light: #e0f2f1;
      --secondary: #4CAF50;
      --secondary-dark: #3b9c40;
      --light: #f8f9fa;
      --dark: #212529;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #ffffff;
      color: var(--dark);
      overflow-x: hidden;
      padding-bottom: 55px; /* agar footer tidak tertutup sticky-cta */
    }

    /* Navbar */
    .navbar {
      background-color: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: all 0.3s;
    }
    .navbar.scrolled {
      padding: 5px 0;
      background-color: rgba(255,255,255,0.95) !important;
      backdrop-filter: blur(10px);
    }
    .navbar-brand {
      font-weight: 700;
      color: var(--primary) !important;
      transition: color 0.3s;
    }
    .navbar-brand:hover {
      transform: scale(1.05);
    }
    .nav-link {
      font-weight: 500;
      color: var(--dark) !important;
      transition: all 0.3s;
      position: relative;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      background: var(--primary);
      transition: width 0.3s;
    }
    .nav-link:hover::after,
    .nav-link.active::after {
      width: 80%;
    }
    .nav-link:hover,
    .nav-link.active {
      color: var(--primary) !important;
    }

    /* Floating WhatsApp */
    .floating-wa {
      position: fixed;
      bottom: 100px; /* naikkan agar tidak bertumpuk sticky-cta */
      right: 30px;
      background: #25D366;
      color: white;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 35px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      z-index: 9999;
      animation: pulse-wa 2s infinite;
    }
    @keyframes pulse-wa {
      0% { transform: scale(1); box-shadow: 0 8px 25px rgba(0,0,0,0.2); }
      50% { transform: scale(1.1); box-shadow: 0 15px 35px rgba(76,175,80,0.5); }
      100% { transform: scale(1); box-shadow: 0 8px 25px rgba(0,0,0,0.2); }
    }
    .floating-wa:hover {
      animation: none;
      transform: scale(1.15) rotate(5deg);
      background: #20ba45;
    }
    /* Sembunyikan sticky CTA dan floating WA saat modal terbuka di mobile */
    body.modal-open .sticky-cta,
    body.modal-open .floating-wa {
      display: none;
    }

    /* Sticky CTA Bottom Bar */
    .sticky-cta {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background: white;
      box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
      padding: 12px 20px;
      z-index: 9998;
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
      border-top: 3px solid var(--primary);
    }
    .sticky-cta .btn-cta-sticky {
      padding: 12px 30px;
      font-weight: 700;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .btn-order-sticky {
      background: var(--secondary);
      color: white;
    }
    .btn-order-sticky:hover {
      background: var(--secondary-dark);
      transform: translateY(-2px);
      color: white;
    }
    .btn-price-sticky {
      background: var(--primary);
      color: white;
    }
    .btn-price-sticky:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      color: white;
    }
    @media (max-width: 768px) {
      .sticky-cta {
        padding: 8px 10px;
        gap: 10px;
      }
      .sticky-cta .btn-cta-sticky {
        padding: 8px 10px;
        font-size: 0.9rem;
      }
      .floating-wa{
        bottom: 60px;
        right: 10px;
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
        font-size: 1.5em;
      }
    }

    /* Hero Stiker */
    .hero {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      padding: 80px 0 60px 0;
      margin-bottom: 30px;
      position: relative;
      overflow: hidden;
    }
    .hero::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      animation: rotate 30s linear infinite;
    }
    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    .hero h1 {
      font-weight: 700;
      margin-bottom: 20px;
      animation: fadeInUp 1s ease-out;
    }
    .hero p {
      font-size: 1.2rem;
      opacity: 0.9;
      animation: fadeInUp 1s ease-out 0.2s both;
    }
    .btn-wa {
      background-color: var(--secondary);
      color: white;
      border: none;
      padding: 12px 30px;
      font-weight: 600;
      border-radius: 50px;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
      z-index: 1;
      animation: fadeInUp 1s ease-out 0.4s both;
    }
    .btn-wa::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255,255,255,0.3);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
      z-index: -1;
    }
    .btn-wa:hover::before {
      width: 300px;
      height: 300px;
    }
    .btn-wa:hover {
      background-color: #3b9c40;
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    .btn-wa i {
      margin-right: 8px;
    }
    .hero img {
      animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
      100% { transform: translateY(0px); }
    }

    /* Google Review Style */
    .google-review {
      display: inline-flex;
      align-items: center;
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(5px);
      padding: 8px 16px;
      border-radius: 50px;
      margin-top: 20px;
      border: 1px solid rgba(255,255,255,0.3);
    }
    .google-review .stars {
      color: #FFD700;
      margin-right: 10px;
      font-size: 1.2rem;
    }
    .google-review .rating-text {
      font-weight: 600;
      margin-right: 5px;
    }
    .google-review .total-reviews {
      opacity: 0.9;
    }

    /* Section Harga Stiker */
    .price-section {
      background: linear-gradient(145deg, #ffffff, #f8f9fa);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      transition: transform 0.3s, box-shadow 0.3s;
      border: 1px solid rgba(15,106,100,0.1);
    }
    .price-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(15,106,100,0.15);
    }
    .price-item {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px dashed #ddd;
      font-size: 1.4em;
    }
    .price-item:last-child {
      border-bottom: none;
    }
    .price-item .size {
      font-size: 1.6em;
      font-weight: 600;
      color: var(--dark);
    }
    .price-item .price {
      color: var(--primary);
      font-weight: 700;
      background: rgba(15,106,100,0.1);
      padding: 10px 12px;
      border-radius: 50px;
    }
    .price-note {
      text-align: center;
      margin-top: 15px;
      color: #666;
      font-style: italic;
    }

    /* Filter Buttons */
    .filter-container {
      margin-bottom: 30px;
    }
    .btn-filter {
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
      padding: 8px 20px;
      margin: 0 5px 10px;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    .btn-filter::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: var(--primary);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
      z-index: -1;
    }
    .btn-filter:hover::before {
      width: 300px;
      height: 300px;
    }
    .btn-filter:hover,
    .btn-filter.active {
      color: white;
    }
    .btn-filter.active {
      background: var(--primary);
      color: white;
    }

    /* Product Card - gaya sedikit berbeda */
    .product-card {
      background: white;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0,0,0,0.03);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      border: 1px solid #eee;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .product-card:hover {
      transform: translateY(-12px) scale(1.02);
      box-shadow: 0 25px 40px rgba(15,106,100,0.15);
      border-color: var(--primary);
    }
    .product-image {
      position: relative;
      overflow: hidden;
      height: 200px;
      cursor: pointer;
    }
    .product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s;
    }
    .product-card:hover .product-image img {
      transform: scale(1.1);
    }
    .product-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: var(--primary);
      color: white;
      padding: 5px 12px;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 600;
      z-index: 2;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    .product-info {
      padding: 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .product-info h3 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 5px;
      color: var(--dark);
    }
    .product-info p {
      color: #666;
      font-size: 0.9rem;
      margin-bottom: 10px;
      flex: 1;
    }
    .product-price {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 15px;
    }
    /* Tombol order di card menggunakan btn-wa (hijau) */
    .btn-order {
      background: var(--secondary);
      color: white;
      border: none;
      padding: 10px 0;
      width: 100%;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-block;
      text-align: center;
      margin-top: auto;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    .btn-order::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255,255,255,0.3);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
      z-index: -1;
    }
    .btn-order:hover::before {
      width: 300px;
      height: 300px;
    }
    .btn-order:hover {
      background: var(--secondary-dark);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(15,106,100,0.3);
    }

    /* Lightbox */
    .lightbox {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.95);
      z-index: 9999;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.4s;
    }
    .lightbox.show {
      display: flex;
      opacity: 1;
    }
    .lightbox img {
      max-width: 90%;
      max-height: 80%;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(255,255,255,0.2);
      transform: scale(0.9);
      transition: transform 0.4s;
    }
    .lightbox.show img {
      transform: scale(1);
    }
    .lightbox .close {
      position: absolute;
      top: 30px;
      right: 40px;
      color: white;
      font-size: 50px;
      cursor: pointer;
      transition: all 0.3s;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: rgba(255,255,255,0.1);
    }
    .lightbox .close:hover {
      background: var(--primary);
      transform: rotate(90deg);
    }
    .lightbox .prev,
    .lightbox .next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      color: white;
      font-size: 40px;
      cursor: pointer;
      padding: 20px;
      transition: all 0.3s;
      opacity: 0.7;
    }
    .lightbox .prev:hover,
    .lightbox .next:hover {
      opacity: 1;
      color: var(--primary);
      transform: translateY(-50%) scale(1.2);
    }
    .lightbox .prev { left: 20px; }
    .lightbox .next { right: 20px; }

    /* Modal */
    .modal-content {
      border-radius: 20px;
      padding: 20px;
    }
    .modal-header {
      border-bottom: 2px solid var(--primary);
    }
    .btn-modal-order {
      background: var(--secondary);
      color: white;
      width: 100%;
      padding: 12px;
      border-radius: 50px;
      font-weight: 700;
      border: none;
      margin-top: 20px;
      transition: all 0.3s;
    }
    .btn-modal-order:hover {
      background: var(--secondary-dark);
      transform: translateY(-3px);
    }
    .radio-group {
      display: flex;
      gap: 20px;
      margin: 15px 0;
    }
    .radio-group label {
      font-weight: 500;
    }

    /* Responsive modal */
    @media (max-width: 576px) {
      .modal-dialog {
        margin: 0.5rem;
      }
    }

    /* FAQ Section Title (sama seperti di file rekaman) */
    #faq .section-title, #harga-section .section-title{
      text-align: center;
      font-weight: 700;
      margin-bottom: 40px;
      color: var(--dark);
    }
    #faq .section-title span,#harga-section .section-title span{
      color: var(--primary);
    }

    /* Accordion custom */
    .accordion-button:not(.collapsed) {
      background-color: var(--primary);
      color: white;
    }
    .accordion-button:focus {
      box-shadow: none;
    }

    /* Footer dipercantik */
    footer {
      background: linear-gradient(135deg, #1e2b2a, var(--primary));
      color: white;
      padding: 40px 0;
      margin-top: 60px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    footer::before {
      content: '';
      position: absolute;
      top: -50px;
      left: 0;
      right: 0;
      height: 100px;
      background: linear-gradient(135deg, transparent 50%, rgba(255,255,255,0.1) 50%);
      animation: wave 10s linear infinite;
    }
    footer h4 {
      font-weight: 700;
      margin-bottom: 15px;
    }
    footer p {
      opacity: 0.9;
    }

    /* Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }
      .hero p {
        font-size: 1rem;
      }
      .btn-filter {
        padding: 5px 12px;
        font-size: 0.8rem;
      }
      .lightbox .prev,
      .lightbox .next {
        font-size: 30px;
        padding: 10px;
      }
       .price-item {
        font-size: 1rem;
      }
      .price-item .size {
        font-size: 1.1em;
      }
      .price-item .price {
        padding: 10px 12px;
      }
    }
  </style>
</head>
<body>

<!-- Floating WhatsApp -->
<a href="https://wa.me/6283171125657?text=Halo%20saya%20ingin%20pesan%20stiker" class="floating-wa" target="_blank">
  <i class="bi bi-whatsapp"></i>
</a>

<!-- Sticky CTA Bottom Bar -->
<div class="sticky-cta">
  <a href="#product" class="btn-cta-sticky btn-order-sticky" target="_blank">
    <i class="bi bi-whatsapp"></i>Pesan Sekarang
  </a>
  <a href="#harga-section" class="btn-cta-sticky btn-price-sticky">
    <i class="bi bi-tag"></i> Lihat Harga
  </a>
</div>

<!-- Navbar -->
<header>
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="#">Toko Percetakan</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Banner/">Banner</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/Stiker/">Stiker</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Stempel/">Stempel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Kartu-Nama/">Kartu Nama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Undangan/">Undangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Buku/">Buku</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- Hero Stiker -->
<section class="hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
        <h1>Stiker Custom Berkualitas</h1>
        <p class="mb-4">Berbagai jenis stiker untuk kebutuhan branding, label produk, dekorasi, dan lainnya. Bisa custom sesuai desain Anda.</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="https://wa.me/6283171125657?text=Halo%20Toko%20Percetakan%2C%20saya%20ingin%20konsultasi%20cetak%20stiker." class="btn btn-wa" target="_blank">
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
      <div class="col-md-6 text-center mt-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
        <img src="/assets/hero-stiker.jpg" alt="Ilustrasi Percetakan" class="img-fluid rounded">
      </div>
    </div>
  </div>
</section>

<!-- Section Harga Stiker -->
<section class="py-5 bg-light" id="harga-section">
  <div class="container">
    <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Daftar Harga <span>Stiker</span></h2>
    <div class="row g-4">
      <div class="col-md-8 mx-auto">
        <div class="price-section">
          <h4 class="text-center fw-bold mb-3"><i class="bi bi-sticky text-primary me-2"></i>Harga Stiker</h4>
          <div class="price-item">
            <span class="size">Cutting (per cm²)</span>
            <span class="price">Rp 1.500</span>
          </div>
          <div class="price-item">
            <span class="size">Vinyl (per m²)</span>
            <span class="price">Rp 50.000</span>
          </div>
          <div class="price-item">
            <span class="size">Label (per lembar)</span>
            <span class="price">Rp 2.000</span>
          </div>
          <div class="price-note">*Harga tergantung kerumitan desain. Konsultasikan kebutuhan Anda.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Filter Kategori -->
<section class="container filter-container">
  <div class="text-center">
    <button class="btn-filter active" data-filter="all" data-aos="flip-up" data-aos-delay="100">Semua</button>
    <button class="btn-filter" data-filter="cutting" data-aos="flip-up" data-aos-delay="150">Stiker Cutting</button>
    <button class="btn-filter" data-filter="vinyl" data-aos="flip-up" data-aos-delay="200">Stiker Vinyl</button>
    <button class="btn-filter" data-filter="label" data-aos="flip-up" data-aos-delay="250">Stiker Label</button>
    <button class="btn-filter" data-filter="bening" data-aos="flip-up" data-aos-delay="300">Stiker Bening</button>
    <button class="btn-filter" data-filter="custom" data-aos="flip-up" data-aos-delay="350">Custom</button>
  </div>
</section>

<!-- Grid Produk Stiker -->
<section class="container overflow-hidden" id="product">
  <div class="row g-4" id="product-grid">
    <!-- Stiker Cutting -->
    <div class="col-md-4 col-sm-6 product-item" data-kategori="cutting" data-aos="fade-up" data-aos-delay="100">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stiker1.jpeg" alt="Stiker Cutting" onclick="openLightbox(this.src)">
          <span class="product-badge">Cutting</span>
        </div>
        <div class="product-info">
          <h3>Stiker Cutting / Decal</h3>
          <p>Stiker tanpa background, mengikuti bentuk desain. Cocok untuk logo, nama, atau dekorasi dinding.</p>
          <div class="product-price">Rp 1.500 / cm²</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stiker Cutting', 'cutting', 1500)">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stiker Vinyl -->
    <div class="col-md-4 col-sm-6 product-item" data-kategori="vinyl" data-aos="fade-left" data-aos-delay="150">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stiker2.jpeg" alt="Stiker Vinyl" onclick="openLightbox(this.src)">
          <span class="product-badge">Vinyl</span>
        </div>
        <div class="product-info">
          <h3>Stiker Vinyl Premium</h3>
          <p>Bahan vinyl tahan air dan awet. Cocok untuk outdoor, stiker mobil, atau stiker produk.</p>
          <div class="product-price">Rp 50.000 / m²</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stiker Vinyl', 'vinyl', 50000)">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stiker Label -->
    <div class="col-md-4 col-sm-6 product-item" data-kategori="label" data-aos="zoom-in" data-aos-delay="200">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stiker3.jpeg" alt="Stiker Label" onclick="openLightbox(this.src)">
          <span class="product-badge">Label</span>
        </div>
        <div class="product-info">
          <h3>Stiker Label Produk</h3>
          <p>Label untuk kemasan produk, botol, atau box. Tersedia bahan chromo atau vinyl.</p>
          <div class="product-price">Rp 2.000 / lembar</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stiker Label', 'label', 2000)">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stiker Bening -->
    <div class="col-md-4 col-sm-6 product-item" data-kategori="bening" data-aos="flip-left" data-aos-delay="250">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stiker4.jpg" alt="Stiker Bening" onclick="openLightbox(this.src)">
          <span class="product-badge">Bening</span>
        </div>
        <div class="product-info">
          <h3>Stiker Bening / Clear</h3>
          <p>Stiker transparan tanpa background putih. Cocok untuk etalase, kaca, atau produk premium.</p>
          <div class="product-price">Rp 1.800 / cm²</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stiker Bening', 'bening', 1800)">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stiker Custom -->
    <div class="col-md-4 col-sm-6 product-item" data-kategori="custom" data-aos="fade-right" data-aos-delay="300">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stiker5.jpg" alt="Stiker Custom" onclick="openLightbox(this.src)">
          <span class="product-badge">Custom</span>
        </div>
        <div class="product-info">
          <h3>Stiker Custom Desain</h3>
          <p>Bebas desain, bentuk, dan ukuran. Konsultasikan kebutuhan stiker Anda dengan tim kami.</p>
          <div class="product-price">Konsultasi</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openCustomModal('Stiker Custom')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stiker Cutting 2 (tambahan) -->
    <div class="col-md-4 col-sm-6 product-item" data-kategori="cutting" data-aos="flip-right" data-aos-delay="350">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stiker6.jpg" alt="Stiker Nama" onclick="openLightbox(this.src)">
          <span class="product-badge">Cutting</span>
        </div>
        <div class="product-info">
          <h3>Stiker Nama / Lettering</h3>
          <p>Stiker huruf untuk nama toko, nama orang, atau kutipan. Bahan vinyl berkualitas.</p>
          <div class="product-price">Rp 1.500 / cm²</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stiker Nama', 'cutting', 1500)">Pesan via WA</a>
        </div>
      </div>
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

<!-- Modal Order Steps (diperbarui) -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Pesan <span id="modalProductName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Konten akan diisi JavaScript -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn-modal-order" onclick="sendOrderViaWA()">Pesan via WhatsApp</button>
      </div>
    </div>
  </div>
</div>

<!-- CTA Stiker -->
<section class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center" data-aos="zoom-in" data-aos-duration="800">
      <div class="p-5" style="background: var(--primary-light); border-radius: 20px;">
        <h3 class="fw-bold mb-3">Butuh Stiker Custom?</h3>
        <p class="mb-4">Kirimkan desain Anda atau minta bantuan tim desain kami. Gratis konsultasi!</p>
        <a href="https://wa.me/6283171125657?text=Halo%20saya%20butuh%20bantuan%20desain%20stiker" class="btn-order" style="width: auto; padding: 12px 30px;" target="_blank">Konsultasi Gratis</a>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="faq py-5" id="faq">
  <div class="container">
    <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Pertanyaan <span>Umum</span></h2>
    <div class="accordion" id="accordionExample">
      <div class="accordion-item" data-aos="fade-up">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            🎯 Cara Order Super Cepat:
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ol class="mb-0">
              <li>Pilih produk yang kamu mau di halaman ini (Stiker, dll).</li>
              <li> Klik tombol "Pesan" pada produk pilihanmu.</li>
              <li>Akan muncul form order yang sudah siap pakai:
               <ul>
                  <li>Pilih jenis bahan.</li>
                  <li>Isi ukuran (lebar & tinggi) sesuai kebutuhan.</li>
                  <li>Masukkan jumlah.</li>
                  <li>Total harga langsung terhitung otomatis!</li>
                  <li>Pilih opsi: "Ya, saya punya desain" atau "Tidak, tolong buatkan".</li>
               </ul>
            </li>
              <li> Klik "Pesan via WhatsApp" → otomatis terhubung ke admin kami dengan pesan yang sudah berisi detail pesananmu.</li>
              <li>Tinggal kirim file desain (jika punya) atau diskusi lebih lanjut dengan tim kami. Simpel, kan?</li>
            </ol>
            <br>
            <p>🔄 Gratis konsultasi, respon cepat, dan siap bantu dari desain hingga jadi!</p>
          </div>
        </div>
      </div>
      <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            ⏱️ Estimasi Waktu Pengerjaan:
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ul>
              <li>Banner & Spanduk: 1–2 jam (ukuran standar, bisa lebih cepat jika urgent)</li>
              <li>Stiker: 1–2 hari (tergantung kerumitan dan jumlah)</li>
              <li>Buku: 2–5 hari (tergantung jumlah halaman, jenis jilid, dan jumlah eksemplar)</li>
              <li>Kartu Nama: 1–2 hari</li>
              <li>Undangan: 2–3 hari</li>
              <li>Stempel: 1–2 hari</li>
              <li>Produk Custom lainnya: konsultasikan langsung — kami selalu berusaha memenuhi deadline Anda!</li>
            </ul>
            <br>
            <p>⚠️ Catatan: Waktu pengerjaan dapat bervariasi tergantung antrian dan kompleksitas. Untuk estimasi pasti, silakan hubungi kami via WhatsApp.</p>
          </div>
        </div>
      </div>
      <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Apakah bisa desain sendiri?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Tentu! Anda bisa kirim file desain (format PDF, CDR, AI, JPG resolusi tinggi). Jika belum punya desain, tim kami siap membantu membuatkannya dengan biaya terjangkau.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <h4 class="text-white" data-aos="fade-down" data-aos-duration="800">Toko Percetakan</h4>
    <p class="mb-0" data-aos="fade-up" data-aos-delay="100">Jl. Raya Kayu Tinggi No.87, Cakung, Jakarta Timur</p>
    <p class="mb-0" data-aos="fade-up" data-aos-delay="150">WhatsApp: +62 831-7112-5657</p>
    <p class="mt-3" data-aos="fade-up" data-aos-delay="200">&copy; 2026 Toko Percetakan. All rights reserved.</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  // Initialize AOS
  AOS.init({
    duration: 1000,
    once: true,
    mirror: true
  });

  // Navbar scroll effect
  window.addEventListener('scroll', function() {
    const nav = document.getElementById('mainNav');
    if (window.scrollY > 50) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
    }
  });

  // Lightbox variables
  let currentImageIndex = 0;
  const images = [];

  // Collect all product images
  document.querySelectorAll('.product-image img').forEach((img, index) => {
    images.push(img.src);
  });

  // Lightbox functions
  window.openLightbox = function(src) {
    currentImageIndex = images.indexOf(src);
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.add('show');
    document.body.style.overflow = 'hidden';
  };

  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('show');
    document.body.style.overflow = '';
  }

  function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    document.getElementById('lightbox-img').src = images[currentImageIndex];
  }

  function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    document.getElementById('lightbox-img').src = images[currentImageIndex];
  }

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('show')) return;
    
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') prevImage();
    if (e.key === 'ArrowRight') nextImage();
  });

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

  // ===== MODAL FUNCTIONS (UPDATE) =====
  const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));

  // Sembunyikan sticky CTA dan floating WA saat modal terbuka di mobile
  document.getElementById('orderModal').addEventListener('show.bs.modal', function () {
    if (window.innerWidth <= 768) {
      document.body.classList.add('modal-open');
    }
  });
  document.getElementById('orderModal').addEventListener('hide.bs.modal', function () {
    if (window.innerWidth <= 768) {
      document.body.classList.remove('modal-open');
    }
  });

  // Fungsi update harga berdasarkan kategori
  function updateModalPrice() {
    const kategori = document.getElementById('modalKategori').value;
    const hargaSatuan = parseFloat(document.getElementById('modalHargaSatuan').value);
    const lebar = parseFloat(document.getElementById('modalLebar')?.value) || 0;
    const tinggi = parseFloat(document.getElementById('modalTinggi')?.value) || 0;
    const jumlah = parseInt(document.getElementById('modalJumlah')?.value) || 1;
    
    let total = 0;
    if (kategori === 'vinyl') {
      // harga per m², lebar dan tinggi dalam meter
      total = lebar * tinggi * jumlah * hargaSatuan;
    } else if (kategori === 'label') {
      // harga per lembar
      total = jumlah * hargaSatuan;
    } else {
      // cutting, bening, dll: harga per cm²
      total = lebar * tinggi * jumlah * hargaSatuan;
    }
    
    document.getElementById('modalTotalPrice').innerText = 'Rp ' + Math.round(total).toLocaleString('id-ID');
  }

  // Fungsi utama membuka modal untuk stiker biasa
  window.openOrderModal = function(productName, kategori, hargaSatuan) {
    document.getElementById('modalProductName').innerText = productName;
    
    // Tentukan placeholder dan nilai default berdasarkan kategori
    let lebarDefault = 10;
    let tinggiDefault = 10;
    let step = 1;
    let satuan = 'cm';
    let showUkuran = true;
    
    if (kategori === 'vinyl') {
      lebarDefault = 1;
      tinggiDefault = 1;
      step = 0.1;
      satuan = 'm';
    } else if (kategori === 'label') {
      // label tidak perlu ukuran, hanya jumlah
      showUkuran = false;
    }
    
    let ukuranHTML = '';
    if (showUkuran) {
      ukuranHTML = `
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Lebar (${satuan})</label>
            <input type="number" class="form-control" id="modalLebar" value="${lebarDefault}" min="0.1" step="${step}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Tinggi (${satuan})</label>
            <input type="number" class="form-control" id="modalTinggi" value="${tinggiDefault}" min="0.1" step="${step}">
          </div>
        </div>
      `;
    }
    
    let modalContent = `
      <form id="orderForm">
        <input type="hidden" id="productNameInput" value="${productName}">
        <input type="hidden" id="modalKategori" value="${kategori}">
        <input type="hidden" id="modalHargaSatuan" value="${hargaSatuan}">
        ${ukuranHTML}
        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" class="form-control" id="modalJumlah" value="1" min="1" step="1">
        </div>
        <div class="mb-3">
          <label class="form-label">Total Harga</label>
          <div class="fw-bold fs-4 text-primary" id="modalTotalPrice">Rp 0</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Sudah punya desain?</label>
          <div class="radio-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="desainOption" id="desainYa" value="ya" checked>
              <label class="form-check-label" for="desainYa">Ya, saya punya desain</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="desainOption" id="desainTidak" value="tidak">
              <label class="form-check-label" for="desainTidak">Tidak, tolong buatkan</label>
            </div>
          </div>
        </div>
      </form>
    `;
    
    document.getElementById('modalBody').innerHTML = modalContent;
    
    // Pasang event listener
    if (kategori !== 'label' && showUkuran) {
      document.getElementById('modalLebar').addEventListener('input', updateModalPrice);
      document.getElementById('modalTinggi').addEventListener('input', updateModalPrice);
    }
    document.getElementById('modalJumlah').addEventListener('input', updateModalPrice);
    
    updateModalPrice();
    orderModal.show();
  };

  // Fungsi untuk custom (produk custom)
  window.openCustomModal = function(productName) {
    document.getElementById('modalProductName').innerText = productName;
    
    let modalContent = `
      <form id="orderForm">
        <input type="hidden" id="productNameInput" value="${productName}">
        <div class="mb-3">
          <label class="form-label">Jenis Produk</label>
          <input type="text" class="form-control" value="${productName}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" class="form-control" id="modalJumlah" value="1" min="1" step="1">
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi kebutuhan (ukuran, bahan, warna, dll)</label>
          <textarea class="form-control" id="modalNotes" rows="3" placeholder="Contoh: Stiker cutting huruf, tinggi 20cm, warna merah"></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Sudah punya desain?</label>
          <div class="radio-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="desainOption" id="desainYa" value="ya" checked>
              <label class="form-check-label" for="desainYa">Ya, saya punya desain</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="desainOption" id="desainTidak" value="tidak">
              <label class="form-check-label" for="desainTidak">Tidak, tolong buatkan</label>
            </div>
          </div>
        </div>
      </form>
    `;
    
    document.getElementById('modalBody').innerHTML = modalContent;
    orderModal.show();
  };

  // Fungsi kirim pesan WhatsApp (DIPERBAIKI dengan format rapi)
  window.sendOrderViaWA = function() {
    const product = document.getElementById('productNameInput').value;
    const desain = document.querySelector('input[name="desainOption"]:checked').value;
    const desainText = desain === 'ya' 
      ? 'Ya, saya punya desain (file akan saya kirim manual)' 
      : 'Tidak, tolong buatkan desainnya';
    
    let message = '';
    
    // Cek apakah ini custom (ada textarea modalNotes)
    const modalNotes = document.getElementById('modalNotes');
    if (modalNotes) {
      // Custom
      const jumlah = document.getElementById('modalJumlah').value;
      const notes = modalNotes.value;
      message = `Halo, Toko Percetakan\n\n` +
                `Saya mau pesan: ${product}\n` +
                `Jumlah: ${jumlah} buah\n` +
                (notes ? `Catatan: ${notes}\n` : '') +
                `Desain: ${desainText}\n\n` +
                `Terima kasih.`;
    } else {
      // Stiker biasa
      const kategori = document.getElementById('modalKategori').value;
      const jumlah = document.getElementById('modalJumlah').value;
      let ukuran = '';
      let satuan = '';
      let lebar = '';
      let tinggi = '';
      
      if (kategori === 'label') {
        ukuran = '';
      } else {
        lebar = document.getElementById('modalLebar').value;
        tinggi = document.getElementById('modalTinggi').value;
        satuan = kategori === 'vinyl' ? 'meter' : 'cm';
        ukuran = `Ukuran: ${lebar} x ${tinggi} ${satuan}\n`;
      }
      
      const total = document.getElementById('modalTotalPrice').innerText;
      
      message = `Halo, Toko Percetakan\n\n` +
                `Saya mau pesan: ${product}\n` +
                `Jumlah: ${jumlah} buah\n` +
                ukuran +
                `Total Harga: ${total}\n` +
                `Desain: ${desainText}\n\n` +
                `Terima kasih.`;
    }
    
    window.open('https://wa.me/6283171125657?text=' + encodeURIComponent(message), '_blank');
    orderModal.hide();
  };
</script>

</body>
</html>