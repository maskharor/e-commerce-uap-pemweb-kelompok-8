<x-guest-layout>
    <div class="flex min-h-screen">

        <!-- Bagian kiri ilustrasi -->
        <div class="w-1/2 bg-[#FFFFFF] flex items-center justify-center">
            <img src="{{ asset('IllustrationLogin.svg') }}" alt="Illustration" class="w-3/4">
        </div>


        <!-- Bagian kanan register form -->
        <div class="w-1/2 flex flex-col justify-center px-20">

            <!-- Logo di kanan atas -->
            <div class="absolute top-6 right-6">
                <img src="{{ asset('LogoProjectKiloMeter.svg') }}" class="w-20" />
            </div>

            <h1 class="text-4xl font-bold mb-2">Create Your Account</h1>
            <p class="text-gray-600 mb-8">Register to continue shopping with KiloMeter.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div class="mb-4">
                    <label class="font-medium">Full Name</label>
                    <input type="text" name="name"
                        class="w-full border rounded-lg px-4 py-2 mt-1"
                        required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="font-medium">Email Address</label>
                    <input type="email" name="email"
                        class="w-full border rounded-lg px-4 py-2 mt-1"
                        required>
                </div>

                <div class="mb-4" x-data="{ show: false }">
                    <label class="font-medium" for="password">Password</label>
                    <div class="relative mt-1">
                        <input :type="show ? 'text' : 'password'" name="password" id="password"
                            class="w-full border rounded-lg px-4 py-2 pr-10 @error('password') border-red-500 @enderror"
                            required autocomplete="new-password">
                        
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                              @click="show = !show">
                            <svg x-show="!show" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.082-2.31 3 3 0 01.325.325M12 5c4.477 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.875 3.825" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1112 12a3 3 0 01-2.121 4.121z" />
                            </svg>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-6" x-data="{ show: false }">
                    <label class="font-medium" for="password_confirmation">Confirm Password</label>
                    <div class="relative mt-1">
                        <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation"
                            class="w-full border rounded-lg px-4 py-2 pr-10"
                            required autocomplete="new-password">
                        
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                              @click="show = !show">
                            <svg x-show="!show" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.082-2.31 3 3 0 01.325.325M12 5c4.477 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.875 3.825" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1112 12a3 3 0 01-2.121 4.121z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="font-bold block mb-2">Daftar Sebagai:</label>
                    <div class="flex space-x-6">
                        
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="role" value="member" 
                                class="form-radio text-black h-4 w-4 transition duration-150 ease-in-out"
                                {{ old('role', 'member') == 'member' ? 'checked' : '' }} required>
                            <span class="ml-2 text-gray-700 font-medium">customer</span>
                        </label>
                        
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="role" value="store" 
                                class="form-radio text-black h-4 w-4 transition duration-150 ease-in-out"
                                {{ old('role') == 'store' ? 'checked' : '' }} required>
                            <span class="ml-2 text-gray-700 font-medium">seller</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
                
                <button
                    class="bg-black text-white w-full py-3 rounded-lg font-semibold hover:bg-gray-900">
                    Register
                </button>

            </form>

            <!-- Link ke Login -->
            <div class="mt-6 text-center">
                <p class="text-gray-700 text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-black hover:underline">
                        Log in here
                    </a>
                </p>
            </div>

        </div>

    </div>
</x-guest-layout>