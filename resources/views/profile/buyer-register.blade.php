<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        <h1 class="text-2xl font-bold mb-1">Lengkapi Profil Pembeli Anda</h1>
        <p>Masukkan detail Anda untuk mempermudah proses transaksi dan pengiriman.</p>
    </div>

    <form method="POST" action="{{ route('buyer.register.submit') }}">
        @csrf

        <div>
            <x-input-label for="phone_number" :value="__('Nomor Telepon')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="ms-4">
                {{ __('Selesaikan Pendaftaran Pembeli') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>