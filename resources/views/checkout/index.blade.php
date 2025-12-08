<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <p class="mb-4 text-sm text-slate-600">
            Ini halaman checkout dummy. Nanti bisa kamu isi form alamat, metode pembayaran, dll.
        </p>

        <p class="font-semibold text-slate-900">
            Produk: {{ $product->name }}
        </p>
        <p class="text-emerald-600 font-bold">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>
    </div>
</x-app-layout>
