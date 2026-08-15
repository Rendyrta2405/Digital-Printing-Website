@extends('admin.layouts.app')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<h1 class="text-2xl font-bold text-slate-800 mb-6">
   {{ isset($product) ? '✏️ Edit Produk' : '➕ Tambah Produk' }}
</h1>

<form method="POST" 
   action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
   enctype="multipart/form-data"
   class="bg-white rounded-xl shadow p-6 max-w-2xl space-y-4">
   
   @csrf
   @if (isset($product))
      @method('PUT')
   @endif

   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Nama Produk</label>
      <input type="text" name="name" id="" 
            class="w-full border border-slate-300 rounded-lg px-3 py-2" 
            value="{{ old('name', $product->name ?? '') }}"
            placeholder="X-Banner Standing.." required>
   </div>
   
   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
      <select name="category_id" class="w-full border border-slate-300 rounded-lg px-3 py-2" required>
         @forelse($categories as $cat)
            <option value="{{ $cat->id }}"
               @selected(old('category_id', $product->category_id ?? '') == $cat->id)>
               {{ $cat->name }}
            </option>
         @empty
            <option value="" disabled>--Tambahkan Kategori terlebih dahulu--</option>
         @endforelse
      </select>

      @if($categories->isEmpty())
      <span class="text-sm text-red-600">
          Tambahkan Kategori terlebih dahulu sebelum menambahkan produk!
       </span>
      @endif
      @error('category_id')
         <p class="text-red-600 text-xs mt-1">{{ $message }}</p> 
      @enderror
   </div>

   <div class="grid grid-cols-2 gap-4">
      <div>
         <label class="block text-sm font-medium text-slate-700 mb-1">Harga (Rp)</label>
         <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" 
            class="w-full border border-slate-300 rounded-lg px-3 py-2"
            placeholder="Rp 0.00">
      </div>
      <div>
         <label class="block text-sm font-medium text-slate-700 mb-1">Satuan</label>
         <select name="price_unit" id=""
             class="w-full border border-slate-300 rounded-lg px-3 py-2">
            @forelse ($price_units as $p)
            <option value="{{ $p }}"
                @selected(old('price_unit', $product->price_unit ?? ''))>
               {{ $p }}
            </option>
            @empty
            <option value="" disabled selected>
               --Tidak ada satuan--
            </option>
            @endforelse
          </select>
      </div>
   </div>

   <div class="grid grid-cols-2 gap-4">
      <div>
         <label class="block text-sm font-medium text-slate-700 mb-1">Badge (opsional)</label>
         <input type="text" name="badge" id="" 
            class="w-full border border-slate-300 rounded-lg px-3 py-2" 
            value="{{ old('badge', $product->badge ?? '') }}"
            placeholder="HOT / NEW / PROMO (opsional)">
      </div>
      <div>
         <label class="block text-sm font-medium text-slate-700 mb-1">Tag (opsional)</label>
         <input type="text" name="tag" id="" 
            class="w-full border border-slate-300 rounded-lg px-3 py-2" 
            value="{{ old('tag', $product->tag ?? '') }}"
            placeholder="Promosi / Event / ... (opsional)">
      </div>
   </div>

   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
      <textarea name="description" id="" class="w-full border border-slate-300 rounded-lg px-3 py-2" placeholder="Cocok untuk toko, outlet, atau..">{{ old('description', $product->description ?? '') }}</textarea>
   </div>

   <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Gambar</label>
      @if($product?->image_url)
         <img src="{{ $product->image_url }}" class="w-24 h-24 object-cover rounded mb-2">
      @endif
      <input type="file" name="image" accept="image/*" 
         class="w-full text-sm text-slate-500 file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:font-semibold">
      <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti gambar. Maks 2 MB.</p>
      @error('image') 
         <p class="text-red-600 text-xs mt-1">{{ $message }}</p> 
      @enderror
   </div>

   <div class="flex gap-6">
      <label for="" class="flex items-center gap-2 text-sm">
         <input type="checkbox" name="is_featured" id="" class="rounded"
            @checked(old('is_featured', $product->is_featured ?? false))>
         ⭐ Tampilkan di carousel Terlaris
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
      <a href="{{ route('admin.products.index') }}" class="text-slate-500 hover:underline self-center">
         Batal
     </a>
   </div>
</form>
@endsection