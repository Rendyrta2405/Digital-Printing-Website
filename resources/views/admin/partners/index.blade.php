@extends('admin.layout.app')

@section('title', 'Manajemen Partners')

@section('content')
@php
  $card  = 'bg-white rounded-2xl border border-slate-200 shadow-sm';
  $label = 'block text-sm font-bold text-slate-700 mb-1.5';
  $input = 'w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20';
@endphp

<form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data"
      class="{{ $card }} p-5 mb-6 grid md:grid-cols-[2fr_1fr_auto] gap-4 items-end">
  @csrf
  <div>
    <label class="{{ $label }}">Nama Brand / Partner</label>
    <input type="text" name="name" placeholder="Cth: Kopi Senja, CV Maju Jaya…" required class="{{ $input }}">
  </div>
  <div>
    <label class="{{ $label }}">Logo</label>
    <input type="file" name="image" accept="image/*" required class="{{ $input }}">
  </div>
  <button class="bg-gradient-to-r from-brand to-cmyk-c text-white px-6 py-2.5 rounded-xl text-sm font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">
    ＋ Tambah
  </button>
</form>

<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">
  @forelse ($partners as $p)
    <div class="{{ $card }} overflow-hidden relative">
      <div class="h-28 flex items-center justify-center bg-white p-4">
        <img src="{{ asset('storage/' . $p->image) }}" class="max-h-full max-w-full object-contain" alt="{{ $p->name }}">
      </div>
      <div class="p-3 border-t border-slate-100">
        <p class="text-sm font-bold text-center truncate">{{ $p->name }}</p>
      </div>
      <form method="POST" action="{{ route('admin.partners.destroy', $p) }}"
            onsubmit="return confirm('Hapus partner ini?')" class="absolute top-2 right-2">
        @csrf @method('DELETE')
        <button class="w-9 h-9 rounded-xl bg-white/90 backdrop-blur text-red-500 font-extrabold shadow hover:bg-red-500 hover:text-white transition">✕</button>
      </form>
    </div>
  @empty
    <div class="{{ $card }} col-span-full p-10 text-center text-slate-400">Belum ada partner.</div>
  @endforelse
</div>
@endsection