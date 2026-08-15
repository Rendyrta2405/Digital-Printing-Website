@extends('admin.layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
   <h1 class="text-2xl font-bold text-slate-800">📂 Manajemen Kategori</h1>
   <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
       + Tambah Kategori
   </a>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
   <table class="w-full text-sm">
      <thead>
         <tr class="text-left text-slate-500 border-b bg-slate-50">
             <th class="p-3">#</th>
             <th class="p-3">Gambar</th>
             <th class="p-3">Jenis Kategori</th>
             <th class="p-3">Status</th>
             <th class="p-3">Tampil di Navbar?</th>
             <th class="p-3">Judul Kategori</th>
             <th class="p-3">Slogan</th>
             <th class="p-3">Teks Harga</th>
             <th class="p-3">Deskripsi Kategori</th>
             <th class="p-3 text-right">Aksi</th>
         </tr>
     </thead>
      <tbody>
         @forelse($categories as $index => $cat)
            <tr class="border-b border-slate-100 hover:bg-slate-50 max-h-10">
               <td class="p-3">{{ $index + 1 }}</td>
               <td class="p-3">
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
              <td class="p-3 font-medium">{{ $cat->name }}</td>
               <td class="p-3">
                  <span class="{{ $cat->is_active ? 'text-emerald-600' : 'text-red-500' }}">
                     {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
                  </span>
               </td>
              <td class="p-3
                 {{ $cat->show_in_navbar ? 'text-emerald-600' : 'text-red-500' }}">
                 {{ $cat->show_in_navbar ? 'Ditampilkan' : 'Tidak ditampilkan' }}
              </td>
              <td class="p-3">{{ Str::limit($cat->title, 50) }}</td>
              <td class="p-3">{{ $cat->slogan ?? '' }}</td>
               <td class="p-3">
                  {{ $cat->price_text ?? '' }}
               </td>
               <td class="p-3">
                  {{ Str::limit($cat->description, 50) }}
               </td>
               <td class="p-3 text-right whitespace-nowrap">
                  <a href="{{ route('admin.categories.edit', $cat) }}" class="text-blue-600 hover:underline">Edit</a>
                  <form action="{{ route('admin.categories.destroy', $cat) }}" 
                     method="POST"
                     onsubmit="return confirm('Yakin ingin menghapus Kategori {{ $cat->name }}?')">
                     @csrf
                     @method('DELETE')
                     <button class="text-red-600 hover:underline">
                        Hapus
                     </button>
                  </form>
               </td>
            </tr>
         @empty
             <tr>
                <td colspan="7" class="p-6 text-center text-slate-400">
                   <span class="text-2xl">📂</span>
                   <br>
                   Belum ada Kategori.
                   <br>
                   <br>
                   <span class="text-red-600">
                   Tambahkan Kategori terlebih dahulu sebelum menambahkan produk!
                   </span>
                </td>
             </tr>
         @endforelse
      </tbody>
   </table>
</div>
@endsection