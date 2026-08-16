@extends('admin.layout.app')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
@php
  $card  = 'bg-white rounded-2xl border border-slate-200 shadow-sm';
  $label = 'block text-sm font-bold text-slate-700 mb-1.5';
  $input = 'w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20';
@endphp

<div class="flex items-center gap-3 mb-6">
  <a href="{{ route('admin.products.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-300 flex items-center justify-center hover:bg-slate-50">←</a>
  <h2 class="font-extrabold text-lg">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</h2>
</div>

<form method="POST"
      action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
      enctype="multipart/form-data"
      class="{{ $card }} p-5 lg:p-7 max-w-3xl">
  @csrf
  @if (isset($product)) @method('PUT') @endif

  <div class="grid lg:grid-cols-2 gap-5">
    <div class="lg:col-span-2">
      <label class="{{ $label }}">Kategori</label>
      <select name="category_id" class="{{ $input }}" required>
        @foreach ($categories as $cat)
          <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
      </select>
      @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="lg:col-span-2">
      <label class="{{ $label }}">Nama Produk</label>
      <input type="text" name="name" placeholder="X-Banner Standing.." 
         value="{{ old('name', $product->name ?? '') }}" 
         class="{{ $input }}" required>
      @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="{{ $label }}">Harga (Rp)</label>
      <input type="number" name="price" placeholder="Boleh dikosongkan jika harga produk ini tidak menentu"
         value="{{ old('price', $product->price ?? '') }}" class="{{ $input }}">
    </div>

    <div>
      <label class="{{ $label }}">Satuan</label>
      <select name="price_unit" class="{{ $input }}">
        <option value="">Tanpa satuan</option>
        @foreach (['/m²', '/pcs', '/box', '/lembar', '/eks', '/set', '/cm', '/cm²'] as $unit)
          <option value="{{ $unit }}" @selected(old('price_unit', $product->price_unit ?? '') === $unit)>{{ $unit }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="{{ $label }}">Badge (opsional)</label>
      <input type="text" name="badge" 
         placeholder="HOT / NEW / PROMO / (opsional)" 
         value="{{ old('badge', $product->badge ?? '') }}" class="{{ $input }}">
    </div>

    <div>
      <label class="{{ $label }}">Tag Filter (opsional)</label>
      <input type="text" name="tag" 
         placeholder="Promosi / Event / ... (opsional)" 
         value="{{ old('tag', $product->tag ?? '') }}" class="{{ $input }}">
    </div>

    <div class="lg:col-span-2">
      <label class="{{ $label }}">Deskripsi</label>
      <textarea name="description" rows="3" class="{{ $input }}"
         placeholder="Cocok untuk toko, outlet, atau acara promosi outdoor ..">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="lg:col-span-2">
      <label class="{{ $label }}">Gambar</label>
      @if ($product?->image_url)
        <img src="{{ $product->image_url }}" class="w-24 h-24 rounded-xl object-cover mb-2">
      @endif
      <input type="file" name="image" accept="image/*" class="{{ $input }} file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-blue-50 file:text-brand file:font-bold">
      <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti. Maks 2 MB.</p>
      @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <label class="flex items-center gap-3 text-sm font-semibold">
      <input type="checkbox" name="is_featured" class="w-5 h-5 rounded accent-blue-600"
             @checked(old('is_featured', $product->is_featured ?? false))>
      ⭐ Tampilkan di carousel Terlaris
    </label>
    <label class="flex items-center gap-3 text-sm font-semibold">
      <input type="checkbox" name="is_active" class="w-5 h-5 rounded accent-emerald-600"
             @checked(old('is_active', $product->is_active ?? true))>
      ✅ Aktif di website
    </label>
  </div>

  <div class="flex gap-3 mt-7">
    <button class="bg-gradient-to-r from-brand to-cmyk-c text-white px-7 py-2.5 rounded-xl font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">
      Simpan
    </button>
    <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl font-bold text-slate-500 hover:bg-slate-100">Batal</a>
  </div>
</form>
@endsection