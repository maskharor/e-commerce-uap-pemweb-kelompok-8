<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengguna: ' . $user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-bold mb-4 border-b pb-2">{{ __('Data Akun') }}</h3>

                    <div>
                        <x-input-label for="name" :value="__('Nama')" />
                        <x-text-input 
                            id="name" 
                            class="block mt-1 w-full" 
                            type="text" 
                            name="name" 
                            :value="old('name', $user->name)" 
                            required 
                            autofocus 
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input 
                            id="email" 
                            class="block mt-1 w-full" 
                            type="email" 
                            name="email" 
                            :value="old('email', $user->email)" 
                            required 
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Role')" />
                        <select 
                            id="role" 
                            name="role" 
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" 
                            required
                        >
                            <option value="member" {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('role')" />
                    </div>
                    
                    
                    @if ($user->store)
                        <div class="mt-6 pt-4 border-t">
                            <h3 class="text-lg font-bold mb-4 border-b pb-2">{{ __('Informasi Toko Terkait') }}</h3>

                            <div class="p-4 bg-gray-50 border rounded-md">
                                <p class="mb-2">Nama Toko: **{{ $user->store->name }}**</p>
                                
                                <p class="mb-2">Status Verifikasi: 
                                    @if ($user->store->is_verified)
                                        <span class="p-1 text-xs font-semibold rounded-md bg-green-100 text-green-800">Verified</span>
                                    @else
                                        <span class="p-1 text-xs font-semibold rounded-md bg-red-100 text-red-800">Unverified</span>
                                    @endif
                                </p>
                                
                                <p class="text-sm text-gray-600">Alamat: {{ $user->store->address }}, {{ $user->store->city }}</p>

                                @if (!$user->store->is_verified)
                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('admin.stores.verify', $user->store) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-sm bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded">
                                                Verifikasi Sekarang
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="mt-6 p-4 bg-gray-50 border rounded-md">
                            <p class="text-gray-600">Pengguna ini belum memiliki toko.</p>
                        </div>
                    @endif


                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.users-stores.index') }}" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 **mr-4**">
                            {{ __('Batal') }}
                        </a>
                        
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>