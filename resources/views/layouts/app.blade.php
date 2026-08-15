<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', $site->site_name . ' - ' . $site->tagline )</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <!-- font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- Floating WhatsApp -->
<a href="https://wa.me/{{ $site['whatsapp_number'] }}?text=Halo%20{{ $site['site_name'] }}%2C%20saya%20tertarik%20dengan%20layanan%20cetak%20Anda.%20Boleh%20saya%20konsultasi%3F" class="floating-wa" target="_blank">
  <i class="bi bi-whatsapp"></i>
</a>

<!-- Scroll to Top Button -->
<div class="scroll-top" id="scrollTopBtn" 
   onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
  <i class="bi bi-arrow-up"></i>
</div>

<!-- Sticky CTA Bottom Bar -->
<div class="sticky-cta">
  <a href="#katalog" class="btn-cta-sticky btn-order-sticky" target="_blank">
    <i class="bi bi-whatsapp"></i>Pesan Sekarang
  </a>
  <a href="#harga-section" class="btn-cta-sticky btn-price-sticky">
    <i class="bi bi-tag"></i>Lihat Harga 
  </a>
</div>

<!-- Navbar -->
<header class="">
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">{{ $site->site_name }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : ''}}" 
               href="{{ route('home') }}">Home</a>
          </li>

           @foreach($navbarCategories as $cat)
              <li class="nav-item">
                 <a href="{{ route('categories.show', $cat->slug) }}" 
                    class="nav-link 
                    {{ request()->routeIs('categories.show') && request()->route('slug') == $cat->slug ? 'active' : '' }}">
                    {{ $cat->name }}
                 </a>
              </li>
           @endforeach

           <li class="nav-item">
            <a class="nav-link
               {{ request()->routeIs('orders.track') ? 'active' : '' }}" 
               href="{{ route('orders.track') }}">Lacak Pesanan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main>
   @yield('content')
   
   <!-- CTA Utama -->
   <section class="cta overflow-hidden">
     <div class="container">
       <h2>Siap Mencetak Kebutuhan Bisnis Anda?</h2>
       <p class="fs-4 mb-5">Konsultasi gratis via WhatsApp. Kami bantu dari desain hingga jadi!</p>
       <a href="https://wa.me/{{ $site->whatsapp_number }}?text=Halo%20{{ $site->site_name }}%2C%20saya%20mau%20konsultasi%20cetak%20sekarang." class="btn-cta" target="_blank"><i class="bi bi-whatsapp"></i> Ya, Saya Mau Konsultasi</a>
     </div>
   </section>
   
   <!-- FAQ -->
   <section class="faq py-5 overflow-hidden" id="faq">
     <div class="container">
       <h2 class="section-title">Pertanyaan <span>Umum</span></h2>
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
                 <li>Pilih produk yang kamu mau di halaman ini (Banner, Stiker, Buku, dll).</li>
                 <li>Klik tombol "Lihat Kategori" pada produk pilihanmu untuk melihat berbagai jenis dan spesifikasinya.</li>
                 <li>Di halaman kategori, pilih jenis yang kamu inginkan.</li>
                 <li>Isi form order yang muncul dengan detail pesanan.</li>
                 <li>Pilih opsi: "Ya, saya punya desain" atau "Tidak, tolong buatkan".</li>
                 <li>Total harga langsung terhitung otomatis!</li>
                 <li>Klik "Pesan via WhatsApp" → otomatis terhubung ke admin kami dengan pesan yang sudah berisi detail pesananmu.</li>
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
   
   <!-- Location & Contact -->
   <section class="location-contact overflow-hidden">
     <div class="container-fluid p-0 ">
       <div class="row g-0 ">
          @if ($site->mapsUrl())
            <div class="col-md-6" data-aos="fade-right">
              <iframe src="{{ $site->mapsUrl() }}" 
                 width="100%"
                 height="350px"
                 style="border:0;" 
                 allowfullscreen="" 
                 loading="lazy"
                 title="Lokasi {{ $site->site_name }}">
              </iframe>
            </div>
          @endif
         <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
           <div class="contact-info p-5" id="contact">
             <h2 class="mb-4">Hubungi Kami</h2>
             <div class="row g-4">
               <div class="col-6">
                 <h5><i class="bi bi-whatsapp text-success"></i> Kontak</h5>
                 <p><a href="https://wa.me/{{ $site['whatsapp_number'] }}" target="_blank">WhatsApp: +{{ $site->whatsapp_number }}</a></p>
                 <p><a href="mailto:percetakan@example.com">Email: {{ $site->email }}</a></p>
               </div>
               <div class="col-6">
                 <h5><i class="bi bi-clock"></i> Jam Buka</h5>
                 <p>{{ $site->opening_hours }}</p>
               </div>
               <div class="col-6">
                 <h5>
                    <i class="fas fa-share-nodes text-primary"></i> 
                    Sosial Media
                 </h5>
                 <div class="social-icons">
                    @foreach (array_keys(\App\Models\Setting::SOCIAL_PLATFORMS) 
                    as $platform)
                       @if ($site->socialUrl($platform))
                         <a href="{{ $site->socialUrl($platform) }}" 
                            class="text-dark me-2 text-decoration-none"
                            target="_blank">
                            <i class="bi bi-{{ $platform }} fs-3"></i>
                         </a>
                       @endif
                    @endforeach
                 </div>
               </div>
               <div class="col-6">
                 <h5><i class="bi bi-geo-alt"></i> Lokasi</h5>
                 <p>{{ $site->address }}</p>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>
