<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stempel - Percetakan Online</title>
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
      bottom: 100px;
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

    /* Hero */
    .hero {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      padding: 80px 0;
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

    /* Section Harga Stempel */
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
      font-size: 1.1rem;
    }
    .price-item:last-child {
      border-bottom: none;
    }
    .price-item .size {
      font-weight: 600;
      color: var(--dark);
    }
    .price-item .price {
      color: var(--primary);
      font-weight: 700;
      background: rgba(15,106,100,0.1);
      padding: 4px 12px;
      border-radius: 50px;
    }
    .price-note {
      text-align: center;
      margin-top: 15px;
      color: #666;
      font-style: italic;
    }

    /* Product Card */
    .product-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      border: 1px solid #eee;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .product-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: 0 20px 40px rgba(15,106,100,0.2);
      border-color: var(--primary);
    }
    .product-image {
      position: relative;
      overflow: hidden;
      height: 220px;
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
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 8px;
      color: var(--dark);
    }
    .product-info p {
      color: #666;
      font-size: 0.95rem;
      margin-bottom: 15px;
      flex: 1;
    }
    .product-price {
      font-size: 1.2rem;
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
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-block;
      text-align: center;
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
        #harga-section .section-title, #faq .section-title{
      text-align: center;
      font-weight: 700;
      margin-bottom: 30px;
      color: var(--dark);
    }
    .kategori-banner .section-title span , #harga-section .section-title span, #faq .section-title span{
      color: var(--primary);
    }

    /* Responsive modal */
    @media (max-width: 576px) {
      .modal-dialog {
        margin: 0.5rem;
      }
    }

    /* FAQ Accordion custom */
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
    }
  </style>
</head>
<body>

<!-- Floating WhatsApp -->
<a href="https://wa.me/6283171125657?text=Halo%20saya%20ingin%20pesan%20stempel" class="floating-wa" target="_blank">
  <i class="bi bi-whatsapp"></i>
</a>

<!-- Sticky CTA Bottom Bar -->
<div class="sticky-cta">
  <a href="#product" class="btn-cta-sticky btn-order-sticky" target="_blank">
    <i class="bi bi-whatsapp"></i>Pesan Sekarang
  </a>
  <a href="#harga-section" class="btn-cta-sticky btn-price-sticky">
    <i class="bi bi-tag"></i>Lihat Harga
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
            <a class="nav-link" href="/Stiker/">Stiker</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/Stempel/">Stempel</a>
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

<!-- Hero Stempel -->
<section class="hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
        <h1>Stempel Custom Berkualitas</h1>
        <p class="mb-4">Berbagai jenis stempel untuk kebutuhan kantor, perusahaan, dan pribadi. Tersedia stempel flash, kayu, warna, tanggal, pocket, emboss, bening, dan custom bentuk.</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="https://wa.me/6283171125657?text=Halo%20Toko%20Percetakan%2C%20saya%20ingin%20konsultasi%20cetak%20stempel." class="btn btn-wa" target="_blank">
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
        <img src="/assets/hero-stempel.jpg" alt="Ilustrasi Stempel" class="img-fluid rounded">
      </div>
    </div>
  </div>
</section>

<!-- Section Harga Stempel -->
<section class="py-5 bg-light" id="harga-section">
  <div class="container">
    <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Daftar Harga <span>Stempel</span></h2>
    <div class="row g-4">
      <div class="col-md-8 mx-auto">
        <div class="price-section">
          <h4 class="text-center fw-bold mb-3"><i class="bi bi-pencil-fill text-primary me-2"></i>Harga Stempel</h4>
          <div class="price-item">
            <span class="size">Stempel Kayu</span>
            <span class="price">Rp 25.000</span>
          </div>
          <div class="price-item">
            <span class="size">Stempel Flash</span>
            <span class="price">Rp 35.000</span>
          </div>
          <div class="price-item">
            <span class="size">Stempel Warna</span>
            <span class="price">Rp 45.000</span>
          </div>
          <div class="price-item">
            <span class="size">Stempel Tanggal</span>
            <span class="price">Rp 50.000</span>
          </div>
          <div class="price-item">
            <span class="size">Stempel Pocket</span>
            <span class="price">Rp 30.000</span>
          </div>
          <div class="price-item">
            <span class="size">Stempel Emboss</span>
            <span class="price">Rp 75.000</span>
          </div>
          <div class="price-note">*Harga dapat bervariasi tergantung ukuran dan kerumitan desain.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Grid Produk Stempel -->
