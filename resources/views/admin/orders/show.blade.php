@extends('admin.layout.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
@php $card = 'bg-white rounded-2xl border border-slate-200 shadow-sm'; @endphp

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
  <div class="flex items-center gap-3">
    <a href="{{ route('admin.orders.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-300 flex items-center justify-center hover:bg-slate-50">←</a>
    <h2 class="font-extrabold text-lg font-mono">{{ $order->order_number }}</h2>
    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $order->statusBadgeClass() }}">{{ ucfirst($order->status) }}</span>
  </div>
  <p class="text-sm text-slate-500">Masuk {{ $order->created_at->diffForHumans() }}</p>
</div>

<div class="grid lg:grid-cols-3 gap-5">

  {{-- Produk --}}
  <div class="{{ $card }} p-5">
    <h3 class="font-extrabold mb-4">📦 Produk</h3>
    @if ($order->product->image_url)
      <img src="{{ $order->product->image_url }}" class="w-full h-40 object-cover rounded-xl mb-4">
    @endif
    <p class="font-bold">{{ $order->product->name }}</p>
    <p class="text-sm text-slate-500 mb-4">{{ $order->product->formatPrice() }}{{ $order->product->price_unit ?? '' }}</p>
    <dl class="text-sm space-y-2 text-slate-600">
      <div class="flex justify-between"><dt>Jumlah</dt><dd class="font-bold">{{ $order->quantity }}</dd></div>
      @if ($order->width && $order->height)
        <div class="flex justify-between"><dt>Ukuran</dt><dd class="font-bold">{{ floatval($order->width) }} × {{ floatval($order->height) }} m</dd></div>
      @endif
      <div class="flex justify-between"><dt>Desain</dt><dd class="font-bold">{{ $order->design_option === 'punya' ? 'Punya customer' : 'Buatkan' }}</dd></div>
      @if ($order->notes)
        <div><dt class="mb-1">Catatan</dt><dd class="bg-slate-50 rounded-xl p-3 text-xs">{{ $order->notes }}</dd></div>
      @endif
    </dl>
  </div>

  {{-- Customer --}}
  <div class="{{ $card }} p-5">
    <h3 class="font-extrabold mb-4">👤 Customer</h3>
    <p class="font-bold">{{ $order->customer_name ?? 'Tanpa nama' }}</p>
    <p class="text-sm text-slate-500 mb-4">{{ $order->customer_phone ?? '-' }}</p>
    @if ($order->customerWhatsAppUrl())
      <a href="{{ $order->customerWhatsAppUrl() }}" target="_blank"
         class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-extrabold px-5 py-2.5 rounded-xl shadow-lg shadow-emerald-500/30">
        💬 Chat Customer
      </a>
    @endif
  </div>

  {{-- Total & status --}}
  <div class="{{ $card }} p-5">
    <h3 class="font-extrabold mb-4">💰 Total & Status</h3>
    <p class="text-2xl font-extrabold text-brand mb-5">Rp {{ number_format($order->total, 0, ',', '.') }}</p>

    <p class="text-sm font-bold text-slate-700 mb-2">Ubah status:</p>
    <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="flex flex-wrap gap-2">
      @csrf @method('PATCH')
      @foreach ($statuses as $s)
        <button type="submit" name="status" value="{{ $s }}"
                class="px-4 py-2 rounded-xl text-sm font-extrabold border transition
                       {{ $order->status === $s ? $order->statusBadgeClass() . ' ring-2 ring-slate-400' : 'bg-white hover:bg-slate-50 border-slate-300 text-slate-600' }}">
          {{ ucfirst($s) }}
        </button>
      @endforeach
    </form>
  </div>
</div>
@endsection