</main>
   
<!-- Footer -->
<footer class="text-center overflow-hidden">
  <div class="container">
    <h4 class="text-white">{{ $site['site_name'] }}</h4>
    <p>&copy; {{ date('Y') }} {{ $site['site_name'] }} | Hak Cipta Dilindungi | All rights reserved.</p>
  </div>
</footer>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
  <span class="close" onclick="closeLightbox()">&times;</span>
  <span class="prev" onclick="prevImage()">&#10094;</span>
  <span class="next" onclick="nextImage()">&#10095;</span>
  <img id="lightbox-img" src="">
  <h4 class="text-xl text-white mt-2" id="description"></h4>
</div>

{{-- ═══ MODAL ORDER (satu untuk semua produk) ═══ --}}
@foreach ($products as $p)
<div class="modal fade" id="orderModal" tabindex="-1">
   <div class="modal-dialog">
      <form method="POST" action="{{ route('orders.store') }}" class="modal-content">
         @csrf
         <input type="hidden" name="product_id" id="modalProductId">

         <div class="modal-header">
            <h5 class="modal-title">
               Pesan: <span id="modalProductName"></span>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>

         <div class="modal-body">
            <div class="mb-3" id="sizeFields" style="display: none">
               <label for="" class="form-label">Lebar (m)</label>
               <input type="number" name="width" step="0.1" id="modalWidth" 
                  class="form-control mb-3" placeholder="Min: 0,1 meter"
                  value="{{ old('width') }}" min="0.1" max="100">
               <label for="" class="form-label mt-2">Tinggi (m)</label>
               <input type="number" name="height" step="0.1" id="modalHeight" 
                  class="form-control" placeholder="Min: 0,1 meter"
                  value="{{ old('height') }}" min="0.1" max="100">
            </div>

            <div class="mb-3">
               <label class="form-label">Nama</label>
               <input type="text" name="customer_name" pattern="[a-zA-Z\s]{3,100}"
                  class="form-control" placeholder="Cth: Budi Santoso" required
                  value="{{ old('customer_name') }}">
            </div>
            
            <div class="mb-3">
               <label class="form-label">No. WhatsApp</label>
               <input type="tel" name="customer_phone" 
                  class="form-control" 
                  placeholder="08xxxxxxxxxx" required 
                  pattern="(08|\+628)[0-9]{8,13}"
                  value="{{ old('customer_phone') }}">
            </div>

            <div class="mb-3">
               <label for="" class="form-label">Jumlah</label>
               <input type="number" name="quantity" value="1" min="1" 
                  id="modalQty" class="form-control" max="10000"
                  placeholder="Jumlah minimal: 1" required
                  value="{{ old('quantity') }}">
            </div>

            <div class="mb-3">
               <label for="" class="form-label">Sudah punya desain?</label>
               <select name="design_option" id="" class="form-select">
                  <option value="punya"
                     @selected(old('design_option'))>Ya, saya punya desain</option>
                  <option value="buatkan"
                     @selected(old('design_option'))>Tidak, tolong buatkan</option>
               </select>
            </div>
   
            <div class="mb-3">
               <label for="" class="form-label">Catatan (opsional)</label>
               <textarea name="notes" id="" class="form-control" placeholder="Tambahkan catatan untuk pesanan ini.."></textarea>
            </div>
   
            <div class="alert alert-info mb-0">
               Estimasi Total: <strong id="modalTotal">-</strong>
            </div>
         </div>
         
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">
               Pesan via WhatsApp
            </button>
         </div>
      </form>
   </div>
