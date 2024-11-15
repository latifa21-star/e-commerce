<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_value' => Product::all()->sum(function($product) {
                return $product->price * $product->stock;
            }),
            'average_price' => Product::avg('price'),
        ];

        // Produits les plus chers
        $expensive_products = Product::orderBy('price', 'desc')
                                    ->take(5)
                                    ->get();

        // Produits par catégorie
        $products_by_category = Category::withCount('products')
                                       ->orderBy('products_count', 'desc')
                                       ->get();

        // Derniers produits ajoutés
        $recent_products = Product::with('category')
                                 ->latest()
                                 ->take(5)
                                 ->get();

        // Derniers utilisateurs inscrits
        $recent_users = User::latest()
                           ->take(5)
                           ->get();

        
        return view('dashboard.index', [
            'stats' => $stats,
            'expensive_products' => $expensive_products,
            'products_by_category' => $products_by_category,
            'recent_products' => $recent_products,
            'recent_users' => $recent_users,
            
        ]);
    }

    // Méthode pour les statistiques détaillées des produits
    public function productStats()
    {
        $categories_stats = Category::withCount('products')
                                   ->withSum('products', 'price')
                                   ->get();

        return view('dashboard.product-stats', compact('categories_stats'));
    }

    // Méthode pour gérer les catégories
    public function categories()
    {
        $categories = Category::withCount('products')
                             ->paginate(10);
        return view('dashboard.categories', compact('categories'));
    }

    // Méthode pour gérer les produits
    public function products()
    {
        $products = Product::with('category')
                           ->latest()
                           ->paginate(10);
        return view('dashboard.products', compact('products'));
    }

    // Méthode pour gérer les utilisateurs
    public function users()
    {
        $users = User::latest()
                     ->paginate(10);
        return view('dashboard.users', compact('users'));
    }
}