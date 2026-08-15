<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.form', [
           'category' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($this->validatedData($request));

       return redirect()->route('admin.categories.index')
          ->with('success', 'Kategori ' . $request->name . ' berhasil ditambahkan!');
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
    public function edit(Category $category)
    {
        return view('admin.categories.form', [
           'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($this->validatedData($request, $category));

       return redirect()->route('admin.categories.index')
          ->with('success', 'Kategori ' 
                 . $category->name 
                 . ' berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->deleteOldImage($category);

       $category->delete();

       return redirect()->route('admin.categories.index')
          ->with('success', 'Kategori ' . $category->name . ' berhasil dihapus!');
    }

   // ── Helper privat (DRY) ─

   private function validatedData(Request $request, ?Category $category = null): array
   {
      $data = $request->validate([
         'name' => ['required', 'string', 'max:50'],
         'description' => ['required', 'string'],
         'title' => ['required', 'string', 'max:100'],
         'slogan' => ['nullable', 'string', 'max:100'],
         'price_text' => ['nullable', 'string', 'max:100'],
         'sort_order' => ['nullable', 'integer', 'min:0'],
         'tag' => ['nullable', 'string', 'max:30'],
         'image' => ['nullable', 'image', 'max:2048'],
      ]);

      $data['show_in_navbar'] = $request->boolean('show_in_navbar');
      $data['is_active'] = $request->boolean('is_active');

      if ($request->hasFile('image')) {
         $this->deleteOldImage($category);
         $data['image'] = $request->file('image')->store('categories', 'public');
      }

      return $data;
   }

   private function deleteOldImage(?Category $category): void
   {
      if ($category?->image && str_starts_with($category->image, 'categories/')) {
         Storage::disk('public')->delete($category->image);
      }
   }
}
