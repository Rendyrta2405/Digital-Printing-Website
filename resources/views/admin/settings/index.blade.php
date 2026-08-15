@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('content')
<h1 class="text-2xl font-bold text-slate-800 mb-6">⚙️ Pengaturan Website</h1>

@foreach ($settings as $setting)
<form action="{{ route('admin.settings.update', $setting) }}" method="post"
   class="bg-white rounded-xl shadow p-6 max-w-2xl space-y-4" 
   enctype="multipart/form-data">
   @csrf
   @method('PATCH')
   
   <div class="mb-3">
      <label class="block text-sm font-medium text-slate-700 mb-1">Nama Brand</label>
      <input type="text" name="site_name" 
         value="{{ old('site_name', $setting->site_name ?? '') }}" 
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Digital Printing" required>
   </div>
   
   <div class="mb-3">
      <label class="block text-sm font-medium text-slate-700 mb-1">Slogan (opsional)</label>
      <input type="text" name="tagline" 
         value="{{ old('tagline', $setting->tagline ?? '') }}" 
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="✨ Percetakan No.1 di Jakarta Raya">
   </div>
   
   <div class="mb-3">
      <label class="block text-sm font-medium text-slate-700 mb-1">Judul Utama</label>
      <input type="text" name="title" required 
         value="{{ old('title', $setting->title ?? '') }}" 
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Cetak Kilat 1 Jam Jadi!
Kualitas Premium, Harga Merakyat">
   </div>
   
   <div class="mb-3">
      <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi menarik tentang bisnis saya</label>
      <textarea name="description" required rows="3"
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Jangan buang waktu antri di tempat lain. Digital Printing siap melayani cetak banner, buku, ..">{{ old('description', $setting->description ?? '') }}</textarea>
   </div>
      
   <div class="mb-3">
      <label class="block text-sm font-medium text-slate-700 mb-1">No. WhatsApp (format: 62xxxxxx)</label>
      <input type="tel" name="whatsapp_number" 
         value="{{ old('whatsapp_number', $setting->whatsapp_number ?? '') }}" 
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Cetak Kilat 1 Jam Jadi!" required>
   </div>
   
   <div class="mb-3">
      <label class="block text-sm font-medium text-slate-700 mb-1">Email Bisnis</label>
      <input type="email" name="email" 
         value="{{ old('email', $setting->email ?? '') }}" 
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="digital@printing.com" required>
   </div>

   @if($setting->about_img)
   <div class="mb-3">
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">Foto Saat ini</label>
      <img src="{{ asset('storage/' . $setting->about_img) }}" 
         alt="{{ $setting->site_name }}" class="max-w-40 max-h-30 rounded-lg shadow-lg"
         onclick="openLightbox(this.src, null)">
   </div>
   @endif
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">Foto Bangunan Bisnis</label>
      <input type="file" name="about_img" id="" class="form-control" accept="image/*">
      <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti gambar. Maks 2 MB.</p>
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">Jam Operasional Bisnis</label>
      <textarea name="opening_hours" id="" 
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Senin - Sabtu, 09.00 - 19.00 WIB">{{ old('opening_hours', $setting->opening_hours ?? '') }}</textarea>
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">Sejarah Singkat Tentang Bisnis Saya</label>
      <textarea name="about_text" id="" rows="5"
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Sejak 2016, bisnis saya telah berkembang dengan.. ">{{ old('about_text', $setting->about_text ?? '') }}</textarea>
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">
         📍 Alamat Bisnis
      </label>
      <textarea name="address" id="" required
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Jl. Soekarno Hatta..">{{ old('address', $setting->address ?? '') }}</textarea>
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">
         koordinat Maps (opsional)
      </label>
      <input name="maps_query" id=""
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Kosongkan = pakai alamat"
         value="{{ old('maps_query', $setting->maps_query ?? '') }}">
      <p class="text-xs text-slate-500 mt-1">
         Tips: isi koordinat seperti <code>-6.12345, 106.98765</code> 
         agar peta Maps lebih presisi.
         <br>
         Cara ambil: klik kanan lokasi di Google Maps → salin angka koordinatnya.
      </p>
   </div>

   <h3 class="mt-5 text-xl text-medium">
      <i class="fas fa-share-nodes text-blue-500"></i> 
      Sosial Media
   </h3>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">
         <i class="fa-brands fa-instagram text-pink-400"></i> 
         Username Instagram (tanpa @)
      </label>
      <input name="instagram_usn" id=""
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Cth: digital_printing"
         value="{{ old('instagram_usn', $setting->instagram_usn ?? '') }}">
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">
         <i class="fa-brands fa-tiktok"></i>
         Username Tiktok (tanpa @)
      </label>
      <input name="tiktok_usn" id=""
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Cth: digital_printing"
         value="{{ old('tiktok_usn', $setting->tiktok_usn ?? '') }}">
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">
         <i class="fa-brands fa-square-facebook text-blue-500"></i>
         Username Facebook (tanpa @)
      </label>
      <input name="facebook_usn" id=""
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Cth: digital_printing"
         value="{{ old('facebook_usn', $setting->facebook_usn ?? '') }}">
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">
         <i class="fa-brands fa-square-x-twitter"></i>
         Username Twitter / X (tanpa @)
      </label>
      <input name="twitter_usn" id=""
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Cth: digital_printing"
         value="{{ old('twitter_usn', $setting->twitter_usn ?? '') }}">
   </div>
   
   <div>
      <label for="" class="block text-sm font-medium text-slate-700 mb-1">
         <i class="fa-brands fa-youtube text-red-500"></i>
         Handle Youtube (tanpa @)
      </label>
      <input name="youtube_handle" id=""
         class="w-full border border-slate-300 rounded-lg px-3 py-2"
         placeholder="Cth: digital_printing"
         value="{{ old('youtube_handle', $setting->youtube_handle ?? '') }}">
   </div>

   <button class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg px-6 py-2">
     Simpan
 </button>
   <a class="btn bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg px-6 py-2"
      href="{{ route('admin.settings.index') }}">
     Batal
 </a>
</form>
@endforeach
@endsection