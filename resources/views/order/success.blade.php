@extends('layouts.app')

@section('title', 'Pesanan Tercatat')

@section('content')
<div class="container py-5 text-center" style="max-width: 560px">
   <h1 class="mb-2">✅ Pesanan Tercatat!</h1>
   <p class="text-muted">Simpan nomor pesanan Anda untuk melacak progres:</p>

   <div class="display-6 fw-bold font-monospace my-4">
      {{ $order->order_number }}
   </div>

   <div class="alert alert-info small">
       Pesanan Anda berstatus <strong>Menunggu</strong>. Status berubah menjadi
       <strong>Baru</strong> setelah Anda mengirim pesan WhatsApp di bawah ini
       dan admin mengkonfirmasinya.
   </div>
   
   <div class="d-grid gap-2">
      <a href="{{ $order->whatsappUrl() }}" target="_blank" 
         class="btn btn-success btn-lg">
         💬 Lanjutkan ke WhatsApp
      </a>

      <a href="{{ route('orders.track', ['order_number' => $order->order_number]) }}" class="btn btn-outline-primary">
         🔍 Lacak Pesanan Ini
      </a>
   </div>
</div>
@endsection