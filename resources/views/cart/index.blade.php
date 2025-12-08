<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-slate-900 leading-tight">
                Keranjang Belanja
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Review produk yang ingin kamu beli sebelum melanjutkan ke checkout.
            </p>
        </div>
    </x-slot>

    <div class="space-y-4">

        @if (session('success'))
            <div class="rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-5">
            @if ($items->isEmpty())
                <div class="py-10 text-center text-sm text-slate-500">
                    Keranjangmu masih kosong.  
                    <a href="{{ route('home') }}" class="text-emerald-600 font-semibold hover:text-emerald-700">
                        Belanja sepatu sekarang
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($items as $item)
                        @php
                            $product = $item['product'];
                            $qty = $item['qty'];
                            $subtotal = $item['subtotal'];
                            $firstImage = optional($product->productImages->first())->image;
                        @endphp

                        <div class="flex gap-4 border border-slate-100 rounded-xl p-3 sm:p-4">
                            {{-- Gambar --}}
                            <div class="w-24 h-24 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0">
                                @if ($firstImage)
                                    <img src="{{ asset('storage/' . $firstImage) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-xs text-slate-400">
                                        Tidak ada gambar
                                    </div>
                                @endif
                            </div>

                            {{-- Info produk --}}
                            <div class="flex-1 space-y-1">
                                <h3 class="text-sm font-semibold text-slate-900">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-xs text-slate-500">
                                    {{ $product->store->name ?? 'Toko tidak diketahui' }}
                                </p>

                                <p class="text-sm font-semibold text-emerald-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                    <span class="text-xs text-slate-500">× {{ $qty }}</span>
                                </p>

                                <p class="text-xs text-slate-500">
                                    Subtotal:
                                    <span class="font-semibold text-slate-900">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </span>
                                </p>
                            </div>

                            {{-- Aksi --}}
                            <div class="flex flex-col justify-between items-end text-xs">
                                <form method="POST" action="{{ route('cart.remove', $product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-2 py-1 rounded-full bg-red-50 text-red-600 hover:bg-red-100 font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-t border-slate-100 pt-4">
                    <div>
                        <p class="text-sm text-slate-600">
                            Total:
                            <span class="text-lg font-bold text-emerald-600">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2 justify-end">
                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">
                                Kosongkan Keranjang
                            </button>
                        </form>

                        {{-- Nanti bisa diarahkan ke checkout cart, untuk sekarang link ke halaman produk saja --}}
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-emerald-500 text-white hover:bg-emerald-600">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
