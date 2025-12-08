<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // Nanti diisi logic keranjang.
        // Untuk sekarang, tes dulu:
        return back()->with('success', 'Produk "'.$product->name.'" ditambahkan ke keranjang (dummy).');
    }
}