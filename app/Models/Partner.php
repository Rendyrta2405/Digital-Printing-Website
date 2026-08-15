<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
      'image', 'show_in_web', 'name',
   ];

   protected $casts = [
      'show_in_web' => 'boolean',
   ];
}
