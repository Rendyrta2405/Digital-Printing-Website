@extends('admin.layout.app')

@section('title', 'Pengaturan Website')

@section('content')
@php
  $card  = 'bg-white rounded-2xl border border-slate-200 shadow-sm';
  $label = 'block text-sm font-bold text-slate-700 mb-1.5';
  $input = 'w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20';
  $head  = 'flex items-center gap-2 font-extrabold mb-4';

  // 🔧 Sesuaikan key dengan nama kolom di tabel settings Anda
  $socialFields = [
    'instagram_usn' => ['fa-instagram text-pink-400', 'Username Instagram'],
    'tiktok_usn'    => ['fa-tiktok', 'Username TikTok'],
    'facebook_usn'       => ['fa-square-facebook text-blue-500', 'Username Facebook'],
    'twitter_usn'        => ['fa-square-x-twitter', 'Username Twitter / X'],
    'youtube_handle'     => ['fa-youtube text-red-500', 'Handle YouTube'],
  ];
@endphp

<form method="POST" action="{{ route('admin.settings.update', $site) }}" enctype="multipart/form-data"
      class="grid lg:grid-cols-2 gap-5 items-start">
  @csrf
  @method('PATCH')

  {{-- ═══ Identitas ═══ --}}
  <div class="{{ $card }} p-5 lg:p-6">
    <h3 class="{{ $head }}">🏷️ Identitas Toko</h3>
    <div class="space-y-4">
      <div>
        <label class="{{ $label }}">Nama Toko</label>
        <input type="text" name="site_name" 
           value="{{ old('site_name', $site->site_name ?? '') }}" 
           class="{{ $input }}" required
           placeholder="Digital Printing">
      </div>
      <div>
        <label class="{{ $label }}">Tagline</label>
        <input type="text" name="tagline" 
           value="{{ old('tagline', $site->tagline ?? '') }}" class="{{ $input }}"
           placeholder="Digital Printing nomor 1 di Jakarta">
      </div>
      <div>
        <label class="{{ $label }}">Judul Hero</label>
        <input type="text" name="title" required
           value="{{ old('title', $site->title ?? '') }}" class="{{ $input }}"
           placeholder="Cetak Kilat 1 Jam Jadi!Kualitas Premium, Harga Merakyat">
      </div>
      <div>
        <label class="{{ $label }}">Deskripsi yang menarik </label>
        <textarea name="description" rows="3" class="{{ $input }}"
           placeholder="Jangan buang waktu antri di tempat lain. Digital Printing siap melayani cetak banner, buku, stiker, dan kebutuhan promosi ..">{{ old('description', $site->description ?? '') }}</textarea>
      </div>
      <div>
        <label class="{{ $label }}">Sejarah Singkat Tentang Bisnis Saya</label>
        <textarea name="about_text" rows="3" class="{{ $input }}"
           placeholder="Sejak 2016, Digital Printing telah menjadi mitra percetakan terpercaya bagi ribuan pelanggan, dari UMKM hingga perusahaan besar ...">{{ old('about_text', $site->about_text ?? '') }}</textarea>
      </div>
      <div>
        <label class="{{ $label }}">Foto Bangunan (opsional)</label>
        @if ($site?->about_img)
          <img src="{{ asset('storage/' . $site->about_img) }}" class="w-24 h-24 rounded-xl object-cover mb-2">
        @endif
        <input type="file" name="about_img" accept="image/*" class="{{ $input }}">
      </div>
    </div>
  </div>

  <div class="space-y-5">
    {{-- ═══ Kontak & Lokasi ═══ --}}
    <div class="{{ $card }} p-5 lg:p-6">
      <h3 class="{{ $head }}">📞 Kontak & Lokasi</h3>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="{{ $label }}">No. WhatsApp (format 62…)</label>
          <input type="text" name="whatsapp_number" 
             value="{{ old('whatsapp_number', $site->whatsapp_number ?? '') }}" 
             class="{{ $input }}" required
             placeholder="62xxxxxxxxx">
        </div>
        <div>
          <label class="{{ $label }}">Email</label>
          <input type="email" name="email" 
             value="{{ old('email', $site->email ?? '') }}" class="{{ $input }}"
             placeholder="digital@printing.com">
        </div>
        <div>
          <label class="{{ $label }}">Jam Buka</label>
          <input type="text" name="opening_hours" 
             value="{{ old('opening_hours', $site->opening_hours ?? '') }}" 
             class="{{ $input }}" placeholder="Senin - Sabtu, 09.00 - 19.00 WIB">
        </div>
        <div>
          <label class="{{ $label }}">Query Maps (opsional)</label>
          <input type="text" name="maps_query" 
             placeholder="-6.1827085, 106.9467213"
             value="{{ old('maps_query', $site->maps_query ?? '') }}" 
             class="{{ $input }}">
          <p class="text-xs text-slate-400 mt-1">
             Tips: Isi koordinat seperti:
             <code class="text-red-500">-6.1827085, 106.9467213</code> 
             agar alamat lebih akurat.
          </p>
        </div>
        <div class="sm:col-span-2">
          <label class="{{ $label }}">Alamat</label>
          <textarea name="address" rows="2" class="{{ $input }}"
             placeholder="Jl. Soekarno Hatta No. 01, Jakarta Pusat, DKI Jakarta 19900">{{ old('address', $site->address ?? '') }}</textarea>
        </div>
      </div>
    </div>

    {{-- ═══ Sosial Media ═══ --}}
    <div class="{{ $card }} p-5 lg:p-6">
      <h3 class="{{ $head }}">🔗 Sosial Media</h3>
      <div class="grid sm:grid-cols-2 gap-4">
        @foreach ($socialFields as $column => [$icon, $text])
          <div>
            <label class="{{ $label }}">
            <i class="fa-brands {{ $icon }}"></i> {{ $text }}
            </label>
            <input type="text" name="{{ $column }}" placeholder="digital_printing"
                   value="{{ old($column, $site->{$column} ?? '') }}" 
               class="{{ $input }}">
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="lg:col-span-2">
    <button class="bg-gradient-to-r from-brand to-cmyk-c text-white px-8 py-3 rounded-xl font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">
      💾 Simpan Pengaturan
    </button>
  </div>
</form>
@endsection