<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CheckoutController extends Controller
{
    // Checkout untuk satu produk (dari tombol di kartu produk)
    public function start(Product $product)
    {
        $product->load(['store', 'productImages', 'productCategory']);

        return view('checkout.index', compact('product'));
    }
}
