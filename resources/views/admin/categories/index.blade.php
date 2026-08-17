@extends('admin.layout.app')

@section('title', 'Manajemen Kategori')

@section('content')
@php $card = 'bg-white rounded-2xl border border-slate-200 shadow-sm'; @endphp

<div class="flex justify-end mb-6">
  <a href="{{ route('admin.categories.create') }}"
     class="bg-gradient-to-r from-brand to-cmyk-c text-white px-5 py-2.5 rounded-xl text-sm font-extrabold shadow-lg shadow-brand/30 hover:opacity-90">
     ＋ Tambah Kategori
  </a>
</div>

<div class="{{ $card }} overflow-hidden p-4 lg:p-5">
 <table class="w-full text-sm table-bordered js-datatable">
   <thead>
     <tr class="text-left text-xs uppercase tracking-wide text-slate-400 bg-slate-50">
       <th class="px-5 py-3">Urutan</th>
       <th class="px-5 py-3 no-export">Gambar</th>
       <th class="px-5 py-3">Nama</th>
       <th class="px-5 py-3">Harga Mulai</th>
       <th class="px-5 py-3">Produk</th>
       <th class="px-5 py-3">Navbar</th>
       <th class="px-5 py-3">Status</th>
       <th class="px-5 py-3">Judul</th>
       <th class="px-5 py-3">Deskripsi</th>
       <th class="px-5 py-3 text-right no-export">Aksi</th>
     </tr>
   </thead>
   <tbody class="divide-y divide-slate-100">
     @forelse ($categories as $cat)
       <tr class="hover:bg-slate-50">
         <td class="px-5 py-3 font-mono font-bold text-slate-400">{{ $cat->sort_order }}</td>
         <td class="px-5 py-3 font-extrabold">
            @if($cat->image)
               <img src="{{ asset('storage/' . $cat->image) }}" 
                  class="w-12 h-12 object-cover rounded"
                  alt="{{ $cat->name }}"
                  onclick="openLightbox(this.src, this.alt)">
            @else
               <div class="w-12 h-12 bg-slate-200 rounded flex 
                  items-center justify-center">📷</div>
            @endif
         </td>
         <td class="px-5 py-3 font-extrabold">{{ $cat->name }}</td>
         <td class="px-5 py-3 font-bold text-brand">{{ $cat->price_text ?? '-' }}</td>
         <td class="px-5 py-3">
           <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-brand">{{ $cat->products->count() }}</span>
         </td>
         <td class="px-5 py-3">{{ $cat->show_in_navbar ? '✅' : '—' }}</td>
         <td class="px-5 py-3">
           <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $cat->is_active ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
             {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
           </span>
         </td>
         <td class="px-5 py-3">
            {{ Str::limit($cat->title, 50) }}
         </td>
         <td class="px-5 py-3">
            {{ Str::limit($cat->description, 50) }}
         </td>
         <td class="px-5 py-3 text-right whitespace-nowrap">
           <a href="{{ route('admin.categories.edit', $cat) }}" class="font-bold text-brand hover:underline">Edit</a>
           <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline ml-3"
                 onsubmit="return confirm('Hapus kategori beserta produknya?')">
             @csrf @method('DELETE')
             <button class="font-bold text-red-500 hover:underline">Hapus</button>
           </form>
         </td>
       </tr>
     @empty
       <tr><td colspan="8" class="px-5 py-8 text-center text-slate-400">Belum ada kategori.</td></tr>
     @endforelse
   </tbody>
 </table>
</div>
@endsection