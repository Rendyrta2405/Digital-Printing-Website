@extends('admin.layout.app')

@section('title', 'Manajemen Galeri')

@section('content')
@php
  $card  = 'bg-white rounded-2xl border border-slate-200 shadow-sm';
  $label = 'block text-sm font-bold text-slate-700 mb-1.5';
  $input = 'w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20';
@endphp

{{-- Form upload --}}
<form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data"
      class="{{ $card }} p-5 mb-6 grid md:grid-cols-[1fr_2fr_auto] gap-4 items-end">
  @csrf
  <div>
    <label class="{{ $label }}">Gambar</label>
    <input type="file" name="image" accept="image/*" required class="{{ $input }}">
  </div>
  <div>
    <label class="{{ $label }}">Deskripsi (opsional)</label>
    <input type="text" name="description" placeholder="Cth: Spanduk warung makan" class="{{ $input }}">
  </div>
  <button class="bg-gradient-to-r from-brand to-cmyk-c text-white px-6 py-2.5 rounded-xl text-sm font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">
    ＋ Tambah
  </button>
</form>

{{-- Grid galeri --}}
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
  @forelse ($galleries as $g)
    <div class="{{ $card }} overflow-hidden group relative">
      <img src="{{ asset('storage/' . $g->image) }}" class="w-full h-44 object-cover">
      <div class="p-3">
        <p class="text-sm font-bold truncate">{{ $g->description ?? 'Tanpa deskripsi' }}</p>
      </div>
      <form method="POST" action="{{ route('admin.galleries.destroy', $g) }}"
            onsubmit="return confirm('Hapus gambar ini?')"
            class="absolute top-2 right-2">
        @csrf @method('DELETE')
        <button class="w-9 h-9 rounded-xl bg-white/90 backdrop-blur text-red-500 font-extrabold shadow hover:bg-red-500 hover:text-white transition">
          ✕
        </button>
      </form>
    </div>
  @empty
    <div class="{{ $card }} col-span-full p-10 text-center text-slate-400">Galeri masih kosong.</div>
  @endforelse
</div>

@if (method_exists($galleries, 'links'))
  <div class="mt-5">{{ $galleries->links() }}</div>
@endif
@endsection