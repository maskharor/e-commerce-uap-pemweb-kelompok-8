<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Homepage / dashboard untuk guest & user: daftar produk + filter kategori
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk filter
        $categories = ProductCategory::orderBy('name')->get();

        $productsQuery = Product::with(['store', 'productImages', 'productCategory']);

        // Filter kategori pakai slug di query string: ?category=slug-kategori
        $activeCategorySlug = $request->query('category');

        if ($activeCategorySlug) {
            $productsQuery->whereHas('productCategory', function ($q) use ($activeCategorySlug) {
                $q->where('slug', $activeCategorySlug);
            });
        }

        // Bisa ditambah order sesuai kebutuhan (created_at terbaru dulu)
        $products = $productsQuery->latest()->paginate(12)->withQueryString();

        return view('products.index', [
            'categories'        => $categories,
            'products'          => $products,
            'activeCategorySlug'=> $activeCategorySlug,
        ]);
    }

    /**
     * Nanti untuk detail produk (guest juga boleh akses).
     * Untuk sekarang bisa di-skip, atau biarkan dulu stub.
     */
    public function show(Product $product)
    {
        $product->load(['store', 'productImages', 'productCategory']);

        return view('products.show', compact('product'));
    }
}
