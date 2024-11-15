<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Assurez-vous d'importer votre modèle de produit
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
class ajouterController extends Controller
{
    public function index()
    {
       $prds = Product::all(); // Doit renvoyer une collection d'objets Product
       $categories = Category::all();
    //    dd($prds);
       return view('listeProduits', ['prds' => $prds]);
    }
    public function create()
    {
        // Récupérer toutes les catégories depuis la base de données
        $categories = Category::all();
        
        // Retourner la vue avec les catégories
        return view('ajouterProduit', ['categories' => $categories]);
    }
    


    // Méthode pour ajouter un produit
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
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try{
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
        $product->category = $validatedData['category'];
        $product->description = $validatedData['description'];

        $product->save();

        
        return view('home')->with('success', 'Produit ajouté avec succès !');
        
        }catch (\Exception $e) {
            
            return view('home')->with('error', 'Une erreur est survenue lors de l\'ajout du produit. Veuillez réessayer.');
        }
    }
}