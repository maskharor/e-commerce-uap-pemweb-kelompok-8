<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Store; 
use App\Models\Buyer; 

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // ----------------------------------------------------------------------------------
    // 1. REGISTRASI STORE (SELLER)
    // ----------------------------------------------------------------------------------
    
    public function storeRegisterForm(Request $request): View | RedirectResponse
    {
        $user = $request->user();

        // UBAH: Cek role 'seller' menjadi 'store'
        if ($user->role !== 'store' || $user->store()->exists()) { 
            return Redirect::route('dashboard')->with('error', 'Profil toko sudah lengkap atau peran tidak sesuai.');
        }

        return view('profile.store-register', [
            'user' => $user,
        ]);
    }

    /**
     * Simpan data Store.
     */
    public function storeRegisterSubmit(Request $request): RedirectResponse
    {
        $user = $request->user();

        // UBAH: Cek role 'seller' menjadi 'store'
        if ($user->role !== 'store' || $user->store()->exists()) {
            return Redirect::route('dashboard')->with('error', 'Akses ditolak.');
        }

        // 1. Validasi (TIDAK ADA PERUBAHAN)
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.Store::class.',name'], 
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], 
            'about' => ['nullable', 'string', 'max:500'], 
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:10'],
        ]);

        $logoPath = null;
        
        // Logika Upload Logo
        if ($request->hasFile('logo')) {
            // Simpan file di storage/app/public/logos (sesuaikan jika perlu)
            $logoPath = $request->file('logo')->store('logos', 'public'); 
        }

        // 2. Simpan data Store dengan field baru
        Store::create([
            'user_id' => $user->id,
            'name' => $request->name, // Menggunakan 'name'
            'logo' => $logoPath, // Menyimpan path logo
            'about' => $request->about, // Menyimpan deskripsi
            'phone' => $request->phone,
            'address_id' => $request->address_id,
            'city' => $request->city,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'is_verified' => false,
        ]);
        
        return Redirect::route('dashboard')->with('success', 'Pendaftaran toko berhasil! Menunggu verifikasi.');
    }
    
    // ----------------------------------------------------------------------------------
    // 2. REGISTRASI BUYER (CUSTOMER)
    // ----------------------------------------------------------------------------------

    /**
     * Tampilkan form registrasi Buyer.
     */
    public function buyerRegisterForm(Request $request): View | RedirectResponse
    {
        $user = $request->user();

        // UBAH: Cek role 'buyer' menjadi 'member'
        if ($user->role !== 'member' || $user->buyer()->exists()) {
            return Redirect::route('dashboard')->with('error', 'Profil pembeli sudah lengkap atau peran tidak sesuai.');
        }

        return view('profile.buyer-register', [
            'user' => $user,
        ]);
    }

    /**
     * Simpan data Buyer.
     */
    public function buyerRegisterSubmit(Request $request): RedirectResponse
    {
        $user = $request->user();

        // UBAH: Cek role 'buyer' menjadi 'member'
        if ($user->role !== 'member' || $user->buyer()->exists()) {
            return Redirect::route('dashboard')->with('error', 'Akses ditolak.');
        }

        // 1. Validasi (TIDAK ADA PERUBAHAN)
        $request->validate([
            'phone_number' => ['required', 'string', 'max:15', 'unique:'.Buyer::class.',phone_number'],
            // 'profile_picture' => ['nullable', 'image', 'max:2048'], // Jika ada upload
        ]);

        // 2. Simpan data Buyer (TIDAK ADA PERUBAHAN)
        Buyer::create([
            'user_id' => $user->id,
            'phone_number' => $request->phone_number,
        ]);

        return Redirect::route('dashboard')->with('success', 'Pendaftaran profil pembeli berhasil!');
    }
}
