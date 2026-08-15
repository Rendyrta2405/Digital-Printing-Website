<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
   use HasFactory;
    /**
     * Kolom yang boleh diisi massal (whitelist keamanan).
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'price_unit',
        'image',
        'badge',
        'tag',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    /**
     * Penerjemah tipe data dari database ke PHP.
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi: satu produk milik satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi kebalikan: satu produk bisa punya banyak order.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Format harga untuk tampilan. Pisahkan penyimpanan vs presentasi.
     */
    public function formatPrice(): string
    {
        if ($this->price === null) {
            return 'Konsultasi Harga';
        }

        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Accessor: $product->image_url
     * Menyatukan 3 jenis gambar: URL eksternal, file lama (assets/),
     * dan file upload (storage).
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return match (true) {
            str_starts_with($this->image, 'http')    => $this->image,
            str_starts_with($this->image, 'assets/') => asset($this->image),
            default                                  => Storage::url($this->image),
        };
    }
}