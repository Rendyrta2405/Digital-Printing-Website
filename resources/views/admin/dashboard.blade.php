@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
@php
  $card = 'bg-white rounded-2xl border border-slate-200 shadow-sm';
  $chips = [
    'bg-blue-100 text-blue-600', 'bg-cyan-100 text-cyan-600', 'bg-pink-100 text-pink-600',
    'bg-amber-100 text-amber-600', 'bg-emerald-100 text-emerald-600', 'bg-violet-100 text-violet-600',
  ];
  $items = [
    ['fa-folder-open', 'Kategori', $stats['categories'], 'categories'],
    ['fa-boxes-stacked', 'Produk', $stats['products'], 'products'],
    ['fa-clipboard-check', 'Order Valid', $stats['orders'], 'orders'],
    ['fa-hourglass-half', 'Lead Menunggu', $stats['leads'], 'orders'],
    ['fa-calendar-days', 'Order Hari Ini', $stats['ordersToday'], 'orders'],
    ['fa-sack-dollar', 'Estimasi Pendapatan', 'Rp ' . number_format($stats['revenue'], 0, ',', '.'), 'orders'],
  ];


@endphp

{{-- Kartu statistik --}}
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
  @foreach ($items as $i => [$icon, $label, $value, $href])
   @php
      $route = null;
   
      if ($label === 'Lead Menunggu') {
         $route = route("admin.$href.index", ['status' => 'menunggu']);
      } else if ($label === 'Order Valid') {
         $route = route("admin.$href.index", ['status' => 'baru']);
      } else if ($label === 'Estimasi Pendapatan') {
         $route = route("admin.$href.index", ['status' => 'selesai']);
      } else {
         $route = route("admin.$href.index");
      }
   @endphp
    <a class="{{ $card }} p-4"
       href="{{ $route }}">
      <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg mb-3 {{ $chips[$i] }}">
         <i class="fa-solid {{ $icon }}"></i>
      </div>
      <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wide">{{ $label }}</p>
      <p class="text-xl font-extrabold mt-0.5 {{ $i === 5 ? 'text-base' : '' }}">{{ $value }}</p>
    </a>
  @endforeach
</div>

{{-- Pesanan terbaru --}}
<div class="{{ $card }} overflow-hidden p-4 lg:p-5">
  <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
    <h2 class="font-extrabold">Pesanan Terbaru</h2>
    <a href="{{ route('admin.orders.index', ['status' => 'baru']) }}" class="text-sm font-bold text-brand hover:underline">Lihat semua →</a>
  </div>
 <table class="w-full text-sm js-datatable">
   <thead>
     <tr class="text-left text-xs uppercase tracking-wide text-slate-400 bg-slate-50">
       <th class="px-5 py-3">No. Order</th>
       <th class="px-5 py-3">Customer</th>
       <th class="px-5 py-3">Produk</th>
       <th class="px-5 py-3">Total</th>
       <th class="px-5 py-3">Status</th>
       <th class="px-5 py-3">Masuk</th>
     </tr>
   </thead>
   <tbody class="divide-y divide-slate-100">
     @foreach ($recentOrders as $order)
       <tr class="hover:bg-slate-50">
         <td class="px-5 py-3 font-mono text-xs font-bold text-brand">
            <a href="{{ route('admin.orders.show', $order) }}">
               {{ $order->order_number }}
            </a>
         </td>
         <td class="px-5 py-3 font-semibold">{{ $order->customer_name ?? '-' }}</td>
         <td class="px-5 py-3">{{ $order->product->name }}</td>
         <td class="px-5 py-3 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
         <td class="px-5 py-3">
           <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $order->statusBadgeClass() }}">{{ ucfirst($order->status) }}</span>
         </td>
         <td class="px-5 py-3 text-slate-500">{{ $order->created_at->diffForHumans() }}</td>
       </tr>
     @endforeach
   </tbody>
 </table>
</div>
@endsection