<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CheckoutController extends Controller
{
    public function start(Product $product)
    {
        // Nanti diisi halaman checkout beneran.
        // Untuk sekarang, tampilkan placeholder.
        return view('checkout.index', compact('product'));
    }
}