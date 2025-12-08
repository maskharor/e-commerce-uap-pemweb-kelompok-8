<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-slate-900 leading-tight">
                Checkout Produk
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Review pesananmu sebelum konfirmasi checkout.
            </p>
        </div>
    </x-slot>

    <div class="max-w-3xl space-y-4">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6 flex gap-4">
            @php
                $firstImage = optional($product->productImages->first())->image;
            @endphp

            <div class="w-28 h-28 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                @if ($firstImage)
                    <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-xs text-slate-400">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            <div class="flex-1 space-y-1">
                <h3 class="text-lg font-semibold text-slate-900">
                    {{ $product->name }}
                </h3>
                <p class="text-sm text-slate-500">
                    Toko: {{ $product->store->name ?? 'Tidak diketahui' }}
                </p>
                @if ($product->productCategory)
                    <p class="text-xs text-emerald-600">
                        Kategori: {{ $product->productCategory->name }}
                    </p>
                @endif
                <p class="text-xl font-bold text-emerald-600 mt-2">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6 space-y-3 text-sm text-slate-700">
            <p>
                Ini masih halaman checkout dummy (belum ada pembayaran & alamat lengkap).  
                Berikutnya kamu bisa menambahkan:
            </p>
            <ul class="list-disc list-inside space-y-1 text-slate-600">
                <li>Form alamat pengiriman</li>
                <li>Opsi ekspedisi & ongkir</li>
                <li>Metode pembayaran</li>
            </ul>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('home') }}"
               class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">
                Kembali ke Katalog
            </a>

            <button type="button"
                    class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-emerald-500 text-white hover:bg-emerald-600">
                Konfirmasi (dummy)
            </button>
        </div>
    </div>
</x-app-layout>
