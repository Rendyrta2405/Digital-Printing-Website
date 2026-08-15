@extends('admin.layouts.app')

@section('title', 'Manajemen Order')

@section('content')
<h1 class="text-2xl font-bold text-slate-800 mb-6">🧾 Manajemen Order</h1>

{{-- Filter status (berupa LINK, bukan tombol) --}}
<div class="flex flex-wrap gap-2 mb-4">
   <a href="{{ route('admin.orders.index', ['q' => $currentSearch]) }}" class="px-3 py-1 rounded-full text-sm {{ !$currentStatus ? 'bg-slate-800 text-white' : 'bg-white border border-slate-300' }}">
      Semua
   </a>
   @foreach ($statuses as $s)
      <a href="{{ route('admin.orders.index', ['status' => $s, 'q' => $currentSearch]) }}" 
         class="px-3 py-1 rounded-full text-sm {{ $currentStatus === $s ? 'bg-slate-800 text-white' : 'bg-white border border-slate-300' }}">
         {{ ucfirst($s) }}
      </a>
   @endforeach
</div>

{{-- Pencarian: form GET --}}
<form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2 mb-4">
   @if ($currentStatus)
      <input type="hidden" name="status" value="{{ $currentStatus }}">
   @endif
   <input type="search" name="q" value="{{ $currentSearch }}"
      placeholder="Cari no. order…"
      class="border border-slate-300 rounded-lg px-3 py-2 text-sm w-64">
   <button class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm">Cari</button>
</form>

<div class="bg-white rounded-xl shadow overflow-x-auto">
   <table class="w-full text-sm">
      <thead>
         <tr class="text-left text-slate-500 border-b bg-slate-50">
             <th class="p-3">No. Order</th>
             <th class="p-3">Customer</th>
             <th class="p-3">Produk</th>
             <th class="p-3">Total</th>
             <th class="p-3">Status</th>
             <th class="p-3">Masuk</th>
         </tr>
     </thead>
      <tbody>
         @forelse ($orders as $order)
            <tr class="border-b border-slate-100 hover:bg-slate-50">
               <td class="p-3">
                  <a href="{{ route('admin.orders.show', $order) }}" 
                     class="font-mono text-xs text-blue-600 hover:underline">
                     {{ $order->order_number }}
                  </a>
               </td>
               <td class="p-3">{{ $order->customer_name ?? '-' }}</td>
               <td class="p-3">{{ $order->product->name }}</td>
               <td class="p-3">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
               <td class="p-3">
                  <span class="px-2 py-1 rounded-full text-xs {{ $order->statusBadgeClass() }}">
                     {{ ucfirst($order->status) }}
                  </span>
               </td>
               <td class="p-3 text-slate-500">{{ $order->created_at->diffForHumans() }}</td>
            </tr>
         @empty
            <tr>
               <td colspan="6" class="p-6 text-center text-slate-400">Tidak ada order yang cocok.</td>
            </tr>
         @endforelse
      </tbody>
   </table>
</div>

<div class="mt-4">{{ $orders->links() }}</div>
@endsection