<section class="container overflow-hidden py-5" id="product">
  <div class="row g-4" id="product-grid">
    <!-- Stempel Flash -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="100">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-flash.jpg" alt="Stempel Flash" onclick="openLightbox(this.src)">
          <span class="product-badge">Flash</span>
        </div>
        <div class="product-info">
          <h3>Stempel Flash / Pre-Inked</h3>
          <p>Stempel dengan tinta terintegrasi, siap pakai tanpa bantalan. Cocok untuk penggunaan intensif di kantor. Warna: hitam, biru, merah.</p>
          <div class="product-price">Mulai Rp 35.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Flash')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stempel Kayu -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="150">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-kayu.jpg" alt="Stempel Kayu" onclick="openLightbox(this.src)">
          <span class="product-badge">Kayu</span>
        </div>
        <div class="product-info">
          <h3>Stempel Kayu / Tradisional</h3>
          <p>Stempel dengan gagang kayu, ekonomis dan tahan lama. Membutuhkan bantalan tinta terpisah. Cocok untuk pemakaian ringan.</p>
          <div class="product-price">Mulai Rp 25.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Kayu')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stempel Warna -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="200">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-warna.jpg" alt="Stempel Warna" onclick="openLightbox(this.src)">
          <span class="product-badge">Warna</span>
        </div>
        <div class="product-info">
          <h3>Stempel Warna / Multiwarna</h3>
          <p>Bisa mencetak lebih dari satu warna sekaligus. Cocok untuk logo perusahaan dengan warna khas. Hasil tajam dan rapi.</p>
          <div class="product-price">Mulai Rp 45.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Warna')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stempel Tanggal -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="250">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-tanggal.jpg" alt="Stempel Tanggal" onclick="openLightbox(this.src)">
          <span class="product-badge">Tanggal</span>
        </div>
        <div class="product-info">
          <h3>Stempel Tanggal / Numbering</h3>
          <p>Dilengkapi roda tanggal atau angka yang bisa diputar. Cocok untuk stempel masuk/keluar, pembayaran, nomor urut.</p>
          <div class="product-price">Mulai Rp 50.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Tanggal')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stempel Pocket -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="300">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-pocket.jpg" alt="Stempel Pocket" onclick="openLightbox(this.src)">
          <span class="product-badge">Pocket</span>
        </div>
        <div class="product-info">
          <h3>Stempel Pocket / Saku</h3>
          <p>Ukuran kecil dan praktis, mudah dibawa. Dilengkapi penutup. Cocok untuk stempel pribadi atau keperluan di lapangan.</p>
          <div class="product-price">Mulai Rp 30.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Pocket')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stempel Emboss -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="350">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-emboss.jpg" alt="Stempel Emboss" onclick="openLightbox(this.src)">
          <span class="product-badge">Emboss</span>
        </div>
        <div class="product-info">
          <h3>Stempel Emboss / Timbul</h3>
          <p>Menghasilkan cetakan timbul tanpa tinta. Biasanya untuk stempel notaris, legalisasi, atau sertifikat. Kesan profesional.</p>
          <div class="product-price">Mulai Rp 75.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Emboss')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stempel Bening -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="400">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-bening.jpg" alt="Stempel Bening" onclick="openLightbox(this.src)">
          <span class="product-badge">Bening</span>
        </div>
        <div class="product-info">
          <h3>Stempel Clear / Bening</h3>
          <p>Bahan transparan memudahkan penempatan presisi. Cocok untuk mencetak di area sempit atau detail kecil. Hasil tajam.</p>
          <div class="product-price">Mulai Rp 40.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Bening')">Pesan via WA</a>
        </div>
      </div>
    </div>

    <!-- Stempel Custom Bentuk Khusus -->
    <div class="col-md-4 col-sm-6 product-item" data-aos="fade-up" data-aos-delay="450">
      <div class="product-card">
        <div class="product-image">
          <img src="/assets/stempel-custom.jpg" alt="Stempel Custom" onclick="openLightbox(this.src)">
          <span class="product-badge">Custom</span>
        </div>
        <div class="product-info">
          <h3>Stempel Custom Bentuk Khusus</h3>
          <p>Bisa dibuat sesuai keinginan: bentuk bulat, oval, bintang, karakter, dll. Cocok untuk merchandise, promosi, atau kebutuhan unik.</p>
          <div class="product-price">Mulai Rp 60.000</div>
          <a href="javascript:void(0)" class="btn-order" onclick="openOrderModal('Stempel Custom')">Pesan via WA</a>
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

