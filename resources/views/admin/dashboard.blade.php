@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold text-slate-800 mb-6">Dashboard</h1>

{{-- Kartu statistik --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
   <a href="{{ route('admin.categories.index') }}" 
      class="bg-white rounded-xl shadow p-5">
      <p class="text-sm text-slate-500">Kategori</p>
      <p class="text-3xl font-bold text-blue-600">{{ $stats['categories'] }}</p>
   </a>

   <a href="{{ route('admin.products.index') }}" 
      class="bg-white rounded-xl shadow p-5">
      <p class="text-sm text-slate-500">Produk</p>
      <p class="text-3xl font-bold text-emerald-600">{{ $stats['products'] }}</p>
   </a>
   
   <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-xl shadow p-5">
      <p class="text-sm text-slate-500">Total Order yang Valid</p>
      <p class="text-3xl font-bold text-purple-600">{{ $stats['orders'] }}</p>
   </a>
      
   <a href="{{ route('admin.orders.index', ['status' => 'menunggu']) }}" 
      class="bg-white rounded-xl shadow p-5">
      <p class="text-sm text-slate-500">Order tidak Valid</p>
      <p class="text-3xl font-bold text-orange-500">{{ $stats['leads'] }}</p>
   </a>
   
   <a href="{{ route('admin.testimonials.index') }}"
      class="bg-white rounded-xl shadow p-5">
      <p class="text-sm text-slate-500">
         <span>Ulasan yang</span> 
         <br>
         <span>Menunggu Persetujuan</span>
      <p class="text-3xl font-bold text-orange-500">{{ $stats['awaitingApproval'] }}</p>
      </p>
   </a>
   
   <div class="bg-white rounded-xl shadow p-5">
      <p class="text-sm text-slate-500">Estimasi Pendapatan</p>
      <p class="text-3xl font-bold text-slate-800">
         Rp {{ number_format($stats['revenue'], 0, ',', '.') }}
      </p>
   </div>
</div>

{{-- Pesanan terbaru --}}
<div class="bg-white rounded-xl shadow p-5">
   <h2 class="font-bold text-slate-800 mb-4">Pesanan Terbaru</h2>

   <table class="w-full text-sm">
      <thead>
         <tr class="text-left text-slate-500 border-b">
             <th class="py-2">No. Order</th>
             <th>Produk</th>
             <th>Jumlah</th>
             <th>Total</th>
             <th>Masuk</th>
         </tr>
     </thead>
      <tbody>
         @forelse($recentOrders as $order)
            <tr class="border-b border-slate-100 text-left">
               <td class="py-2 font-mono text-xs">
                  <a href="{{ route('admin.orders.show', $order) }}" 
                     class="font-mono text-xs text-blue-600 hover:underline">
                        {{ $order->order_number }}
                     </a>
               </td>
               <td>{{ $order->product->name }}</td>
               <td>{{ $order->quantity }}</td>
               <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
               <td class="text-slate-500">{{ $order->created_at->diffForHumans() }}</td>
            </tr>
         @empty
            <tr>
              <td colspan="5" class="py-6 text-center text-slate-400">
                  Belum ada pesanan masuk.
              </td>
          </tr>
         @endforelse
      </tbody>
   </table>
</div>
@endsection