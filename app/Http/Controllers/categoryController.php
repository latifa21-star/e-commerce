<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =Category::all();
        return view('ajouterProduit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $iconPath = $request->file('icon')->store('icons', 'public');


        // Créer une nouvelle catégorie
        Category::create([
            'name' => $request->input('name'),
            'icon' => $iconPath, // Stocke le chemin de l'icône
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès !');
    
    }

    /**
     * Display the specified resource.
     */
    public function showProducts($id)
{
    // Récupérer la catégorie par son ID
    $category = Category::findOrFail($id);

    // Récupérer les produits associés à cette catégorie
    $products = Product::where('category_id', $category->id)->paginate(10);

    // Retourner la vue avec les produits
    return view('products', compact('products', 'category'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    // Récupère la catégorie à modifier
    $category = Category::findOrFail($id);
    return response()->json($category); // Retourne les détails de la catégorie en format JSON
}

public function update(Request $request, string $id)
{
    // Valide les données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Récupère la catégorie à modifier
    $category = Category::findOrFail($id);
    
    // Met à jour le nom de la catégorie
    $category->name = $request->name;

    // Si une nouvelle icône est fournie, traite-la
    if ($request->hasFile('icon')) {
        // Supprime l'ancienne icône si nécessaire
        if ($category->icon) {
            Storage::delete($category->icon);
        }
        
        // Enregistre la nouvelle icône
        $category->icon = $request->file('icon')->store('icons'); // Enregistre dans le dossier 'icons'
    }

    // Sauvegarde les modifications
    $category->save();

    return redirect()->route('categories.index')->with('success', 'Catégorie modifiée avec succès.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouver la catégorie par son ID
        $category = Category::find($id);
    
        // Vérifier si la catégorie existe
        if (!$category) {
            return redirect()->back()->with('error', 'Catégorie non trouvée.');
        }
    
        // Supprimer la catégorie
        $category->delete();
    
        // Rediriger avec un message de succès
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
    
}
