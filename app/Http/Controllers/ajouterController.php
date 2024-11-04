<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Assurez-vous d'importer votre modèle de produit
use Illuminate\Support\Facades\Storage;

class ajouterController extends Controller
{
    public function index()
    {
       $prds = Product::all(); // Doit renvoyer une collection d'objets Product
       dd($prds);
       return view('listeProduits', ['prds' => $prds]);
    }
public function create()
    {
        return view('ajouterProduit');
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

        // Enregistrement dans la base de données
        $product->save();

        // Redirection ou réponse après l'ajout
        return view('listeProduits')->with('success', 'Produit ajouté avec succès !');
    }
}