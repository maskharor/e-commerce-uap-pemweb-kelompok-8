<x-guest-layout>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-xl mx-auto">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Lengkapi Profil Toko') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Masukkan detail toko Anda. Pastikan data ID Alamat valid.') }}
                </p>
            </header>

            <form method="POST" action="{{ route('store.register.submit') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Nama Toko')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="logo" :value="__('Logo Toko (Opsional)')" />
                    <input id="logo" name="logo" type="file"
                        class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white focus:outline-none"
                    />
                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="about" :value="__('Deskripsi Singkat Toko')" />
                    <textarea id="about" name="about" rows="3"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    >{{ old('about') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('about')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Nomor Telepon Toko')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="address_id" :value="__('ID Alamat (Sistem/Sementara)')" />
                    {{-- Dibuat sebagai input text biasa. Ubah type='hidden' jika ingin disembunyikan. --}}
                    <x-text-input id="address_id" name="address_id" type="number" class="block mt-1 w-full" :value="old('address_id')" required />
                    <x-input-error :messages="$errors->get('address_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="address" :value="__('Alamat Lengkap Toko')" />
                    <textarea id="address" name="address" rows="3"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        required>{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="city" :value="__('Kota')" />
                    <x-text-input id="city" name="city" type="text" class="block mt-1 w-full" :value="old('city')" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="postal_code" :value="__('Kode Pos')" />
                    <x-text-input id="postal_code" name="postal_code" type="text" class="block mt-1 w-full" :value="old('postal_code')" />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="ms-4">
                        {{ __('Selesaikan Pendaftaran Toko') }}
                    </x-primary-button>
                </div>
            </form>
        </section>
    </div>
</x-guest-layout>