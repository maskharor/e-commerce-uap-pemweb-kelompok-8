<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 1. Cek apakah user sudah login
        if (!$user) {
            // Arahkan ke halaman login jika belum login
            return redirect()->route('login'); 
        }

        // 2. Cek apakah role user adalah 'store'
        if ($user->role !== 'store') {
            abort(403, 'Akses ditolak. Anda bukan penjual.');
        }

        // 3. Cek apakah user memiliki data store yang terverifikasi
        // Relasi 'store' harus sudah ada di Model User
        if (!$user->store || !$user->store->is_verified) {
            // Jika belum terverifikasi, arahkan ke halaman informasi/registrasi toko
            // Ganti 'seller.unverified' dengan nama rute yang sesuai
            return redirect()->route('seller.unverified')->with('error', 'Toko Anda belum terverifikasi atau belum didaftarkan.');
        }

        return $next($request);
    }
}
