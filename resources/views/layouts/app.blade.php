<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Digital Printing - Cepat, Murah, Berkualitas')</title>
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
</head>
<body>

<!-- Floating WhatsApp -->
<a href="https://wa.me/6283171125657?text=Halo%20Toko%20Percetakan%2C%20saya%20tertarik%20dengan%20layanan%20cetak%20Anda.%20Boleh%20saya%20konsultasi%3F" class="floating-wa" target="_blank">
  <i class="bi bi-whatsapp"></i>
</a>

<!-- Scroll to Top Button -->
<div class="scroll-top" id="scrollTopBtn" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
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
      <a class="navbar-brand" href="/">@yield('brand', 'Digital Printing')</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('home') }}">Home</a>
          </li>

           @foreach($navbarCategories as $cat)
              <li class="nav-item">
                 <a href="{{ route('categories.show', $cat->slug) }}" class="nav-link">
                    {{ $cat->name }}
                 </a>
              </li>
           @endforeach
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
       <a href="https://wa.me/6283171125657?text=Halo%20Toko%20Percetakan%2C%20saya%20mau%20konsultasi%20cetak%20sekarang." class="btn-cta" target="_blank"><i class="bi bi-whatsapp"></i> Ya, Saya Mau Konsultasi</a>
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
                 <li>Klik tombol "Lihat Pilihan" pada produk pilihanmu untuk melihat berbagai jenis dan spesifikasinya.</li>
                 <li>Di halaman produk, pilih jenis yang kamu inginkan.</li>
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
         <div class="col-md-6" data-aos="fade-right">
           <iframe src="https://www.google.com/maps?q=-6.1827085,106.9467213&hl=id&z=15&output=embed" style="width:100%;height:400px;border:0;" allowfullscreen="" loading="lazy"></iframe>
         </div>
         <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
           <div class="contact-info p-5" id="contact">
             <h2 class="mb-4">Hubungi Kami</h2>
             <div class="row g-4">
               <div class="col-6">
                 <h5><i class="bi bi-whatsapp text-success"></i> Kontak</h5>
                 <p><a href="https://wa.me/6283171125657" target="_blank">WhatsApp: +62 831-7112-5657</a></p>
                 <p><a href="mailto:percetakan@example.com">Email: percetakan@example.com</a></p>
               </div>
               <div class="col-6">
                 <h5><i class="bi bi-clock"></i> Jam Buka</h5>
                 <p>Senin - Minggu</p>
                 <p>09.00 - 19.00 WIB</p>
               </div>
               <div class="col-6">
                 <h5><i class="bi bi-instagram text-danger"></i> Sosial Media</h5>
                 <div class="social-icons">
                   <a href="#" class="text-dark me-2"><i class="bi bi-instagram fs-3"></i></a>
                   <a href="#" class="text-dark me-2"><i class="bi bi-tiktok fs-3"></i></a>
                   <a href="#" class="text-dark"><i class="bi bi-facebook fs-3 text-primary"></i></a>
                 </div>
               </div>
               <div class="col-6">
                 <h5><i class="bi bi-geo-alt"></i> Lokasi</h5>
                 <p>Jl. Raya Kayu Tinggi No.87, Cakung, Jakarta Timur, 13910</p>
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
    <h4 class="text-white">Toko Percetakan</h4>
    <p>&copy; 2026 Toko Percetakan | Hak Cipta Dilindungi | All rights reserved.</p>
  </div>
