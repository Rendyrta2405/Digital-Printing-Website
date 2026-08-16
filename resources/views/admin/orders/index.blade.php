@extends('admin.layout.app')

@section('title', 'Manajemen Order')

@section('content')
@php $card = 'bg-white rounded-2xl border border-slate-200 shadow-sm'; @endphp

{{-- Filter status --}}
<div class="flex flex-wrap gap-2 mb-4">
  <a href="{{ route('admin.orders.index', ['q' => $currentSearch]) }}"
     class="px-4 py-2 rounded-full text-sm font-bold {{ !$currentStatus ? 'bg-ink text-white' : 'bg-white border border-slate-300 text-slate-600 hover:border-ink' }}">
    Semua
  </a>
  @foreach ($statuses as $s)
    <a href="{{ route('admin.orders.index', ['status' => $s, 'q' => $currentSearch]) }}"
       class="px-4 py-2 rounded-full text-sm font-bold {{ $currentStatus === $s ? 'bg-ink text-white' : 'bg-white border border-slate-300 text-slate-600 hover:border-ink' }}">
      {{ ucfirst($s) }}
    </a>
  @endforeach
</div>

{{-- Pencarian --}}
<form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2 mb-5">
  @if ($currentStatus) <input type="hidden" name="status" value="{{ $currentStatus }}"> @endif
  <input type="search" name="q" value="{{ $currentSearch }}" placeholder="Cari no. order…"
         class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm w-64 focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
  <button class="bg-ink text-white px-5 py-2.5 rounded-xl text-sm font-extrabold hover:bg-slate-800">Cari</button>
</form>

<div class="{{ $card }} overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead>
        <tr class="text-left text-xs uppercase tracking-wide text-slate-400 bg-slate-50">
          <th class="px-5 py-3">No. Order</th>
          <th class="px-5 py-3">Customer</th>
          <th class="px-5 py-3">Produk</th>
          <th class="px-5 py-3">Total</th>
          <th class="px-5 py-3">Status</th>
          <th class="px-5 py-3">Masuk</th>
          <th class="px-5 py-3 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse ($orders as $order)
          <tr class="hover:bg-slate-50">
            <td class="px-5 py-3 font-mono text-xs font-bold text-brand">
               <a href="{{ route('admin.orders.show', $order) }}">
                  {{ $order->order_number }}
               </a>
            </td>
            <td class="px-5 py-3">
              <p class="font-bold">{{ $order->customer_name ?? '-' }}</p>
              <p class="text-xs text-slate-400">{{ $order->customer_phone ?? '' }}</p>
            </td>
            <td class="px-5 py-3">{{ $order->product->name }}</td>
            <td class="px-5 py-3 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            <td class="px-5 py-3">
              <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $order->statusBadgeClass() }}">{{ ucfirst($order->status) }}</span>
            </td>
            <td class="px-5 py-3 text-slate-500">{{ $order->created_at->diffForHumans() }}</td>
            <td class="px-5 py-3 text-right">
              <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-brand hover:underline">Detail →</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="px-5 py-8 text-center text-slate-400">Tidak ada order yang cocok.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-5">{{ $orders->links() }}</div>
@endsection