@extends('admin.layout.app')

@section('title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
@php
  $card  = 'bg-white rounded-2xl border border-slate-200 shadow-sm';
  $label = 'block text-sm font-bold text-slate-700 mb-1.5';
  $input = 'w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20';
@endphp

<div class="flex items-center gap-3 mb-6">
  <a href="{{ route('admin.categories.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-300 flex items-center justify-center hover:bg-slate-50">←</a>
  <h2 class="font-extrabold text-lg">{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
</div>

<form method="POST"
      action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
      enctype="multipart/form-data"
      class="{{ $card }} p-5 lg:p-7 max-w-3xl">
  @csrf
  @if (isset($category)) @method('PUT') @endif

  <div class="grid lg:grid-cols-2 gap-5">
    <div>
      <label class="{{ $label }}">Jenis Kategori</label>
      <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="{{ $input }}" required placeholder="Banner, Spanduk, Stiker">
      @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
     
    <div>
      <label class="{{ $label }}">Judul Kategori</label>
      <input type="text" name="title" value="{{ old('title', $category->title ?? '') }}" class="{{ $input }}" required
         placeholder="Cetak Banner Kilat, Jaminan Selesai Tepat Waktu.">
      @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="lg:col-span-2">
      <label class="{{ $label }}">Deskripsi</label>
      <textarea name="description" rows="2" class="{{ $input }}" required
         placeholder="Cetak Banner Express 1 Jam Jadi dengan Kualitas Premium Tahan Cuaca, plus Harga Promo Spanduk">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div>
      <label class="{{ $label }}">Teks Harga (opsional)</label>
      <input type="text" name="price_text" placeholder="Mulai Rp 18.000/m²"
             value="{{ old('price_text', $category->price_text ?? '') }}" class="{{ $input }}">
    </div>

    <div>
      <label class="{{ $label }}">Urutan Tampil (opsional)</label>
      <input type="number" name="sort_order" placeholder="0 - 10000" min="0"
         value="{{ old('sort_order', $category->sort_order ?? 0) }}" 
         class="{{ $input }}">
    </div>

    <div class="lg:col-span-2">
      @if ($category?->image)
        <label class="{{ $label }}">Gambar Sebelumnya</label>
        <img src="{{ asset('storage/' . $category->image) }}" 
           class="w-24 h-24 rounded-xl object-cover mb-4">
      @endif
      <label class="{{ $label }}">Gambar (opsional)</label>
      <input type="file" name="image" accept="image/*" class="{{ $input }} file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-blue-50 file:text-brand file:font-bold">
        <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti gambar. Maks 2 MB.</p>
    </div>

    <label class="flex items-center gap-3 text-sm font-semibold">
      <input type="checkbox" name="show_in_navbar" class="w-5 h-5 rounded accent-blue-600"
             @checked(old('show_in_navbar', $category->show_in_navbar ?? true))>
      🧭 Tampilkan di navbar publik
    </label>
    <label class="flex items-center gap-3 text-sm font-semibold">
      <input type="checkbox" name="is_active" class="w-5 h-5 rounded accent-emerald-600"
             @checked(old('is_active', $category->is_active ?? true))>
      ✅ Kategori aktif
    </label>
  </div>

  <div class="flex gap-3 mt-7">
    <button class="bg-gradient-to-r from-brand to-cmyk-c text-white px-7 py-2.5 rounded-xl font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">Simpan</button>
    <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl font-bold text-slate-500 hover:bg-slate-100">Batal</a>
  </div>
</form>
@endsection