<x-guest-layout>
    <div class="flex min-h-screen">

        <!-- Bagian kiri ilustrasi -->
        <div class="w-1/2 bg-[#FFFFFF] flex items-center justify-center">
            <img src="{{ asset('IllustrationForgot-Pass.svg') }}" alt="Illustration" class="w-3/4">
        </div>

        <!-- Bagian kanan form -->
        <div class="w-1/2 flex flex-col justify-center px-20 relative">

            <!-- Logo kanan atas -->
            <div class="absolute top-6 right-6">
                <img src="{{ asset('LogoProjectKiloMeter.png') }}" class="w-20" />
            </div>

            <!-- Title & Description -->
            <h1 class="text-4xl font-bold mb-2">Forgot Password</h1>
            <p class="text-gray-600 mb-6">
                Enter your email address and we will send you a link to reset your password.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label class="font-medium">Email Address</label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full border rounded-lg px-4 py-2 mt-1"
                        required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <button
                    class="bg-black text-white w-full py-3 rounded-lg font-semibold hover:bg-gray-900">
                    Send Reset Link
                </button>
            </form>

            <!-- Back to Login -->
            <div class="mt-6 text-center">
                <p class="text-gray-700 text-sm">
                    Remember your password?
                    <a href="{{ route('login') }}" class="font-semibold text-black hover:underline">
                        Log in here
                    </a>
                </p>
            </div>

        </div>

    </div>
</x-guest-layout>
