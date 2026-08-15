<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.galleries.index', [
           'galleries' => Gallery::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       Gallery::create($this->validatedData($request));

       return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
       $data = $request->validate([
           'image' => ['nullable', 'image', 'max:2048'],
           'show_in_web' => ['nullable', 'boolean'],
           'description' => ['nullable', 'string', 'max:100'],
        ]);

       
      if ($request->hasFile('image')) {
         $this->deleteOldImage($gallery);
         $data['image'] = $request->file('image')->store('galleries', 'public');
      }
       
        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $this->deleteOldImage($gallery);
       
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil dihapus!');
    }

   private function validatedData(Request $request, ?Gallery $gallery = null): array
   {
      $data = $request->validate([
           'image' => ['required', 'image', 'max:2048'],
           'show_in_web' => ['nullable', 'boolean'],
           'description' => ['nullable', 'string', 'max:100'],
        ]);

      if ($request->hasFile('image')) {
         $this->deleteOldImage($gallery);
         $data['image'] = $request->file('image')->store('galleries', 'public');
      }

      return $data;
   }

   private function deleteOldImage(?Gallery $gallery): void
   {
      if ($gallery?->image && str_starts_with($gallery->image, 'galleries/')) {
         Storage::disk('public')->delete($gallery->image);
      }
   }
}
