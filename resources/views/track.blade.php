@extends('layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
<div class="container py-5" style="max-width: 640px">
   <h1 class="section-title">🔍 Lacak <span>Pesanan</span></h1>

   <form action="{{ route('orders.track') }}" method="get" class="d-flex gap-2 mb-4">
      <input type="text" name="order_number" class="form-control"
         placeholder="Contoh: {{ 'ORD-' . now()->format('ymd') . '-0707' }}"
         value="{{ request('order_number', 'ORD-') }}">
      <button class="btn btn-primary">Lacak</button>
   </form>

   @if ($searched)
      @if(! $order)
         <div class="alert alert-warning">
             Pesanan dengan nomor tersebut tidak ditemukan. Periksa kembali penulisan nomor Anda.
         </div>
      @elseif ($order->status === 'menunggu')
          <div class="alert alert-info text-center px-4">
           Pesanan tercatat, namun belum dikonfirmasi. 
           <br>
           Silakan kirim pesan WhatsApp terlebih dahulu 
             agar admin dapat memproses pesanan Anda. 😊
       </div>
      @elseif ($order->status === 'ditolak')
         <div class="alert alert-danger">
             Maaf, pesanan <strong>{{ $order->order_number }}</strong> ditolak.
             Silakan hubungi kami via WhatsApp untuk keterangan lebih lanjut.
            <br>
            @php
               $message = "Halo, " . $site['site_name'] . "!\n\n"
                        . "Saya mau menanyakan pesanan:\n"
                        . "No. Order        : " . $order->order_number . "\n"
                        . "Nama Produk   : " . $order->product->name . "\n"
                        . "Jumlah Order   : " . $order->quantity . " pcs\n"
                        . "Total               : Rp " . number_format($order->total, 0, ',', '.') . "\n\n"
                        . "Mohon infonya ya, terima kasih.";
            @endphp
            <a href="https://wa.me/{{ $site['whatsapp_number'] }}?text={{ rawurlencode($message) }}" 
               class="btn btn-warning mt-3" target="_blank">Hubungi Kami</a>
         </div>
      @else
         <div class="card shadow-sm">
            <div class="card-body">
               <h5 class="mb-1">{{ $order->order_number }}</h5>
               <p class="text-muted small mb-4">
                  {{ $order->product->name }} ● {{ $order->quantity }} pcs ● 
                  Rp {{ number_format($order->total, 0, ',', '.') }}
               </p>

               @php
                  $steps = ['baru', 'diproses', 'selesai'];
                  $current = array_search($order->status, $steps);
               @endphp

               <div class="d-flex justify-content-between">
                  @foreach ($steps as $i => $step)
                     @if ($i > 0)
                        <div class="flex-grow-1 mx-2" 
                           style="height: 3px; 
                           background-color: {{ $i <= $current ? '#198754' : '#e0e0e0' }}; transition: background-color 0.3s;"></div>
                     @endif

                     <div class="text-center position-relative" style="z-index: 2;">
                        <div class="rounded-circle d-inline-flex align-items-center
                           justify-content-center fw-bold
                           {{ $i <= $current ? 'bg-success text-white' : 
                              'bg-light border text-muted' }}"
                           style="width: 42px; height: 42px;">
                           {{ $i <= $current ? '✓' : $i + 1 }}
                        </div>
                        <div class="small mt-1 
                           {{ $i <= $current ? 'fw-bold text-success' : 'text-muted' }}">
                          {{ ucfirst($step) }} 
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      @endif
   @endif
</div>
@endsection