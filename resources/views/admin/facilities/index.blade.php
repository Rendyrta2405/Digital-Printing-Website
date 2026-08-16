@extends('admin.layout.app')

@section('title', 'Manajemen Fasilitas')

@section('content')
@php
  $card  = 'bg-white rounded-2xl border border-slate-200 shadow-sm';
  $label = 'block text-sm font-bold text-slate-700 mb-1.5';
  $input = 'w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20';
@endphp

{{-- Form tambah (langsung di halaman) --}}
<form method="POST" action="{{ route('admin.facilities.store') }}" enctype="multipart/form-data"
      class="{{ $card }} p-5 mb-6 grid md:grid-cols-[2fr_1fr_auto] gap-4 items-end">
  @csrf
  <div>
    <label class="{{ $label }}">Nama Fasilitas</label>
    <input type="text" name="name" placeholder="Cth: Offset Printing, UV Printing…" required class="{{ $input }}">
  </div>
  <div>
    <label class="{{ $label }}">Gambar</label>
    <input type="file" name="image" accept="image/*" required class="{{ $input }}">
  </div>
  <button class="bg-gradient-to-r from-brand to-cmyk-c text-white px-6 py-2.5 rounded-xl text-sm font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">
    ＋ Tambah
  </button>
</form>

{{-- Grid fasilitas --}}
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
  @forelse ($facilities as $f)
    <div class="{{ $card }} overflow-hidden relative">
      <img src="{{ asset('storage/' . $f->image) }}" class="w-full h-40 object-cover">
      <div class="p-3">
        <p class="text-sm font-bold text-center">{{ $f->name }}</p>
      </div>
      <form method="POST" action="{{ route('admin.facilities.destroy', $f) }}"
            onsubmit="return confirm('Hapus fasilitas ini?')" class="absolute top-2 right-2">
        @csrf @method('DELETE')
        <button class="w-9 h-9 rounded-xl bg-white/90 backdrop-blur text-red-500 font-extrabold shadow hover:bg-red-500 hover:text-white transition">✕</button>
      </form>
    </div>
  @empty
    <div class="{{ $card }} col-span-full p-10 text-center text-slate-400">Belum ada fasilitas.</div>
  @endforelse
</div>
@endsection