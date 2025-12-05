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

                <!-- Password -->
                <div class="mb-4">
                    <label class="font-medium">Password</label>
                    <input type="password" name="password"
                        class="w-full border rounded-lg px-4 py-2 mt-1"
                        required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border rounded-lg px-4 py-2 mt-1"
                        required>
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