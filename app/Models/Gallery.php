<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryFactory> */
    use HasFactory;

   protected $fillable = [
      'image', 'show_in_web', 'description',
   ];

   protected $casts = [
      'show_in_web' => 'boolean',
   ];
}
