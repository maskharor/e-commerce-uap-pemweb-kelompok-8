<x-guest-layout>

    <div class="flex min-h-screen">

        <!-- Bagian kiri ilustrasi -->
        <div class="w-1/2 bg-[#FFFFFF] flex items-center justify-center">
            <img src="{{ asset('IllustrationLogin.svg') }}" alt="Illustration" class="w-3/4">
        </div>

        <!-- Bagian kanan login form -->
        <div class="w-1/2 flex flex-col justify-center px-20 relative">

            <!-- Logo di kanan atas -->
            <div class="absolute top-6 right-6">
                <img src="{{ asset('LogoProjectKiloMeter.svg') }}" class="w-20" />
            </div>

            <h1 class="text-4xl font-bold mb-2">Welcome Back</h1>
            <p class="text-gray-600 mb-8">Log in to continue shopping with KiloMeter.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label class="font-medium">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded-lg px-4 py-2 mt-1"
                        required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="font-medium">Password</label>
                    <input type="password" name="password"
                        class="w-full border rounded-lg px-4 py-2 mt-1"
                        required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input type="checkbox" name="remember" id="remember_me"
                        class="rounded border-gray-300 text-black shadow-sm focus:ring-black">
                    <label for="remember_me" class="ml-2 text-gray-700 text-sm">Remember me</label>
                </div>

                <div class="flex justify-between items-center mb-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-black"
                           href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <button
                    class="bg-black text-white w-full py-3 rounded-lg font-semibold hover:bg-gray-900">
                    Log in
                </button>

            </form>

            <!-- Link untuk Register -->
            <div class="mt-6 text-center">
                <p class="text-gray-700 text-sm">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-semibold text-black hover:underline">
                        Create one here
                    </a>
                </p>
            </div>

        </div>

    </div>

</x-guest-layout>