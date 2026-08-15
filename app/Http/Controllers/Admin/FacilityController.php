<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Facility;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.facilities.index', [
           'facilities' => Facility::latest()->paginate(10),
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
        Facility::create($this->validatedData($request));

       return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan!');
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
    public function update(Request $request, Facility $facility)
    {
        $data = $request->validate([
           'image' => ['nullable', 'image', 'max:2048'],
           'show_in_web' => ['nullable', 'boolean'],
           'name' => ['nullable', 'string', 'max:100'],
        ]);

       
      if ($request->hasFile('image')) {
         $this->deleteOldImage($facility);
         $data['image'] = $request->file('image')->store('facilities', 'public');
      }
       
        $facility->update($data);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $this->deleteOldImage($facility);
       
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus!');
    }

   private function validatedData(Request $request, ?Facility $facility = null): array
   {
      $data = $request->validate([
           'image' => ['required', 'image', 'max:2048'],
           'show_in_web' => ['nullable', 'boolean'],
           'name' => ['required', 'string', 'max:100'],
        ]);

      if ($request->hasFile('image')) {
         $this->deleteOldImage($facility);
         $data['image'] = $request->file('image')->store('facilities', 'public');
      }

      return $data;
   }

   private function deleteOldImage(?Facility $facility): void
   {
      if ($facility?->image && str_starts_with($facility->image, 'facilities/')) {
         Storage::disk('public')->delete($facility->image);
      }
   }
}
