<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
   
    protected $fillable = [
      'category_id', 'name', 'description', 'price', 'price_unit',
      'image', 'badge', 'tag', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
      'is_featured' => 'boolean',
      'is_active' => 'boolean'
    ];

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function formatPrice(): string
    {
       if ($this->price === null) {
          return 'Konsultasi';
       }
       return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}