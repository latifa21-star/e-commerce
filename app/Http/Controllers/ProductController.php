<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les produits
        $products = Product::paginate(12);
        
        // Retourner la vue avec les produits
        return view('home', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('ajouterProduit');
        $categories = Category::all();
    
    // Passer les catégories à la vue
    return view('ajouterProduit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'gender' => 'required|in:homme,femme,enfant',
            'sizes' => 'required|array',
            'sizes.*' => 'in:XS,S,M,L,XL',
            'category_id' => 'required',
            'stock' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        // Téléchargement de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Création d'un nouveau produit
        $product = new Product();
        $product->image = $imagePath;
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->gender = $validatedData['gender'];
        $product->sizes = json_encode($validatedData['sizes']);
        $product->category_id = $validatedData['category_id'];
        $product->stock = $validatedData['stock'];
        $product->description = $validatedData['description'];

        // Enregistrement dans la base de données
        $product->save();

        // Redirection ou réponse après l'ajout
        // Redirection après l'ajout du produit
    return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès !');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Récupérer le produit par son ID
    $product = Product::findOrFail($id);

    // Retourner une vue avec les détails du produit
    return view('show', compact('product'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Récupérer le produit par son ID
        $product = Product::findOrFail($id);
        $categories = Category::all();

    
        // Retourner une vue avec le formulaire de modification
        return view('edit', compact('product','categories'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'gender' => 'required|in:homme,femme,enfant',
            'sizes' => 'required|array',
            'sizes.*' => 'in:XS,S,M,L,XL',
            'category_id' => 'required',
            'description' => 'nullable|string',
        ]);
    
        // Récupérer le produit à modifier
        $product = Product::findOrFail($id);
    
        // Mise à jour des informations du produit
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si une nouvelle est téléchargée
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }
    
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->gender = $validatedData['gender'];
        $product->sizes = json_encode($validatedData['sizes']);
        $product->category_id = $validatedData['category_id'];
        $product->description = $validatedData['description'];

    
    
        // Enregistrer les modifications
        $product->save();
    
        // Redirection après la mise à jour avec un message de succès
        return redirect()->route('products.index')->with('success', 'Produit modifié avec succès !');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Récupérer le produit par son ID
    $product = Product::findOrFail($id);

    // Supprimer l'image associée si elle existe
    if ($product->image) {
        Storage::delete('public/' . $product->image);
    }

    // Supprimer le produit de la base de données
    $product->delete();

    // Redirection après la suppression avec un message de succès
    return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès !');
}

}
