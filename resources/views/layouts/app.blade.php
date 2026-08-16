<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', $site->site_name . ' - ' . $site->tagline)</title>

  <!-- Fonts: Plus Jakarta Sans (karya Indonesia 🇮🇩) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap 5 + Icons + Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Tema CMYK Studio -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
</head>
<body>

{{-- Floating WhatsApp --}}
<a href="https://wa.me/{{ $site->whatsapp_number }}?text=Halo%20{{ urlencode($site->site_name) }}%2C%20saya%20tertarik%20dengan%20layanan%20cetak%20Anda.%20Boleh%20saya%20konsultasi%3F"
   class="floating-wa" target="_blank" aria-label="Chat WhatsApp">
  <i class="bi bi-whatsapp"></i>
</a>

{{-- Scroll to Top --}}
<div class="scroll-top" id="scrollTopBtn" onclick="window.scrollTo({top:0, behavior:'smooth'})">
  <i class="bi bi-arrow-up text-bold"></i>
</div>

{{-- Sticky CTA (mobile) --}}
<div class="sticky-cta">
  <a href="https://wa.me/{{ $site->whatsapp_number }}" class="btn-cta-sticky btn-order-sticky" target="_blank">
    <i class="bi bi-whatsapp"></i> Pesan Sekarang
  </a>
  <a href="{{ route('home') }}#harga-section" class="btn-cta-sticky btn-price-sticky">
    <i class="bi bi-tag"></i> Lihat Harga
  </a>
