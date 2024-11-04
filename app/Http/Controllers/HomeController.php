<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
{
    // Récupérer la requête de recherche
    $search = $request->input('search');

    // Rechercher les produits par nom si un mot clé est saisi
    if ($search) {
        $products = Product::where('name', 'like', '%' . $search . '%')->paginate(10);
    } else {
        $products = Product::paginate(10);
    }

    return view('home', compact('products', 'search'));
}

}
