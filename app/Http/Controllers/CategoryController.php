<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('layouts.app', compact('categories'));
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
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
           ->with('products')
           ->firstOrFail();

        $products = $category->products->where('is_active', true);

        $tags = $products->pluck('tag')->unique()->filter()->values();

        // $products->pluck('tag') 
        // ambil kolom tag saja ["Promosi","Promosi","Event",null,...]
        //  ->unique()       // buang duplikat:      ["Promosi","Event",null,...]
        //  ->filter()       // buang null/kosong:   ["Promosi","Event",...]
        //  ->values();      // rapikan index:       [0=>"Promosi",1=>"Event",...]

        return view('category', compact('category', 'products', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