</div>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg sticky-top py-2" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <span class="brand-dots"><i></i><i></i><i></i><i></i></span>
      {{ $site->site_name }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>

        {{-- Semua kategori rapi di dalam dropdown --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle 
             {{ request()->routeIs('categories.show') ? 'active' : '' }}"
             href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Produk
          </a>
          <ul class="dropdown-menu dropdown-menu-cmyk">
            @foreach($navbarCategories as $cat)
              <li>
                <a class="dropdown-item {{ request()->route('slug') == $cat->slug ? 'active' : '' }}"
                   href="{{ route('categories.show', $cat->slug) }}">
                  {{ $cat->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}#harga-section">Harga</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('orders.track') ? 'active' : '' }}" href="{{ route('orders.track') }}">
            <i class="bi bi-box-seam me-1"></i>Lacak Pesanan
          </a>
        </li>
        <li class="nav-item ms-lg-2 mt-3 mt-lg-0">
          <a class="btn btn-wa btn-nav" href="https://wa.me/{{ $site->whatsapp_number }}" target="_blank">
            <i class="bi bi-whatsapp"></i> Pesan Sekarang
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>
   @if (session('success'))
     <div class="container mt-3">
       <div class="alert alert-success shadow-sm">✅ {{ session('success') }}</div>
     </div>
   @elseif ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h6 class="alert-heading mb-3 text-sm">
           <i class="fa-solid fa-triangle-exclamation"></i> Terjadi Kesalahan!
        </h6>
        <ul class="mb-0 ps-3 font-bold">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
   @endif
  @yield('content')

  {{-- ═══ CTA Utama ═══ --}}
  <section class="cta overflow-hidden">
    <div class="container position-relative">
      <h2 class="fw-extrabold">Siap Mencetak Kebutuhan Bisnis Anda?</h2>
      <p class="fs-4 mb-5">Konsultasi gratis via WhatsApp. Kami bantu dari desain hingga jadi!</p>
      <a href="https://wa.me/{{ $site->whatsapp_number }}?text=Halo%20{{ urlencode($site->site_name) }}%2C%20saya%20mau%20konsultasi%20cetak%20sekarang."
         class="btn-cta" target="_blank">
        <i class="bi bi-whatsapp"></i> Ya, Saya Mau Konsultasi
      </a>
    </div>
  </section>

  {{-- ═══ FAQ ═══ --}}
  <section class="faq py-5 overflow-hidden" id="faq">
    <div class="container">
      <h2 class="section-title">Pertanyaan <span>Umum</span></h2>
      <div class="accordion" id="accordionFaq">
        <div class="accordion-item" data-aos="fade-up">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
              🎯 Cara Order Super Cepat
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFaq">
            <div class="accordion-body">
              <ol class="mb-2">
                <li>Pilih produk yang kamu mau (Banner, Stiker, Buku, dll).</li>
                <li>Klik tombol "Lihat Kategori" untuk melihat jenis & spesifikasinya.</li>
                <li>Pilih jenis yang kamu inginkan, isi form order.</li>
                <li>Pilih opsi: "Ya, saya punya desain" atau "Tidak, tolong buatkan".</li>
                <li>Total harga langsung terhitung otomatis!</li>
                <li>Klik "Pesan via WhatsApp" → pesan sudah berisi detail pesananmu. Simpel, kan?</li>
              </ol>
              <p class="mb-0">🔄 Gratis konsultasi, respon cepat, dan siap bantu dari desain hingga jadi!</p>
            </div>
          </div>
        </div>
        <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
              ⏱️ Estimasi Waktu Pengerjaan
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
            <div class="accordion-body">
              <ul class="mb-2">
                <li>Banner & Spanduk: 1–2 jam (bisa lebih cepat jika urgent)</li>
                <li>Stiker: 1–2 hari · Kartu Nama: 1–2 hari · Stempel: 1–2 hari</li>
                <li>Undangan: 2–3 hari · Buku: 2–5 hari</li>
                <li>Produk custom: konsultasikan — kami selalu berusaha memenuhi deadline Anda!</li>
              </ul>
              <p class="mb-0">⚠️ Waktu dapat bervariasi tergantung antrian & kompleksitas.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
              Apakah bisa desain sendiri?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
            <div class="accordion-body">
              Tentu! Kirim file desain (PDF, CDR, AI, JPG resolusi tinggi). Belum punya desain?
              Tim kami siap membantu membuatkannya dengan biaya terjangkau.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══ Lokasi & Kontak ═══ --}}
  <section class="location-contact overflow-hidden" id="contact">
    <div class="container-fluid p-0">
      <div class="row g-0">
        @if ($site->mapsUrl())
          <div class="col-md-6" data-aos="fade-right">
            <iframe src="{{ $site->mapsUrl() }}" loading="lazy" allowfullscreen title="Lokasi {{ $site->site_name }}"></iframe>
          </div>
        @endif
        <div class="col-md-6" data-aos="fade-left">
          <div class="contact-info p-5">
            <h2 class="mb-4">Hubungi Kami</h2>
            <div class="row g-4">
              <div class="col-6">
                <h5><i class="bi bi-whatsapp text-success me-1"></i> Kontak</h5>
                <p class="mb-1"><a href="https://wa.me/{{ $site->whatsapp_number }}" target="_blank">WhatsApp: +{{ $site->whatsapp_number }}</a></p>
                <p class="mb-0"><a href="mailto:{{ $site->email }}">Email: {{ $site->email }}</a></p>
              </div>
              <div class="col-6">
                <h5><i class="bi bi-clock me-1"></i> Jam Buka</h5>
                <p class="mb-0">{{ $site->opening_hours }}</p>
              </div>
              <div class="col-6">
                <h5><i class="fas fa-share-nodes me-1" style="color:var(--magenta)"></i> Sosial Media</h5>
                <div class="social-icons d-flex gap-2 flex-wrap">
                  @foreach (array_keys(\App\Models\Setting::SOCIAL_PLATFORMS) as $platform)
                    @if ($site->socialUrl($platform))
                      <a href="{{ $site->socialUrl($platform) }}" target="_blank" aria-label="{{ $platform }}">
                        <i class="bi bi-{{ $platform }}"></i>
                      </a>
                    @endif
                  @endforeach
                </div>
              </div>
              <div class="col-6">
                <h5><i class="bi bi-geo-alt me-1"></i> Lokasi</h5>
                <p class="mb-0">{{ $site->address }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

{{-- ═══ Footer ═══ --}}
<footer class="footer pb-5 mb-5">
  <div class="container">
    <div class="row g-4 py-4">
      <div class="col-lg-4">
        <a class="navbar-brand mb-2" href="{{ route('home') }}" style="color:#fff">
          <span class="brand-dots"><i></i><i></i><i></i><i></i></span> {{ $site->site_name }}
        </a>
        <p class="mb-3">{{ $site->tagline }}</p>
        <div class="social-icons d-flex gap-2">
          @foreach (array_keys(\App\Models\Setting::SOCIAL_PLATFORMS) as $platform)
            @if ($site->socialUrl($platform))
              <a href="{{ $site->socialUrl($platform) }}" target="_blank"
                 class="text-center">
                 <i class="bi bi-{{ $platform }}"></i>
              </a>
            @endif
          @endforeach
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <h6>Produk</h6>
        @foreach($navbarCategories as $cat)
          <a href="{{ route('categories.show', $cat->slug) }}">{{ $cat->name }}</a>
        @endforeach
      </div>
      <div class="col-6 col-lg-3">
        <h6>Navigasi</h6>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('home') }}#harga-section">Daftar Harga</a>
        <a href="{{ route('home') }}#katalog">Katalog</a>
        <a href="{{ route('orders.track') }}">Lacak Pesanan</a>
        <a href="{{ route('home') }}#faq">Cara Order</a>
      </div>
      <div class="col-lg-3">
        <h6>Kontak</h6>
        <p class="mb-1"><i class="bi bi-geo-alt me-1"></i>{{ $site->address }}</p>
        <p class="mb-1"><i class="bi bi-whatsapp me-1"></i>+{{ $site->whatsapp_number }}</p>
        <p class="mb-0"><i class="bi bi-clock me-1"></i>{{ $site->opening_hours }}</p>
      </div>
    </div>
    <div class="footer-bottom">
      © {{ date('Y') }} {{ $site->site_name }} | Hak Cipta Dilindungi
    </div>
  </div>
</footer>

{{-- ═══ MODAL ORDER — CUKUP SATU (bug lama: duplikat dalam loop) ═══ --}}
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="{{ route('orders.store') }}" class="modal-content">
      @csrf
      <input type="hidden" name="product_id" id="modalProductId">

      <div class="modal-header">
        <h5 class="modal-title">Pesan: <span id="modalProductName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3" id="sizeFields" style="display:none">
          <label class="form-label">Lebar (m)</label>
          <input type="number" name="width" step="0.1" 
             id="modalWidth" class="form-control mb-3"
             placeholder="Min: 0,1 meter" 
             value="{{ old('width') }}" min="0.1" max="100">
          <label class="form-label">Tinggi (m)</label>
          <input type="number" name="height" step="0.1" id="modalHeight" 
             class="form-control" placeholder="Min: 0,1 meter" 
             value="{{ old('height') }}" min="0.1" max="100">
        </div>

        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" 
             name="customer_name" class="form-control" 
             placeholder="Cth: Budi Santoso"
             pattern="[a-zA-Z\s]{3,100}"
             value="{{ old('customer_name') }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">No. WhatsApp</label>
          <input type="tel" name="customer_phone" class="form-control" 
             placeholder="08xxxxxxxxxx" pattern="(08|\+628)[0-9]{8,13}"
             value="{{ old('customer_phone') }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="quantity" id="modalQty" 
             class="form-control" min="1" max="10000"
             value="{{ old('quantity', 1) }}" required
             placeholder="Jumlah pembelian minimal: 1">
        </div>

        <div class="mb-3">
          <label class="form-label">Sudah punya desain?</label>
          <select name="design_option" class="form-select">
            <option value="punya" @selected(old('design_option', 'punya') === 'punya')>Ya, saya punya desain</option>
            <option value="buatkan" @selected(old('design_option') === 'buatkan')>Tidak, tolong buatkan</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Catatan (opsional)</label>
          <textarea name="notes" class="form-control" placeholder="Tambahkan catatan untuk pesanan ini..">{{ old('notes') }}</textarea>
        </div>

        <div class="alert alert-info mb-0">
          Estimasi Total: <strong id="modalTotal">-</strong>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-wa"><i class="bi bi-whatsapp me-1"></i> Pesan via WhatsApp</button>
      </div>
    </form>
  </div>
</div>

{{-- ═══ Lightbox ═══ --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
  <button class="lightbox-close" type="button" aria-label="Tutup">&times;</button>
  <img id="lightboxImg" src="" alt="Preview">
  <p id="lightboxCaption"></p>
</div>

{{-- ═══ Scripts ═══ --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ once: true, duration: 700 });

  // Scroll-top muncul setelah scroll
  window.addEventListener('scroll', () => {
    document.getElementById('scrollTopBtn').classList.toggle('show', window.scrollY > 400);
  });

  // Lightbox
  function openLightbox(src, caption) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxCaption').textContent = caption || '';
    document.getElementById('lightbox').classList.add('show');
    document.body.style.overflow = 'hidden';
  }
  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('show');
    document.body.style.overflow = '';
  }

  // Isi konteks modal order dari tombol yang diklik
  const orderModal = document.getElementById('orderModal');
  let modalPrice = 0, modalUnit = '';
  const modalWidth = document.getElementById('modalWidth');
  const modalHeight = document.getElementById('modalHeight');

  orderModal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    modalPrice = parseInt(btn.dataset.price) || 0;
    modalUnit  = btn.dataset.unit || '';

    if (modalUnit === '/m²') {
       modalWidth.required = true;
       modalHeight.required = true;
    } else {
       modalWidth.required = false;
       modalHeight.required = false;
    }

    document.getElementById('modalProductId').value   = btn.dataset.productId;
    document.getElementById('modalProductName').textContent = btn.dataset.name;
    document.getElementById('sizeFields').style.display = (modalUnit === '/m²') ? '' : 'none';
    hitungPreview();
  });

  function hitungPreview() {
    const qty = parseInt(document.getElementById('modalQty').value) || 1;
    const w   = parseFloat(modalWidth.value) || 0;
    const h   = parseFloat(modalHeight.value) || 0;
    const el  = document.getElementById('modalTotal');

    if (modalPrice === 0) { el.textContent = 'Konsultasi'; return; }

    const total = (modalUnit === '/m²') ? Math.round(w * h * modalPrice) * qty : modalPrice * qty;
    el.textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  ['modalQty', 'modalWidth', 'modalHeight'].forEach(id => {
    document.getElementById(id).addEventListener('input', hitungPreview);
  });
</script>
</body>
</html>