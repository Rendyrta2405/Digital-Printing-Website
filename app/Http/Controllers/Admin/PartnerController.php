<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Partner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.partners.index', [
           'partners' => Partner::latest()->paginate(10),
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
        Partner::create($this->validatedData($request));

       return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan!');
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
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
           'image' => ['nullable', 'image', 'max:2048'],
           'name' => ['nullable', 'string', 'max:100'],
        ]);

       
      if ($request->hasFile('image')) {
         $this->deleteOldImage($partner);
         $data['image'] = $request->file('image')->store('partners', 'public');
      }
       
        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $this->deleteOldImage($partner);
       
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus!');
    }

   private function validatedData(Request $request, ?Partner $partner = null): array
   {
      $data = $request->validate([
           'image' => ['required', 'image', 'max:2048'],
           'name' => ['required', 'string', 'max:100'],
        ]);

      if ($request->hasFile('image')) {
         $this->deleteOldImage($partner);
         $data['image'] = $request->file('image')->store('partners', 'public');
      }

      return $data;
   }

   private function deleteOldImage(?Partner $partner): void
   {
      if ($partner?->image && str_starts_with($partner->image, 'partners/')) {
         Storage::disk('public')->delete($partner->image);
      }
   }
}
