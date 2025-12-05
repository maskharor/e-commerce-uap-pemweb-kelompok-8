<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $sellerUser = User::create([
            'name' => 'Seller Unverified Manual',
            'email' => 'seller.manual@example.com',
            'password' => Hash::make('password'),
            'role' => 'member', 
        ]);

        $sellerUser->store()->create([
            'name' => 'Toko ABC Belum Verif',
            'logo' => 'default_logo.png',
            'about' => 'Deskripsi singkat tentang toko yang menunggu verifikasi admin.',
            'phone' => '08111222333',
            'address_id' => '12345',
            'city' => 'Bandung',
            'address' => 'Jalan Kebon Jeruk No 15',
            'postal_code' => '40111',
            'is_verified' => false, 
        ]);
        
        User::create([
            'name' => 'Admin Owner',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin', 
        ]);
    }
}