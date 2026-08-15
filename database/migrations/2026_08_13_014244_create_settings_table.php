<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('tagline')->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('whatsapp_number');
            $table->string('email');
            $table->text('opening_hours');
            $table->text('about_text');
            $table->text('address');
            $table->string('maps_query')->nullable();
            $table->string('about_img')->nullable();
            $table->string('instagram_usn')->nullable();
            $table->string('tiktok_usn')->nullable();
            $table->string('facebook_usn')->nullable();
            $table->string('twitter_usn')->nullable();
            $table->string('youtube_handle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
