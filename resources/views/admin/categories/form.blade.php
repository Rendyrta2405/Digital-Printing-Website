@extends('admin.layouts.app')

@section('title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
<h1 class="text-2xl font-bold text-slate-800 mb-6">
   {{ isset($category) ? '✏️ Edit Kategori' : '➕ Tambah Kategori' }}
</h1>

<form method="POST" 
   action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
   enctype="multipart/form-data"
   class="bg-white rounded-xl shadow p-6 max-w-2xl space-y-4">
   
   @csrf
   @if (isset($category))
      @method('PUT')
   @endif

   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kategori</label>
      <input type="text" name="name" id="" 
            class="w-full border border-slate-300 rounded-lg px-3 py-2" 
            value="{{ old('name', $category->name ?? '') }}"
            placeholder="Banner, Spanduk, Stiker, .." required>
   </div>

   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Judul Kategori</label>
      <input name="title" id="" required 
         class="w-full border border-slate-300 rounded-lg px-3 py-2" 
         placeholder="Cetak Banner Kilat, Jaminan Selesai.."
         value="{{ old('title', $category->title ?? '') }}">
   </div>
   
   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi singkat Kategori</label>
      <textarea name="description" id="" required rows="3"
         class="w-full border border-slate-300 rounded-lg px-3 py-2" 
         placeholder="Berbagai jenis stiker untuk kebutuhan branding, label produk, dekorasi, dan lainnya..">{{ old('description', $category->description ?? '') }}</textarea>
   </div>

   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Slogan (opsional)</label>
      <input type="text" name="slogan" id="" 
            class="w-full border border-slate-300 rounded-lg px-3 py-2" 
            value="{{ old('slogan', $category->slogan ?? '') }}"
            placeholder="Banner Kilat, 1 Jam jadi!">
   </div>
   
   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Teks Harga (opsional)</label>
      <input type="text" name="price_text" id="" 
            class="w-full border border-slate-300 rounded-lg px-3 py-2" 
            value="{{ old('price_text', $category->price_text ?? '') }}"
            placeholder="Cth: Mulai Rp 18.000/m*.">
   </div>

   <div>
      @if($category?->image)
         <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Sebelumnya</label>
         <img src="{{ asset('storage/' . $category->image) }}" 
            class="w-24 h-24 object-cover rounded mb-2"
            alt="{{ $category->name ?? 'Gambar sebelumnya' }}"
            onclick="openLightbox(this.src, this.alt)">
      @endif
      <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Kategori (opsional)</label>
      <input type="file" name="image" accept="image/*" 
         class="w-full text-sm text-slate-500 file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:font-semibold">
      <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti gambar. Maks 2 MB.</p>
      @error('image') 
         <p class="text-red-600 text-xs mt-1">{{ $message }}</p> 
      @enderror
   </div>

   <div class="flex gap-6">
      <label for="" class="flex items-center gap-2 text-sm">
         <input type="checkbox" name="show_in_navbar" id="" class="rounded"
            @checked(old('show_in_navbar', $category->show_in_navbar ?? false))>
         Tampilkan di Navbar
      </label>
      <label for="" class="flex items-center gap-2 text-sm">
         <input type="checkbox" name="is_active" id="" class="rounded"
            @checked(old('is_active', $product->is_active ?? true))>
         Aktif di website
      </label>
   </div>

   <div class="flex gap-3 pt-2">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg px-6 py-2">
         Simpan
     </button>
      <a href="{{ route('admin.categories.index') }}" class="text-slate-500 hover:underline self-center">
         Batal
     </a>
   </div>
</form>
@endsection