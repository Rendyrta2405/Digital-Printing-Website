<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'Admin') · Digital Printing</title>
   <script src="https://cdn.tailwindcss.com"></script>
   <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap 5 JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js
"></script>
   <!-- Custom CSS -->
   <link rel="stylesheet" href="/css/style.css">
   <!-- font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-slate-100 min-h-screen">

   <aside class="fixed h-full w-60 bg-slate-900 text-white flex flex-col">
      <div class="p-5 text-lg font-bold border-b border-slate-700">
         🖨️ Admin Panel
      </div>

      <nav class="flex-1 p-4 space-y-1">
         <a href="{{ route('admin.dashboard') }}"
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">📊 Dashboard</a>
         <a href="{{ route('admin.categories.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.categories.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">📂 Kategori</a>
         <a href="{{ route('admin.products.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.products.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">📦 Produk</a>
         <a href="{{ route('admin.orders.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.orders.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">🧾 Order</a>
         <a href="{{ route('admin.galleries.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.galleries.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">🖼️ Galeri</a>
         <a href="{{ route('admin.facilities.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.facilities.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">🛠️ Fasilitas</a>
         <a href="{{ route('admin.partners.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.partners.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">🤝 Partner</a>
         <a href="{{ route('admin.testimonials.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.testimonials.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">💬 Testimoni</a>
         <a href="{{ route('admin.settings.index') }}" 
            class="block px-4 py-2 text-slate-500 {{ request()->routeIs('admin.settings.*') ? 'bg-slate-700 text-white font-bold rounded-lg' : 'text-slate-500 hover:bg-slate-800' }}">⚙️ Pengaturan</a>
      </nav>

      <form  method="POST" action="{{ route('logout') }}" class="p-4 border-t border-slate-700">
         @csrf
         <button class="w-full text-left px-4 py-2 rounded-lg hover:bg-red-600">
            🚪 Logout ({{ auth()->user()->name }})
         </button>
      </form>
   </aside>

   
   <main class="ml-60 p-8">
      @if (session('success'))
       <div class="mb-4 bg-emerald-100 text-emerald-700 px-4 py-3 rounded-lg text-sm">
           ✅ {{ session('success') }}
       </div>
      @endif

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      
      @yield('content')
   </main>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
  <span class="close" onclick="closeLightbox()">&times;</span>
  <span class="prev" onclick="prevImage()">&#10094;</span>
  <span class="next" onclick="nextImage()">&#10095;</span>
  <img id="lightbox-img" src="">
   <h4 class="text-xl text-white mt-2" id="description"></h4>
</div>

<script>
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
</script>
</body>
</html>