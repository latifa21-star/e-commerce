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
    
    $search = $request->input('search');

    
    if ($search) {
        $products = Product::where('name', 'like', '%' . $search . '%')->paginate(12);
    } else {
        $products = Product::paginate(12);
    }

    return view('home', compact('products', 'search'));
}

}
