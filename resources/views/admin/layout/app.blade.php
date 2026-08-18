<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin') · {{ $site->site_name ?? 'Digital Printing' }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

   {{-- DataTables: core + buttons + responsive --}}
   <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css">
   
  <!-- Custom CSS --> 
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
   
   @vite(['resources/css/admin.css'])
</head>
<body class="bg-slate-100 min-h-screen font-sans text-ink">

{{-- Overlay mobile --}}
<div id="overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

{{-- ═══ SIDEBAR ═══ --}}
<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-40 w-64 bg-ink text-white flex flex-col
              -translate-x-full lg:translate-x-0 transition-transform duration-300">

  <div class="flex items-center gap-2 px-5 py-5 border-b border-white/10">
    <span class="flex gap-1">
      <i class="w-2.5 h-2.5 rounded-full bg-cmyk-c"></i>
      <i class="w-2.5 h-2.5 rounded-full bg-cmyk-m"></i>
      <i class="w-2.5 h-2.5 rounded-full bg-cmyk-y"></i>
      <i class="w-2.5 h-2.5 rounded-full bg-white"></i>
    </span>
    <div>
      <p class="font-extrabold leading-none">{{ $site->site_name ?? 'Toko Percetakan' }}</p>
      <p class="text-[11px] text-slate-400 mt-0.5">Admin Panel</p>
    </div>
  </div>

  <nav class="flex-1 overflow-y-auto p-4 space-y-1 text-sm font-semibold">
     @php
       $isActive = fn ($pattern) => request()->routeIs($pattern);
       $link = 'flex items-center gap-3 px-4 py-2.5 rounded-xl transition';
       $on   = 'bg-gradient-to-r from-brand to-cmyk-c text-white shadow-lg shadow-brand/30';
       $off  = 'text-slate-300 hover:bg-white/10';
     @endphp
   
     <a href="{{ route('admin.dashboard') }}"
        class="{{ $link }} {{ $isActive('admin.dashboard') ? $on : $off }}">📊 Dashboard</a>
   
     <a href="{{ route('admin.products.index') }}"
        class="{{ $link }} {{ $isActive('admin.products.*') ? $on : $off }}">📦 Produk</a>
   
     <a href="{{ route('admin.categories.index') }}"
        class="{{ $link }} {{ $isActive('admin.categories.*') ? $on : $off }}">🗂️ Kategori</a>
   
     <a href="{{ route('admin.orders.index') }}"
        class="{{ $link }} {{ $isActive('admin.orders.*') ? $on : $off }}">🧾 Order</a>
   
     <a href="{{ route('admin.galleries.index') }}"
        class="{{ $link }} {{ $isActive('admin.galleries.*') ? $on : $off }}">🖼️ Galeri</a>
   
     <a href="{{ route('admin.facilities.index') }}"
        class="{{ $link }} {{ $isActive('admin.facilities.*') ? $on : $off }}">🏭 Fasilitas</a>
   
     <a href="{{ route('admin.partners.index') }}"
        class="{{ $link }} {{ $isActive('admin.partners.*') ? $on : $off }}">🤝 Partners</a>
   
     <a href="{{ route('admin.testimonials.index') }}"
        class="{{ $link }} {{ $isActive('admin.testimonials.*') ? $on : $off }}">💬 Testimoni</a>
   
     <a href="{{ route('admin.settings.index') }}"
        class="{{ $link }} {{ $isActive('admin.settings.*') ? $on : $off }}">⚙️ Pengaturan</a>
   </nav>

  <div class="p-4 border-t border-white/10 space-y-1">
    <a href="{{ route('home') }}" target="_blank"
       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-300 hover:bg-white/10 text-sm font-semibold">
      🌐 Lihat Website
    </a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-red-300 hover:bg-red-500/20 text-sm font-semibold">
        🚪 Logout ({{ auth()->user()->name }})
      </button>
    </form>
  </div>
</aside>

{{-- ═══ KONTEN ═══ --}}
<div class="lg:pl-64">

  {{-- Topbar --}}
  <header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-slate-200">
    <div class="flex items-center justify-between px-4 lg:px-8 py-3.5">
      <div class="flex items-center gap-3">
        <button onclick="toggleSidebar()" class="lg:hidden w-10 h-10 rounded-xl border border-slate-300 flex items-center justify-center">
          ☰
        </button>
        <h1 class="font-extrabold text-lg">@yield('title', 'Dashboard')</h1>
      </div>
      <span class="hidden sm:inline-flex items-center gap-2 text-xs font-bold bg-slate-100 border border-slate-200 rounded-full px-3 py-1.5">
        🟢 {{ $site->site_name ?? 'Toko Percetakan' }} · Admin
      </span>
    </div>
  </header>

  <main class="p-4 lg:p-8">
    @if (session('success'))
      <div class="alert mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm font-semibold flex gap-3"
         role="alert">
        <span>✅ {{ session('success') }}</span>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
  </main>
</div>

{{-- ═══ Lightbox ═══ --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
  <button class="lightbox-close" type="button" aria-label="Tutup">&times;</button>
  <img id="lightboxImg" src="" alt="Preview">
  <p id="lightboxCaption"></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
    document.getElementById('overlay').classList.toggle('hidden');
  }

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
</script>

{{-- jQuery → DataTables core → Buttons(+html5+print) → JSZip & pdfmake → Responsive --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.10/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.10/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>

<script>
  if (window.jQuery && $.fn.DataTable) {
    var withButtons   = !!$.fn.dataTable.Buttons;
    var withResponsive = !!$.fn.dataTable.Responsive;

    $.extend(true, $.fn.dataTable.defaults, {
      pageLength: 10,
      responsive: withResponsive,
      // l = length, B = Buttons, f = search, i = info, p = paging
      dom: withButtons ? '<"dt-toolbar"lBf>rt<"dt-footer"ip>'
                       : '<"dt-toolbar"lf>rt<"dt-footer"ip>',
      columnDefs: [
        { orderable: false, targets: [0, -1] },        // gambar & aksi tak bisa disortir
        { responsivePriority: 1,    targets: 1 },      // kolom Nama bertahan paling akhir
        { responsivePriority: 9000, targets: [0, -1] },// gambar & aksi melipat lebih dulu
      ],
      buttons: withButtons ? [
        { extend: 'copy',  text: '📋 Salin', exportOptions: { columns: ':not(.no-export)' } },
        { extend: 'csv',   text: '📄 CSV',   exportOptions: { columns: ':not(.no-export)' } },
        { extend: 'excel', text: '📊 Excel', exportOptions: { columns: ':not(.no-export)' } },
        { extend: 'pdf',   text: '📁 PDF',   exportOptions: { columns: ':not(.no-export)' }, orientation: 'landscape' },
        { extend: 'print', text: '🖨 Print', exportOptions: { columns: ':not(.no-export)' } },
      ] : [],
      language: {
        search: 'Cari:',
         lengthMenu: 'Tampilkan _MENU_ baris',
         info: 'Menampilkan _START_–_END_ dari _TOTAL_ baris',
         infoEmpty: 'Tidak ada data, Menampilkan 0 baris', 
         infoFiltered: '(disaring dari _MAX_ baris)',
         zeroRecords: 'Tidak ditemukan hasil yang cocok', 
         emptyTable: 'Belum ada data',
         paginate: { first: '«', previous: '‹', next: '›', last: '»' },
      },
    });

    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('table.js-datatable').forEach(function (t) {
        $(t).DataTable();
      });
    });
  }
</script>
</body>
</html>