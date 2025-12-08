<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Toko Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (Auth::user()->role === 'store')

                        {{-- ================================================= --}}
                        {{-- 🛑 KONDISI: STORE BELUM TERVERIFIKASI --}}
                        {{-- ================================================= --}}
                        @if (! Auth::user()->store->is_verified)
                            
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                                <p class="font-bold text-lg flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    {{ __('Toko Belum Diverifikasi') }}
                                </p>
                                <p class="mt-2">
                                    Terima kasih telah mendaftar! Akun toko Anda, **{{ Auth::user()->store->name }}**, saat ini sedang dalam proses peninjauan oleh tim Admin KiloMeter.
                                </p>
                                <p class="mt-2 text-sm italic">
                                    Anda akan menerima notifikasi setelah toko Anda diverifikasi. Selama proses ini, akses ke manajemen produk dan pesanan dibatasi.
                                </p>
                            </div>

                            <div class="mt-6 p-4 border rounded-lg bg-gray-50">
                                <h3 class="font-semibold text-gray-700">{{ __('Status Saat Ini') }}</h3>
                                <ul class="mt-2 list-disc list-inside text-sm text-gray-600">
                                    <li>**Nama Toko:** {{ Auth::user()->store->name }}</li>
                                    <li>**Nomor Telepon:** {{ Auth::user()->store->phone }}</li>
                                    <li>**Status:** <span class="text-yellow-600 font-bold">Menunggu Verifikasi</span></li>
                                </ul>
                            </div>
                        
                        {{-- ================================================= --}}
                        {{-- ✅ KONDISI: STORE SUDAH TERVERIFIKASI --}}
                        {{-- ================================================= --}}
                        @else
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                <p class="font-bold text-lg flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ __('Toko Anda Sudah Aktif!') }}
                                </p>
                                <p class="mt-2">
                                    Selamat datang, **{{ Auth::user()->store->name }}**! Toko Anda telah berhasil diverifikasi dan aktif.
                                </p>
                                <p class="mt-2 text-sm">
                                    Sekarang Anda dapat mulai mengelola produk dan pesanan Anda.
                                </p>
                            </div>
                            
                            {{-- Tampilkan Link Menu Utama --}}
                            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                                <a href="{{ route('admin.dashboard') }}" class="block p-6 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md text-center">
                                    <h3 class="text-xl font-bold">Kelola Produk</h3>
                                    <p class="mt-1 text-sm">Tambahkan, edit, dan hapus produk.</p>
                                </a>
                                {{-- Tambahkan link menu lain --}}
                            </div>
                        @endif

                    {{-- ================================================= --}}
                    {{-- 👤 KONDISI: AKUN CUSTOMER (MEMBER) --}}
                    {{-- ================================================= --}}
                    @else
                        {{-- Isi dashboard standar untuk Buyer/Customer --}}
                        <p>{{ __("Anda berhasil login!") }}</p>
                        <p class="mt-4">{{ __("Selamat datang di halaman Pembeli KiloMeter.") }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>