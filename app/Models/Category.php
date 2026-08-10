<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
         'name', 'slug', 'description', 'is_active', 'sort_order', 'image', 'price_text', 'show_in_navbar'
    ];

    protected $casts = [
         'is_active' => 'boolean',
         'show_in_navbar' => 'boolean',
    ];

    public function products()
    {
       return $this->hasMany(Product::class)->orderBy('sort_order');
    }
}