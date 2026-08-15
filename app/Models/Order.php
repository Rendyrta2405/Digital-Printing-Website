<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Setting;

class Order extends Model
{
   use HasFactory;

   const STATUSES = ['menunggu', 'baru', 'diproses', 'selesai', 'ditolak'];

   public function statusBadgeClass(): string
   {
      return match ($this->status) {
         'menunggu' => 'bg-slate-200 text-slate-600',
         'baru' => 'bg-blue-100 text-blue-700',
         'diproses' => 'bg-orange-100 text-orange-700',
         'selesai'  => 'bg-emerald-100 text-emerald-700',
         'ditolak'  => 'bg-red-100 text-red-700',
          default    => 'bg-slate-100 text-slate-600',
      };
   }
   
    protected $fillable = [
        'product_id', 'quantity', 'width', 'height', 'design_option', 
         'notes', 'customer_name', 'customer_phone', 'total', 'status',
    ];

    protected $casts = [
        'width' => 'decimal:2',
        'height' => 'decimal:2',
    ];

    protected static function booted(): void 
    {
        static::creating(function (Order $order) {
            $order->order_number = 'ORD-' . now()->format('ymd') . '-'
                . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateTotal(): int
    {
        if ($this->product->price === null) {
            return 0;
        }

        if ($this->product->price_unit === '/m²' && $this->width && $this->height) {
            return (int) round(
               $this->width * $this->height * $this->product->price) 
               * $this->quantity;
        }

        return $this->product->price * $this->quantity;
    }

    public function whatsappMessage(): string
    {
        $lines = [
            'Halo Toko Percetakan! Saya mau pesan:',
            '',
            'No. Order : ' . $this->order_number,
            'Nama      : ' . $this->customer_name,
            'Produk    : ' . $this->product->name,
            'Jumlah    : ' . $this->quantity,
        ];

        if ($this->width && $this->height) {
            $lines[] = 'Ukuran    : ' . floatval($this->width) . ' x ' . floatval($this->height) . ' m';
        }

        $lines[] = 'Desain    : ' . ($this->design_option === 'punya'
            ? 'Sudah ada desain sendiri'
            : 'Tolong buatkan desain');

        if ($this->notes) {
            $lines[] = 'Catatan   : ' . $this->notes;
        }

        $lines[] = '';
        $lines[] = 'Estimasi Total : ' . ($this->total > 0
            ? 'Rp ' . number_format($this->total, 0, ',', '.')
            : 'Konsultasi');

        return implode("\n", $lines);
    }

    public function whatsappUrl(): string
    {
       $number = Setting::first()->whatsapp_number ?? '6283171125657';
       
        return 'https://wa.me/' . $number . '?text=' . urlencode($this->whatsappMessage());
    }

   public function scopeStatus($query, ?string $status)
   {
       return $query->when($status, fn ($q) => $q->where('status', $status));
   }
   
   public function scopeSearch($query, ?string $term)
   {
       return $query->when($term, fn ($q) => $q->where('order_number', 'like', "%{$term}%"));
   }
   
   public function customerWhatsAppUrl(): ?string
   {
       if (! $this->customer_phone) {
           return null;
       }
   
       $number = str_starts_with($this->customer_phone, '0')
           ? '62' . substr($this->customer_phone, 1)
           : $this->customer_phone;
   
       return 'https://wa.me/' . $number;
   }

   // Hanya pesanan yang benar-benar terkonfirmasi
   public function scopeValid($query)
   {
      return $query->whereIn('status', ['baru', 'diproses', 'selesai']);
   }
}