</div>
@endforeach
   
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  // Inisialisasi AOS
  AOS.init({
    duration: 800,
    once: false,
    mirror: true
  });

  // Navbar scroll effect
  window.addEventListener('scroll', function() {
    const nav = document.getElementById('mainNav');
    const btn = document.getElementById('scrollTopBtn');
    
     if (window.scrollY > 50) {
       // Scroll To Top
      btn.classList.add('show');
      nav.classList.add('scrolled');
    } else {
      btn.classList.remove('show');
      nav.classList.remove('scrolled');
    }

  });
   
  // ===== ANIMASI ANGKA OTOMATIS SAAT LOAD =====
  document.addEventListener('DOMContentLoaded', function() {
    // Jalankan animasi segera setelah DOM siap
    setTimeout(startAllCounters, 300); // Delay 300ms setelah load
  });

  function startAllCounters() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
      const target = parseInt(counter.getAttribute('data-target'));
      const startValue = Math.floor(target * 0.1); // Mulai dari 90% dari target
      let currentValue = startValue;
      
      counter.innerText = currentValue + '+';
      
      const increment = Math.ceil((target - startValue) / 30); // Cepat selesai dalam 30 step
      
      const updateCounter = setInterval(() => {
        currentValue += increment;
        
        if (currentValue >= target) {
          counter.innerText = target + '+';
          clearInterval(updateCounter);
        } else {
          counter.innerText = currentValue + '+';
        }
      }, 200); // Update setiap 30ms untuk animasi cepat
    });
  }

  // Counter animasi untuk scroll (opsional, jika ingin tetap ada efek saat scroll)
  const counters = document.querySelectorAll('.counter');
  const speed = 200;

  const startCounter = (counter) => {
    const updateCount = () => {
      const target = +counter.getAttribute('data-target');
      const count = +counter.innerText.replace('+', '');
      const inc = target / speed;

      if (count < target) {
        counter.innerText = Math.ceil(count + inc) + '+';
        setTimeout(updateCount, 1);
      } else {
        counter.innerText = target + '+';
      }
    };
    updateCount();
  };

  // Trigger counter saat elemen masuk viewport (tetap dipertahankan)
  const observerOptions = { threshold: 0.5 };
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  counters.forEach(counter => observer.observe(counter));

  // Smooth scroll untuk link
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  // Lightbox variables
  let currentImageIndex = 0;
  const images = [];

  // Collect all product images (only those with openLightbox calls)
  document.querySelectorAll('[onclick*="openLightbox"]').forEach(el => {
    const src = el.tagName === 'IMG' ? el.src : el.querySelector('img')?.src;
    if (src && !images.includes(src)) images.push(src);
  });

  // Lightbox functions
  window.openLightbox = function(src, description) {
    currentImageIndex = images.indexOf(src);
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.add('show');
    document.body.style.overflow = 'hidden';
    document.getElementById('description').textContent = description;
  };

  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('show');
    document.body.style.overflow = '';
  }

  function prevImage() {
    if (images.length === 0) return;
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    document.getElementById('lightbox-img').src = images[currentImageIndex];
  }

  function nextImage() {
    if (images.length === 0) return;
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

// Event listener untuk menyembunyikan sticky CTA dan floating WA saat modal terbuka di mobile
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
</script>

<script>
    const modal = document.getElementById('orderModal');
    const modalWidth = document.getElementById('modalWidth');
    const modalHeight = document.getElementById('modalHeight');
    let price = 0, unit = '';

    // Saat modal dibuka: isi konteks dari tombol yang diklik
    modal.addEventListener('show.bs.modal', (event) => {
        const btn = event.relatedTarget;
        price = parseInt(btn.dataset.price) || 0;
        unit = btn.dataset.unit || '';

        if (unit === '/m²') {
           modalWidth.required = true;
           modalHeight.required = true;
        } else {
           modalWidth.required = false;
           modalHeight.required = false;
        }

        document.getElementById('modalProductId').value = btn.dataset.productId;
        document.getElementById('modalProductName').textContent = btn.dataset.name;
        document.getElementById('sizeFields').style.display = (unit === '/m²') ? '' : 'none';
        hitungPreview();
    });

    // Preview total live (PHP tidak bisa bereaksi saat mengetik)
    function hitungPreview() {
        const qty = parseInt(document.getElementById('modalQty').value) || 1;
        const w = parseFloat(modalWidth.value) || 0;
        const h = parseFloat(modalHeight.value) || 0;
        const el = document.getElementById('modalTotal');

        if (price === 0) {
           el.textContent = 'Konsultasikan Harga'; 
           return; 
        }

        const total = (unit === '/m²')
            ? Math.round(w * h * price) * qty
            : price * qty;

        el.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    ['modalQty', 'modalWidth', 'modalHeight'].forEach((id) => {
        document.getElementById(id).addEventListener('input', hitungPreview);
    });
</script>
</body>
</html>