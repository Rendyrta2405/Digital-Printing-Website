@extends('admin.layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
   <h1 class="text-2xl font-bold text-slate-800">📦 Manajemen Produk</h1>
   <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
       + Tambah Produk
   </a>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
   <table class="w-full text-sm">
      <thead>
         <tr class="text-left text-slate-500 border-b bg-slate-50">
             <th class="p-3">#</th>
             <th class="p-3">Gambar</th>
             <th class="p-3">Nama</th>
             <th class="p-3">Kategori</th>
             <th class="p-3">Harga</th>
             <th class="p-3">Badge</th>
             <th class="p-3">Status</th>
             <th class="p-3">Deskripsi</th>
             <th class="p-3 text-right">Aksi</th>
         </tr>
     </thead>
      <tbody>
         @forelse($products as $index => $product)
            <tr class="border-b border-slate-100 hover:bg-slate-50">
               <td class="p-3">{{ $index + 1 }}</td>
               <td class="p-3">
                  @if($product->image)
                     <img src="{{ asset($product->image_url) }}" class="w-12 h-12 object-cover rounded">
                  @else
                     <div class="w-12 h-12 bg-slate-200 rounded flex items-center justify-center">📷</div>
                  @endif
               </td>
              <td class="p-3 font-medium">{{ $product->name }}</td>
              <td class="p-3">{{ $product->category->name }}</td>
              <td class="p-3">{{ $product->formatPrice() }}{{ $product->price_unit ?? '' }}</td>
              <td class="p-3">{{ $product->badge ?? '-' }}</td>
               <td class="p-3">
                  <span class="{{ $product->is_active ? 'text-emerald-600' : 'text-red-500' }}">
                     {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                  </span>
               </td>
               <td class="p-3">
                  {{ Str::limit($product->description, 50) }}
               </td>
               <td class="p-3 text-right whitespace-nowrap">
                  <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">Edit</a>
                  <form action="{{ route('admin.products.destroy', $product) }}" 
                     method="POST"
                     onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?')">
                     @csrf
                     @method('DELETE')
                     <button class="text-red-600 hover:underline">
                        Hapus
                     </button>
                  </form>
               </td>
            </tr>
         @empty
             <tr><td colspan="7" class="p-6 text-center text-slate-400">Belum ada produk.</td></tr>
         @endforelse
      </tbody>
   </table>
</div>

<div class="mt-4">{{ $products->links() }}</div>
@endsection