@extends('admin.layout.app')

@section('title', 'Manajemen Produk')

@section('content')
@php $card = 'bg-white rounded-2xl border border-slate-200 shadow-sm'; @endphp

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
   <div class="flex flex-wrap items-center gap-3">
      <p class="text-sm text-slate-500">
         {{ $products->count() }} produk
      </p>
   
   {{-- Filter Kategori --}}
   <select id="filter-kategori"
   class="rounded-xl border border-slate-300 bg-white px-3 py-2 
      text-sm font-semibold text-slate-600 focus:border-brand 
      focus:outline-none">
      <option value="">Semua Kategori</option>
      @foreach ($products->pluck('category.name')
      ->unique()->sort() as $name)
         <option value="{{ $name }}">
            {{ $name }}
         </option>
      @endforeach
   </select>
   </div>
   
   <a href="{{ route('admin.products.create') }}"
   class="bg-gradient-to-r from-brand to-cmyk-c text-white px-5 py-2.5 rounded-xl text-sm font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">
   ＋ Tambah Produk
   </a>
</div>

<div class="{{ $card }} overflow-hidden p-4 lg:p-5">
 <table class="w-full text-sm js-datatable" id="products-table">
   <thead>
     <tr class="text-left text-xs uppercase tracking-wide text-slate-400 bg-slate-50">
       <th class="px-5 py-3 no-export">Gambar</th>
       <th class="px-5 py-3">Nama</th>
       <th class="px-5 py-3">Kategori</th>
       <th class="px-5 py-3">Harga</th>
       <th class="px-5 py-3">Badge</th>
       <th class="px-5 py-3">Status</th>
       <th class="px-5 py-3 text-right no-export">Aksi</th>
     </tr>
   </thead>
   <tbody class="divide-y divide-slate-100">
     @foreach ($products as $product)
       <tr class="hover:bg-slate-50">
         <td class="px-5 py-3">
           @if ($product->image_url)
             <img src="{{ $product->image_url }}" 
                class="w-12 h-12 rounded-xl object-cover"
                alt="{{ $product->name }}"
                onclick="openLightbox(this.src, this.alt)">
           @else
             <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center">📷</div>
           @endif
         </td>
         <td class="px-5 py-3 font-bold">{{ $product->name }}</td>
         <td class="px-5 py-3 text-slate-500">
            {{ $product->category->name }}
         </td>
         <td class="px-5 py-3 font-bold text-brand">{{ $product->formatPrice() }}<span class="text-slate-400 font-normal">{{ $product->price_unit ?? '' }}</span></td>
         <td class="px-5 py-3">
           @if ($product->badge)
             <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-600">{{ $product->badge }}</span>
           @else - @endif
         </td>
         <td class="px-5 py-3">
           <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $product->is_active ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
             {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
           </span>
         </td>
         <td class="px-5 py-3 text-right whitespace-nowrap">
           <a href="{{ route('admin.products.edit', $product) }}" class="font-bold text-brand hover:underline">Edit</a>
           <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline ml-3"
                 onsubmit="return confirm('Hapus produk ini?')">
             @csrf @method('DELETE')
             <button class="font-bold text-red-500 hover:underline">Hapus</button>
           </form>
         </td>
       </tr>
     @endforeach
   </tbody>
 </table>
</div>

<script>
  // Amankan karakter regex agar nama dengan ( ) . & tetap aman
  const escapeRegex = (s) => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

  document.addEventListener('change', function (e) {
    if (e.target.id !== 'filter-kategori') return;

    // Aman diambil saat event: user pasti beraksi SETELAH DataTables init
    const table = $('#products-table').DataTable();
    const val   = e.target.value;

    // Kolom 2 = Kategori. regex=true, smart=false,
    // jangkar ^...$ = cocok PERSIS (bukan kepotong substring)
    table.column(2).search(val ? '^' + escapeRegex(val) + '$' : '', true, false).draw();
  });
</script>
@endsection