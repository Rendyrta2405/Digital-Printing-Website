<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.testimonials.index', [
           'testimonials' => Testimonial::latest()->paginate(10),
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
       Testimonial::create($this->validatedData($request));

       return back()->with('success', 'Terima kasih! Ulasan Anda akan tampil setelah disetujui admin.');
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
    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => $request->boolean('is_approved')]);

       return back()->with('success', 'Status testimoni diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
       $this->deleteOldImage($testimonial);
       
       $testimonial->delete();

       return back()->with('success', 'Testimoni dihapus.');
    }

   // ── Helper privat (DRY) ─

   private function validatedData(Request $request, ?Testimonial $testimonial = null): array
   {
      $data = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'role' => ['nullable', 'string', 'max:100'],
        'image' => ['nullable', 'image', 'max:2048'],
        'content' => ['required', 'string', 'max:1000'],
        'rating' => ['required', 'integer', 'min:1', 'max:5'],
      ]);

      if ($request->hasFile('image')) {
         $this->deleteOldImage($testimonial);
         $data['image'] = $request->file('image')->store('testimonials', 'public');
      }

      return $data;
   }

   private function deleteOldImage(?Testimonial $testimonial): void
   {
      if ($testimonial?->image && str_starts_with($testimonial->image, 'testimonials/')) {
         Storage::disk('public')->delete($testimonial->image);
      }
   }
}
