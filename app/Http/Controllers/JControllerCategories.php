<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class JControllerCategories extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $allCategories = Category::all(); 
    
        
        $products = [];
    
        
        foreach ($allCategories as $category) {
            
            $limitedProducts = $category->products()->limit(3)->get();
    
            
            if ($limitedProducts->count() > 0) {
                foreach ($limitedProducts as $product) {
                    $products[$category->id][] = $product; 
                }
            }
        }
    
        return view('welcome', compact('allCategories', 'products'));
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
    public function show($id)
{
    
    $category = Category::findOrFail($id);

   
    $products = Product::where('category_id', $category->id)->paginate(10);

    
    return view('categoryProducts', compact('products', 'category'));
}


public function findCategoryId(Request $request)
{
    $category = Category::where('name', $request->input('category_name'))->first();

    if ($category) {
        return response()->json(['id' => $category->id]);
    }

    return response()->json(['error' => 'Catégorie non trouvée'], 404);
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
