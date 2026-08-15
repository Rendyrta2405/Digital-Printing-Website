@extends('admin.layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="flex items-center justify-between mb-6">
   <h1 class="text-2xl font-bold text-slate-800">
      🧾 {{ $order->order_number }}
      <span class="ml-2 px-2 py-1 rounded-full text-xs align-middle {{ $order->statusBadgeClass() }}">
         {{ ucfirst($order->status) }}
      </span>
   </h1>
   <a href="{{ route('admin.orders.index') }}" class="text-slate-500 hover:underline text-sm">← Kembali</a>
</div>

<div class="grid lg:grid-cols-3 gap-4">

   {{-- Produk --}}
   <div class="bg-white rounded-xl shadow p-5">
        <h2 class="font-bold text-slate-700 mb-3">📦 Produk</h2>
      @if ($order->product->image_url)
         <img src="{{ $order->product->image_url }}" alt="{{ $order->product->name }}" class="w-full h-40 object-cover rounded-lg mb-3">
      @endif
      <p class="font-medium">{{ $order->product->name }}</p>
      <p class="text-sm text-slate-500">{{ $order->product->formatPrice() }}{{ $order->product->price_unit ?? '' }}</p>
      <div class="text-sm mt-3 space-y-1 text-slate-600">
         <p>Jumlah: <strong>{{ $order->quantity }}</strong></p>
         @if ($order->width && $order->height)
            <p>Ukuran: <strong>{{ $order->width }} x {{ $order->height }} m</strong></p>
         @endif
         <p>Desain: <strong>{{ $order->design_option === 'punya' ? 'Punya Customer' : 'Buatkan' }}</strong></p>
         @if ($order->notes)
            <p>Catatan: {{ $order->notes }}</p>
         @endif
      </div>
   </div>

   {{-- Customer --}}
   <div class="bg-white rounded-xl shadow p-5">
     <h2 class="font-bold text-slate-700 mb-3">👤 Customer</h2>
     <p class="font-medium">{{ $order->customer_name ?? 'Tanpa nama' }}</p>
     <p class="text-sm text-slate-500 mb-3">{{ $order->customer_phone ?? '-' }}</p>
      @if ($order->customerWhatsAppUrl())
         <a href="{{ $order->customerWhatsAppUrl() }}" target="_blank" 
            class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white text-sm px-4 py-2 rounded-lg">💬 Chat Customer</a>
      @endif
      <p class="text-xs text-slate-400 mt-4">Masuk {{ $order->created_at->diffForHumans() }}</p>
   </div>

   <div class="bg-white rounded-xl shadow p-5">
     <h2 class="font-bold text-slate-700 mb-3">💰 Total</h2>
      <p class="text-2xl font-bold text-slate-800 mb-4">
         Rp {{ number_format($order->total, 0, ',', '.') }}
      </p>

      <h3 class="text-sm font-semibold text-slate-600 mb-2">Ubah Status:</h3>
      <form action="{{ route('admin.orders.update', $order) }}" method="POST"
         class="flex flex-wrap gap-2">
         @csrf
         @method('PATCH')

         @foreach ($statuses as $s)
            <button type="submit" name="status" value="{{ $s }}" class="px-4 py-2 rounded-lg text-sm border {{ $order->status === $s ? $order->statusBadgeClass() . ' ring-2 ring-slate-400' : 'bg-white hover:bg-slate-50' }}">
               {{ ucfirst($s) }}
            </button>
         @endforeach
      </form>
   </div>
</div>
@endsection