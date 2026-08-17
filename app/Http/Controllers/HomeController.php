<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\Facility;
use App\Models\Partner;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::where('is_active', true)
         ->orderBy('sort_order')
         ->get();
   
      $navbarCategories = $categories->where('show_in_navbar', true);
       
      $carouselItems = $navbarCategories
         ->whereNotNull('image');
   
      $featuredProducts = Product::where('is_active', true)
         ->where('is_featured', true)
         ->with('category')
         ->orderBy('sort_order')
         ->get();
   
      $customProducts = Product::where('is_active', true)
         ->whereHas('category', function ($query) {
            $query->where('slug', 'hadiah-custom');
         })
         ->orderBy('sort_order')
         ->get();
   
      $testimonials = Testimonial::where('is_approved', true)->orderBy('sort_order')
         ->get();

      $galleries = Gallery::latest()->paginate(10);
       
      $facilities = Facility::latest()->paginate(6);
       
      $partners = Partner::latest()->paginate(10);

      $productsCount = Product::count();
   
      return view('home', compact(
         'categories',
         'navbarCategories',
         'featuredProducts',
         'customProducts',
         'testimonials',
         'galleries',
         'productsCount',
         'facilities',
         'partners',
         'carouselItems',
      ));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