</footer>

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
    if (window.scrollY > 50) {
      nav.classList.add('scrolled');
    } else {
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

// ===== MODAL FUNCTIONS (UPDATED) =====
const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
let currentProduct = '';
let currentProductType = '';

// Fungsi update harga (tetap sama)
function updateModalPrice() {
  const lebar = parseFloat(document.getElementById('modalLebar')?.value) || 0;
  const tinggi = parseFloat(document.getElementById('modalTinggi')?.value) || 0;
  const jumlah = parseInt(document.getElementById('modalJumlah')?.value) || 1;
  const total = lebar * tinggi * jumlah * 18000; // harga per m² banner
  const totalElement = document.getElementById('modalTotalPrice');
  if (totalElement) totalElement.innerText = 'Rp ' + total.toLocaleString('id-ID');
}

// Fungsi untuk membuka modal produk terlaris
window.openOrderModal = function(productName) {
  currentProduct = productName;
  currentProductType = 'terlaris';
  document.getElementById('modalProductName').innerText = productName;
  
  let modalContent = `
    <form id="orderForm">
      <input type="hidden" id="productNameInput" value="${productName}">
      <div class="mb-3">
        <label class="form-label">Lebar (m)</label>
        <input type="number" class="form-control" id="modalLebar" value="1" min="0.1" step="0.1">
      </div>
      <div class="mb-3">
        <label class="form-label">Tinggi (m)</label>
        <input type="number" class="form-control" id="modalTinggi" value="1" min="0.1" step="0.1">
      </div>
      <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="modalJumlah" value="1" min="1">
      </div>
      <div class="mb-3">
        <label class="form-label">Total Harga</label>
        <div class="fw-bold fs-4 text-primary" id="modalTotalPrice">Rp 18.000</div>
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
  
  // Pasang event listener untuk update harga
  const lebarInput = document.getElementById('modalLebar');
  const tinggiInput = document.getElementById('modalTinggi');
  const jumlahInput = document.getElementById('modalJumlah');
  if (lebarInput) lebarInput.addEventListener('input', updateModalPrice);
  if (tinggiInput) tinggiInput.addEventListener('input', updateModalPrice);
  if (jumlahInput) jumlahInput.addEventListener('input', updateModalPrice);
  updateModalPrice();
  orderModal.show();
};

// Fungsi untuk membuka modal custom
window.openCustomModal = function(productName, type) {
  currentProduct = productName;
  currentProductType = type;
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
        <label class="form-label">Catatan / Spesifikasi</label>
        <textarea class="form-control" id="customNotes" rows="3" placeholder="Jelaskan keinginan Anda..."></textarea>
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
  const product = document.getElementById('productNameInput')?.value || currentProduct;
  const desain = document.querySelector('input[name="desainOption"]:checked')?.value || 'ya';
  const desainText = desain === 'ya' 
    ? 'Ya, saya punya desain (file akan saya kirim manual)' 
    : 'Tidak, tolong buatkan desainnya';

  // Pesan untuk produk custom
  if (currentProductType === 'custom') {
    const jumlah = document.getElementById('modalJumlah')?.value || '1';
    const notes = document.getElementById('customNotes')?.value || '';
    let message = `Halo, Toko Percetakan\n\n` +
                  `Saya mau pesan: ${product}\n` +
                  `Jumlah: ${jumlah} buah\n`;
    if (notes) message += `Catatan: ${notes}\n`;
    message += `Desain: ${desainText}\n\n` +
               `Terima kasih.`;
    window.open('https://wa.me/6283171125657?text=' + encodeURIComponent(message), '_blank');
    orderModal.hide();
    return;
  }

  // Pesan untuk produk terlaris (banner)
  const lebar = document.getElementById('modalLebar')?.value || '1';
  const tinggi = document.getElementById('modalTinggi')?.value || '1';
  const jumlah = document.getElementById('modalJumlah')?.value || '1';
  const total = (parseFloat(lebar) * parseFloat(tinggi) * parseInt(jumlah) * 18000).toLocaleString('id-ID');
  const message = `Halo, Toko Percetakan\n\n` +
                  `Saya mau pesan: ${product}\n` +
                  `Lebar: ${lebar} meter\n` +
                  `Tinggi: ${tinggi} meter\n` +
                  `Jumlah: ${jumlah}\n` +
                  `Total Harga: Rp ${total}\n` +
                  `Desain: ${desainText}\n\n` +
                  `Terima kasih.`;
  window.open('https://wa.me/6283171125657?text=' + encodeURIComponent(message), '_blank');
  orderModal.hide();
};

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
</body>
</html>