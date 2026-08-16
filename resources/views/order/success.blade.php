@extends('layouts.app')

@section('title', 'Pesanan Tercatat - ' . $site->site_name)

@section('content')
<section class="page-hero">
  <div class="container text-center position-relative">
    <h1 class="fw-extrabold">✅ Pesanan Tercatat!</h1>
    <p class="mb-0" style="color:rgba(255,255,255,.9)">Terima kasih, {{ $order->customer_name }}. Satu langkah lagi menuju cetakan keren!</p>
  </div>
</section>

<section class="pb-5" style="background:#eef2f7">
  <div class="container">
    <div class="card border-0 shadow-lg success-card">
      <div class="card-body p-4 p-md-5 text-center">

        <div class="success-check"><i class="bi bi-check-lg"></i></div>
        <h4 class="fw-extrabold mt-3">Simpan Nomor Pesanan Anda</h4>
        <p class="text-muted mb-0">Gunakan nomor ini untuk melacak progres pesanan:</p>

        <div class="ticket-number">{{ $order->order_number }}</div>

        <div class="row text-start g-3 mx-auto mb-3" style="max-width:460px">
          <div class="col-6">
            <small class="text-muted d-block">Produk</small>
            <strong>{{ $order->product->name }}</strong>
          </div>
          <div class="col-6">
            <small class="text-muted d-block">Jumlah</small>
            <strong>
               {{ $order->quantity }}
            </strong>
          </div>
          <div class="row text-start g-3 mx-auto mb-3 col-12">
              @if ($order->width && $order->height)
                <div class="col-6">
                  <small class="text-muted d-block">Ukuran</small>
                  <strong>
                     {{ floatval($order->width) }}×{{ floatval($order->height) }} m 
                  </strong>
                </div>
              @endif
             <div class="col-6">
               <small class="text-muted d-block">Estimasi Total</small>
               <span class="price fs-5">
                  {{ $order->total <= 0 ? 'Konsultasi Harga' :
                  'Rp ' . number_format($order->total, 0, ',', '.') }}
               </span>
             </div>
          </div>
        </div>

        <div class="alert alert-info small text-start mx-auto" style="max-width:460px">
          Pesanan berstatus <strong>menunggu</strong>. Status berubah menjadi <strong>baru</strong>
          setelah Anda mengirim pesan WhatsApp di bawah ini dan admin mengonfirmasinya.
        </div>

        <div class="d-grid gap-2 mx-auto mt-4" style="max-width:460px">
          <a href="{{ $order->whatsappUrl() }}" target="_blank" class="btn btn-wa btn-lg">
            <i class="bi bi-whatsapp"></i> Lanjutkan ke WhatsApp
          </a>
          <a href="{{ route('orders.track', ['order_number' => $order->order_number]) }}" class="btn btn-ink">
            <i class="bi bi-box-seam"></i> Lacak Pesanan Ini
          </a>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection