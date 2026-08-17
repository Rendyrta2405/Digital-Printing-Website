@extends('layouts.app')

@section('title', 'Lacak Pesanan - ' . $site->site_name)

@section('content')
{{-- Hero kecil --}}
<section class="page-hero">
  <div class="container text-center position-relative">
    <h1 class="fw-extrabold">🔍 Lacak Pesanan</h1>
    <p class="mb-0" style="color:rgba(255,255,255,.9)">Masukkan nomor pesanan Anda untuk melihat progres pengerjaan.</p>
  </div>
</section>

<section class="pb-5" style="background:#eef2f7">
  <div class="container">

    {{-- Kartu pencarian (overlap ke hero) --}}
    <form method="GET" action="{{ route('orders.track') }}" class="card track-form shadow-lg border-0">
      <div class="input-group input-group-lg">
        <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
        <input type="text" name="order_number" class="form-control"
               placeholder="Contoh: ORD-260812-0007" value="{{ request('order_number') }}" required>
        <button class="btn btn-wa px-4" type="submit">Lacak</button>
      </div>
    </form>

    @if ($searched)
      {{-- ❌ Tidak ditemukan --}}
      @if (! $order)
        <div class="alert alert-warning shadow-sm mt-4 text-center mb-0">
          😕 Pesanan dengan nomor tersebut tidak ditemukan. Periksa kembali penulisan nomor Anda.
        </div>

      {{-- ⏳ Menunggu konfirmasi --}}
      @elseif ($order->status === 'menunggu')
        <div class="card border-0 shadow-lg mt-4 mb-0" style="border-radius:24px">
          <div class="card-body p-4 p-md-5 text-center">
            <div class="fs-1 mb-2">⏳</div>
            <h4 class="fw-extrabold">{{ $order->order_number }}</h4>
            <p class="text-muted mb-3">Pesanan tercatat, namun belum dikonfirmasi.</p>
            <div class="alert alert-info small text-start mx-auto mb-3" style="max-width:520px">
              Silakan kirim pesan WhatsApp terlebih dahulu agar admin dapat memproses pesanan Anda. 😊
            </div>
            <a href="{{ $order->whatsappUrl() }}" target="_blank" class="btn btn-wa">
              <i class="bi bi-whatsapp"></i> Kirim Pesan Sekarang
            </a>
          </div>
        </div>

      {{-- 🚫 Ditolak --}}
      @elseif ($order->status === 'ditolak')
        <div class="alert alert-danger shadow-sm mt-4 text-center mb-0">
          Maaf, pesanan <strong>{{ $order->order_number }}</strong> ditolak.
          Silakan hubungi kami via WhatsApp untuk keterangan lebih lanjut.

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
            class="btn btn-warning mt-3" target="_blank">
            <i class="bi bi-whatsapp"></i> Tanyakan tentang order ini
         </a>
        </div>

      {{-- ✅ Stepper progres --}}
      @else
        <div class="card border-0 shadow-lg mt-4 mb-0" style="border-radius:24px">
          <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-5">
              <div>
                <h4 class="fw-extrabold mb-1">{{ $order->order_number }}</h4>
                <p class="text-muted mb-0">
                  {{ $order->product->name }} · {{ $order->quantity }} pcs
                  @if ($order->width && $order->height) · {{ floatval($order->width) }}×{{ floatval($order->height) }} m @endif
                </p>
              </div>
              <span class="price fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>

            @php
              $steps  = ['baru', 'diproses', 'selesai'];
              $labels = ['Pesanan Diterima', 'Sedang Dicetak', 'Selesai'];
              $icons  = ['bi-inbox', 'bi-printer', 'bi-check-circle'];
              $current = array_search($order->status, $steps);
            @endphp

            <div class="stepper">
              @foreach ($steps as $i => $step)
                <div class="step {{ $i < $current ? 'done' : '' }} {{ $i === $current ? 'current' : '' }}">
                  <div class="step-dot"><i class="bi {{ $icons[$i] }}"></i></div>
                  <p class="step-label">{{ $labels[$i] }}</p>
                </div>
                @if (! $loop->last)
                  <div class="step-line {{ $i < $current ? 'done' : '' }}"></div>
                @endif
              @endforeach
            </div>

            <p class="text-center text-muted small mb-0 mt-4">
              - Masuk {{ $order->created_at->diffForHumans() }} -
              <br>
              Jam operasional: {{ $site->opening_hours }}
            </p>
          </div>
        </div>
      @endif
    @endif

  </div>
</section>
@endsection