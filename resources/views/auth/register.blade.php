<x-layout>
    <div class="min-h-[85vh] flex items-center justify-center px-4 py-8">
        <!-- Main Card Container -->
        <div
            class="bg-white border border-gray-200 rounded-2xl shadow-xl w-full max-w-sm sm:max-w-md p-6 sm:p-8 space-y-6">

            <!-- Header Section -->
            <div class="text-center space-y-2">
                <!-- App Icon / Logo Placeholder -->
                <div
                    class="w-12 h-12 bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 rounded-2xl mx-auto flex items-center justify-center shadow-md text-white text-xl">
                    <i class="fa-solid fa-user-plus"></i>
                </div>

                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Create Account</h2>
                <p class="text-xs text-gray-500">Sign up to join matches and build your team</p>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf

                <!-- Name Field -->
                <x-inputs.text id="name" name="name" type="text" placeholder="Full Name"
                    icon="fa-regular fa-user" />

                <!-- Email Field -->
                <x-inputs.text id="email" name="email" type="email" placeholder="Email Address"
                    icon="fa-regular fa-envelope" />

                <!-- Password Field -->
                <x-inputs.text id="password" name="password" type="password" placeholder="Password"
                    icon="fa-solid fa-lock" />

                <!-- Password Confirmation Field -->
                <x-inputs.text id="password_confirmation" name="password_confirmation" type="password"
                    placeholder="Confirm Password" icon="fa-solid fa-shield-halved" />

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 bg-sky-500 hover:bg-sky-600 active:scale-[0.98] text-white text-sm font-semibold rounded-xl shadow-md transition-all flex items-center justify-center gap-2 mt-2">
                    <span>Register</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Footer Link -->
            <div class="pt-4 border-t border-gray-100 text-center text-xs text-gray-500">
                Already have an account?
                <a class="font-semibold text-sky-600 hover:text-sky-700 ml-1 transition-colors"
                    href="{{ route('login') }}">
                    Log In
                </a>
            </div>

        </div>
    </div>
</x-layout>
