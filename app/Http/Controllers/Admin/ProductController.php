<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index', [
           'products' => Product::with('category')
                    ->latest()
                    ->get(),
           'categories' => Category::withCount('products')
                    ->orderBy('sort_order')
                    ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.form', [
           'product' => null,
           'price_units' => Product::distinct()
                    ->pluck('price_unit')
                    ->filter(),
           'categories' => Category::orderBy('sort_order')->get(),         
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($this->validatedData($request));

       return redirect()->route('admin.products.index')
          ->with('success', 'Produk ' . $request->name . ' berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.form', [
           'product' => $product,
           'price_units' => Product::distinct()
                    ->pluck('price_unit')
                    ->filter(),
           'categories' => Category::orderBy('sort_order')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($this->validatedData($request, $product));

       return redirect()->route('admin.products.index')
          ->with('success', 'Produk ' . $product->name . ' berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       $this->deleteOldImage($product);
       
       $product->delete();

       return redirect()->route('admin.products.index')
            ->with('success', 'Produk ' . $product->name . ' dihapus.');
    }

   
    // ── Helper privat (DRY) ─

   private function validatedData(Request $request, ?Product $product = null): array
   {
      $data = $request->validate([
         'category_id' => ['required', 'exists:categories,id'],
         'name' => ['required', 'string', 'max:100'],
         'description' => ['nullable', 'string'],
         'price' => ['nullable', 'integer', 'min:0'],
         'price_unit' => ['nullable', 'string', 'max:20'],
         'badge' => ['nullable', 'string', 'max:20'],
         'tag' => ['nullable', 'string', 'max:30'],
         'image' => ['nullable', 'image', 'max:2048'],
      ]);

      $data['is_featured'] = $request->boolean('is_featured');
      $data['is_active'] = $request->boolean('is_active');

      if ($request->hasFile('image')) {
         $this->deleteOldImage($product);
         $data['image'] = $request->file('image')->store('products', 'public');
      }

      return $data;
   }

   private function deleteOldImage(?Product $product): void
   {
      if ($product?->image && str_starts_with($product->image, 'products/')) {
         Storage::disk('public')->delete($product->image);
      }
   }
}
