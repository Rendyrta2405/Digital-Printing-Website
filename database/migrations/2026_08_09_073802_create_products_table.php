<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price')->nullable(); // Dalam Rupiah
            $table->string('price_unit')->nullable(); // "/m²", "/box", "/eks"
            $table->string('image')->nullable();
            $table->string('badge')->nullable(); // HOT, NEW, TERLARIS, PROMO
            $table->string('tag')->nullable(); //  "label" untuk filter: Semua / Promosi / Event / Dekorasi / Custom
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};