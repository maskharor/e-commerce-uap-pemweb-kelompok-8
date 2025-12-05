<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhere('condition', 'like', "%{$query}%")
            ->get();

        return view('products.search-results', [
            'products' => $products,
            'query' => $query
        ]);
    }
}