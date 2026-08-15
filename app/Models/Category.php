<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
         'name', 'slug', 'description', 'is_active', 'sort_order', 'image', 
         'price_text', 'show_in_navbar', 'title', 'slogan',
    ];

    protected $casts = [
         'is_active' => 'boolean',
         'show_in_navbar' => 'boolean',
    ];

    public function products()
    {
       return $this->hasMany(Product::class)->orderBy('sort_order');
    }

   public static function booted(): void
   {
      static::saving(function (Category $category) {
         $base = Str::slug($category->name);

         $slug = $base;
         $i = 2;

         while (static::where('slug',$slug)
               ->where('id', '!=', $category->id)
               ->exists()) {
            $slug = $base . '-' . $i++;
               }

         $category->slug = $slug;
      });
   }
}