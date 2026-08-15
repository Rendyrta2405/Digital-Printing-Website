<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.index', [
           'settings' => Setting::all(),
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
        //
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
    public function edit()
    {
        return view('admin.settings.edit', [
           'settings' => Setting::all()->pluck('value', 'key'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
           'site_name' => ['required', 'string', 'max:100'],
           'tagline' => ['nullable', 'string', 'max:255'],
           'whatsapp_number' => ['required', 'string', 'max:20'],
           'email' => ['nullable', 'email'],
           'address' => ['required', 'string'],
           'maps_query' => ['nullable', 'string'],
           'opening_hours' => ['nullable', 'string'],
           'about_text' => ['nullable', 'string'],
           'title' => ['required', 'string', 'max:255'],
           'description' => ['required', 'string'],
           'instagram_usn' => ['nullable', 'string'],
           'tiktok_usn' => ['nullable', 'string'],
           'facebook_usn' => ['nullable', 'string'],
           'twitter_usn' => ['nullable', 'string'],
           'youtube_handle' => ['nullable', 'string'],
           'about_img' => ['nullable', 'image', 'max:2048'],
       ]);

       if ($request->hasFile('about_img')) {
           $this->deleteOldImage($setting);
           $data['about_img'] = $request->file('about_img')->store('settings', 'public');
       }

       $setting->update($data);

       return back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

   private function deleteOldImage(?Setting $setting): void
   {
      if ($setting?->image && str_starts_with($setting->image, 'settings/')) {
         Storage::disk('public')->delete($setting->image);
      }
   }
}
