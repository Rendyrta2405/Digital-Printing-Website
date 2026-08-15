<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory; 
   
    protected $fillable = [
      'name', 'role', 'image', 'content', 'rating', 'is_approved', 
      'sort_order',
    ];

   protected $casts = [
      'is_approved' => 'boolean',
   ];
}