<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-slate-900 leading-tight">
                KiloMeter – Katalog Sepatu
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Jelajahi berbagai koleksi sepatu dari berbagai toko di KiloMeter.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Alert sukses --}}
        @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
        @endif


        {{-- Filter Kategori --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 class="text-sm font-semibold text-slate-800">
                        Filter berdasarkan kategori
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">
                        Pilih kategori untuk menampilkan produk sesuai minatmu.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    {{-- Tombol "Semua" --}}
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium border 
                       {{ !$activeCategorySlug ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}">
                        Semua
                    </a>

                    @foreach ($categories as $category)
                    <a href="{{ route('home', ['category' => $category->slug]) }}"
                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium border 
                           {{ $activeCategorySlug === $category->slug ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Daftar Produk --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-5">
            @if ($products->isEmpty())
            <div class="py-10 text-center text-sm text-slate-500">
                Belum ada produk yang tersedia untuk kategori ini.
            </div>
            @else
            <div class="grid gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                <div class="group border border-slate-100 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md transition flex flex-col">
                    {{-- Gambar Produk --}}
                    @php
                    // SESUAIKAN nama kolom di tabel product_images (contoh: 'image' atau 'path')
                    $firstImage = optional($product->productImages->first())->image;
                    @endphp

                    <a href="{{ route('products.show', $product) }}" class="block">
                        @if ($firstImage)
                        <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ asset('storage/' . $firstImage) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        @else
                        <div class="aspect-[4/3] flex items-center justify-center bg-slate-100 text-xs text-slate-400">
                            Tidak ada gambar
                        </div>
                        @endif

                        <div class="p-4 space-y-2">
                            {{-- Nama Produk --}}
                            <h3 class="text-sm font-semibold text-slate-900 line-clamp-2 group-hover:text-emerald-600">
                                {{ $product->name }}
                            </h3>

                            {{-- Nama Toko & Kategori --}}
                            <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                @if ($product->store)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-50 border border-slate-100">
                                    {{ $product->store->name }}
                                </span>
                                @endif

                            </div>

                            @if ($product->productCategory)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700">
                                {{ $product->productCategory->name }}
                            </span>
                            @endif
                        </div>

                        <div class="pt-1 flex items-center justify-between gap-2">
                            {{-- Harga --}}
                            <p class="text-sm font-bold text-emerald-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </a>

                    <div class="px-4 pb-4 mt-auto">
                        <div class="flex items-center justify-between gap-2">

                            @guest
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-900 text-white hover:bg-slate-800">
                                Login untuk checkout
                            </a>
                            @endguest

                            @auth
                            {{-- TOMBOL ADD TO CART (ikon → extend teks) --}}
                            <form method="POST" action="{{ route('cart.add', $product) }}">
                                @csrf
                                <button type="submit"
                                    class="group inline-flex items-center rounded-full bg-slate-900 text-white px-2 py-1.5 hover:bg-slate-800 transition-all duration-200">

                                    {{-- Icon keranjang --}}
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 2.25h1.386c.51 0 .955.343 1.087.835L5.91 8.25m0 0h12.24m-12.24 0l1.318 5.272c.132.492.577.835 1.087.835h7.67c.51 0 .955-.343 1.087-.835L18.75 8.25m-1.44 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-8.31 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    </svg>

                                    {{-- Teks yang muncul saat hover --}}
                                    <span
                                        class="ml-0 max-w-0 overflow-hidden whitespace-nowrap text-[10px] font-semibold transition-all duration-200 group-hover:ml-2 group-hover:max-w-[80px]">
                                        Add to cart
                                    </span>
                                </button>
                            </form>

                            {{-- TOMBOL CHECKOUT (ikon → extend teks) --}}
                            <a href="{{ route('checkout.start', $product) }}"
                                class="group inline-flex items-center rounded-full bg-emerald-500 text-white px-2 py-1.5 hover:bg-emerald-600 transition-all duration-200">

                                {{-- Icon checkout (panah kanan) --}}
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 12h15m0 0l-4.5-4.5M19.5 12l-4.5 4.5" />
                                </svg>

                                {{-- Teks yang muncul saat hover --}}
                                <span
                                    class="ml-0 max-w-0 overflow-hidden whitespace-nowrap text-[10px] font-semibold transition-all duration-200 group-hover:ml-2 group-hover:max-w-[80px]">
                                    Checkout
                                </span>
                            </a>
                            @endauth

                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>