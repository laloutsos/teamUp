<x-layout>
    <div class="min-h-[85vh] flex items-center justify-center px-4 py-8">
        <!-- Main Card Container -->
        <div
            class="bg-white dark:bg-gray-800/90 border border-gray-100 dark:border-gray-700/60 rounded-2xl shadow-xl dark:shadow-2xl dark:shadow-black/40 w-full max-w-sm sm:max-w-md p-6 sm:p-8 space-y-6 backdrop-blur-sm transition-colors">

            <!-- Header Section -->
            <div class="text-center space-y-2">
                <!-- App Icon / Logo Placeholder -->
                <div
                    class="w-12 h-12 bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 rounded-2xl mx-auto flex items-center justify-center shadow-md text-white text-xl">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </div>

                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">Welcome Back</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Log in to manage your matches and team</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.authenticate') }}" class="space-y-4">
                @csrf

                <!-- Email Field -->
                <x-inputs.text id="email" name="email" type="email" placeholder="Email Address"
                    icon="fa-regular fa-envelope" />

                <!-- Password Field -->
                <x-inputs.text id="password" name="password" type="password" placeholder="Password"
                    icon="fa-solid fa-lock" />

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 active:scale-[0.98] text-white text-sm font-semibold rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 mt-2">
                    <span>Log In</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Footer Link -->
            <div
                class="pt-4 border-t border-gray-100 dark:border-gray-700/50 text-center text-xs text-gray-500 dark:text-gray-400">
                Don't have an account?
                <a class="font-semibold text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 ml-1 transition-colors"
                    href="{{ route('register') }}">
                    Register
                </a>
            </div>

        </div>
    </div>
</x-layout>
