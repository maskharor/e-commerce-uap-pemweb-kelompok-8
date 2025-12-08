<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-slate-900 leading-tight">
                KiloMeter – Katalog Sepatu
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Jelajahi berbagai koleksi sepatu dari berbagai toko di KiloMeter. 
                Kamu bisa melihat detail produk, tapi untuk checkout harus login dulu.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

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
                        <div class="group border border-slate-100 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                            {{-- Gambar Produk --}}
                            @php
                                // SESUAIKAN nama kolom di tabel product_images (contoh: 'image' atau 'path')
                                $firstImage = optional($product->productImages->first())->image;
                            @endphp

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
                                <h3 class="text-sm font-semibold text-slate-900 line-clamp-2">
                                    {{ $product->name }}
                                </h3>

                                {{-- Nama Toko & Kategori --}}
                                <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                    @if ($product->store)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-50 border border-slate-100">
                                            {{ $product->store->name }}
                                        </span>
                                    @endif

                                    @if ($product->productCategory)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700">
                                            {{ $product->productCategory->name }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Harga --}}
                                <p class="text-sm font-bold text-emerald-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                {{-- Tombol Aksi (sementara belum ada checkout) --}}
                                <div class="pt-1 flex items-center justify-between">
                                    {{-- Nanti ini bisa diarahkan ke detail produk --}}
                                    {{-- Untuk sekarang, cukup disabled / placeholder --}}
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-900 text-white opacity-70 cursor-not-allowed"
                                        title="Login terlebih dahulu untuk checkout">
                                        Checkout (Login dulu)
                                    </button>
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