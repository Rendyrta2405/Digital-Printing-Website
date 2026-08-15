<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
      'image', 'show_in_web', 'name',
   ];

   protected $casts = [
      'show_in_web' => 'boolean',
   ];
}
