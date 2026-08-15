<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

   protected $fillable = [
      'site_name', 'tagline', 'whatsapp_number', 'about_img',
      'email', 'opening_hours', 'about_text', 'address',
      'title', 'description', 'youtube_handle', 'maps_query',
      'instagram_usn', 'tiktok_usn', 'facebook_usn', 'twitter_usn'
   ];

   const SOCIAL_PLATFORMS = [
      'whatsapp' => ['https://wa.me/', ''],
      'instagram' => ['https://instagram.com/', ''],
      'tiktok' => ['https://tiktok.com/@', ''],
      'facebook' => ['https://facebook.com/', ''],
      'twitter' => ['https://x.com/', ''],
      'youtube' => ['https://youtube.com/@', ''],
   ];

   public function socialUrl(string $platform): ?string
   {
      if (! isset(self::SOCIAL_PLATFORMS[$platform])) {
         return null;
      }

      $column = ($platform === 'whatsapp') ? 'whatsapp_number' :
         (($platform === 'youtube') ? 'youtube_handle' :
         "{$platform}_usn");
      
      $username = $this->{$column} ?? null;
      if (! $username) {
         return null;
      }

      [$base, $prefix] = self::SOCIAL_PLATFORMS[$platform];
      $clean = trim(preg_replace('/[^a-zA-Z0-9_\.]/', '', $username));
      // preg_replace(pola, pengganti, subjek)
   
      if ($platform === 'whatsapp') {
         $phone = preg_replace('/[^0-9]/', '', $username);
         return $phone ? $base . (str_starts_with($phone, '0') ? '62' 
                . substr($phone, 1) : $phone) : null;
      }

      return $clean ? $base . $prefix . $clean : null;
   }

   public function mapsUrl(): ?string
   {
      $query = $this->maps_query ?: $this->address;

      if (!$query) {
         return null;
      }

      return 'https://maps.google.com/maps?q=' 
         . urlencode($query) 
         . '&output=embed';
   }

//    public static function get(string $key, ?string $default = null): ?string
//    {
//       return static::where('key', $key)->value('value') ?? $default;
//    }

//    public static function set(string $key, ?string $value, string $group = 'general'): void
//    {
//       static::updateOrCreate(
//          ['key' => $key],
//          ['value' => $value, 'group' => $group],
//       );
//    }
}