<!-- Modal Order Steps -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Pesan <span id="modalProductName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="orderForm">
          <input type="hidden" id="productNameInput">
          <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="modalJumlah" value="1" min="1" step="1">
          </div>
          <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <div class="fw-bold fs-4 text-primary" id="modalTotalPrice">Rp 25.000</div>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn-modal-order" onclick="sendOrderViaWA()">Pesan via WhatsApp</button>
      </div>
    </div>
  </div>
</div>

<!-- CTA Stempel -->
<section class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center" data-aos="zoom-in" data-aos-duration="800">
      <div class="p-5" style="background: var(--primary-light); border-radius: 20px;">
        <h3 class="fw-bold mb-3">Butuh Stempel Custom?</h3>
        <p class="mb-4">Kirimkan desain Anda atau minta bantuan tim desain kami. Gratis konsultasi!</p>
        <a href="https://wa.me/6283171125657?text=Halo%20saya%20butuh%20bantuan%20desain%20stempel" class="btn-order" style="width: auto; padding: 12px 30px;" target="_blank">Konsultasi Gratis</a>
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
              <li>Pilih produk yang kamu mau di halaman ini (Stempel, dll).</li>
              <li> Klik tombol "Pesan" pada produk pilihanmu.</li>
              <li>Akan muncul form order yang sudah siap pakai:
               <ul>
                  <li>Isi jumlah sesuai kebutuhan.</li>
                  <li>Pilih opsi: "Ya, saya punya desain" atau "Tidak, tolong buatkan".</li>
                  <li>Total harga langsung terhitung otomatis!</li>
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

  // Modal functions
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

  // Harga default untuk setiap produk (bisa disesuaikan)
  const productPrices = {
    'Stempel Flash': 35000,
    'Stempel Kayu': 25000,
    'Stempel Warna': 45000,
    'Stempel Tanggal': 50000,
    'Stempel Pocket': 30000,
    'Stempel Emboss': 75000,
    'Stempel Bening': 40000,
    'Stempel Custom': 60000
  };

  window.openOrderModal = function(productName) {
    document.getElementById('modalProductName').innerText = productName;
    document.getElementById('productNameInput').value = productName;
    document.getElementById('modalJumlah').value = 1;
    document.querySelector('input[name="desainOption"][value="ya"]').checked = true;
    updateModalPrice();
    orderModal.show();
  };

  function updateModalPrice() {
    const productName = document.getElementById('productNameInput').value;
    const price = productPrices[productName] || 25000; // default 25000
    const jumlah = parseInt(document.getElementById('modalJumlah').value) || 1;
    const total = price * jumlah;
    document.getElementById('modalTotalPrice').innerText = 'Rp ' + total.toLocaleString('id-ID');
  }

  document.getElementById('modalJumlah').addEventListener('input', updateModalPrice);

  window.sendOrderViaWA = function() {
    const product = document.getElementById('productNameInput').value;
    const jumlah = document.getElementById('modalJumlah').value;
    const price = productPrices[product] || 25000;
    const total = (price * jumlah).toLocaleString('id-ID');
    const desain = document.querySelector('input[name="desainOption"]:checked').value;
    const desainText = desain === 'ya' 
      ? 'Ya, saya punya desain (file akan saya kirim manual)' 
      : 'Tidak, tolong buatkan desainnya';
    
    const message = `Halo, Toko Percetakan\n\n` +
                    `Saya mau pesan: ${product}\n` +
                    `Jumlah: ${jumlah} buah\n` +
                    `Total Harga: Rp ${total}\n` +
                    `Desain: ${desainText}\n\n` +
                    `Terima kasih.`;
    
    window.open('https://wa.me/6283171125657?text=' + encodeURIComponent(message), '_blank');
    orderModal.hide();
  };
</script>

</body>
</html>