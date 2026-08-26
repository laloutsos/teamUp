<x-layout>
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css" rel="stylesheet" />

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css"
        type="text/css">

    <style>
        /* Custom styling to align Mapbox Geocoder input with Tailwind inputs */
        .mapboxgl-ctrl-geocoder {
            width: 100% !important;
            max-width: none !important;
            box-shadow: none !important;
            border: 1px solid #E5E7EB !important;
            border-radius: 0.75rem !important;
            background-color: #F9FAFB !important;
            font-family: inherit !important;
            transition: all 0.2s ease;
        }

        .mapboxgl-ctrl-geocoder--input {
            padding-left: 36px !important;
            font-size: 0.875rem !important;
            color: #111827 !important;
            height: 42px !important;
        }

        .mapboxgl-ctrl-geocoder--icon-search {
            left: 10px !important;
            top: 11px !important;
        }

        /* Dark Mode Support for Mapbox Geocoder */
        .dark .mapboxgl-ctrl-geocoder {
            background-color: rgba(55, 65, 81, 0.5) !important;
            border-color: rgba(75, 85, 99, 0.6) !important;
        }

        .dark .mapboxgl-ctrl-geocoder--input {
            color: #FFFFFF !important;
        }

        .dark .mapboxgl-ctrl-geocoder--input::placeholder {
            color: #9CA3AF !important;
        }

        .dark .mapboxgl-ctrl-geocoder .suggestions {
            background-color: #1F2937 !important;
            border: 1px solid #374151 !important;
        }

        .dark .mapboxgl-ctrl-geocoder .suggestions>li>a {
            color: #F3F4F6 !important;
        }

        .dark .mapboxgl-ctrl-geocoder .suggestions>.active>a,
        .dark .mapboxgl-ctrl-geocoder .suggestions>li>a:hover {
            background-color: #374151 !important;
            color: #38BDF8 !important;
        }

        .dark .mapboxgl-ctrl-geocoder--icon-search {
            fill: #9CA3AF !important;
        }
    </style>

    <div class="min-h-[85vh] flex items-center justify-center px-4 py-8">
        <!-- Main Card Container -->
        <div
            class="bg-white dark:bg-gray-800/90 border border-gray-100 dark:border-gray-700/60 rounded-2xl shadow-xl dark:shadow-2xl dark:shadow-black/40 w-full max-w-sm sm:max-w-md p-6 sm:p-8 space-y-6 backdrop-blur-sm transition-colors">

            <!-- Header Section -->
            <div class="text-center space-y-2">
                <div
                    class="w-12 h-12 bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 rounded-2xl mx-auto flex items-center justify-center shadow-md text-white text-xl">
                    <i class="fa-solid fa-user-plus"></i>
                </div>

                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">Create Account</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Sign up to join matches and build your team</p>
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

                <!-- Location Field (Mapbox Geocoder) -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Your Location /
                        City</label>
                    <div id="geocoder-container"></div>
                    @error('city')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hidden Location Inputs -->
                <input type="hidden" name="city" id="city">
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <!-- Password Field -->
                <x-inputs.text id="password" name="password" type="password" placeholder="Password"
                    icon="fa-solid fa-lock" />

                <!-- Password Confirmation Field -->
                <x-inputs.text id="password_confirmation" name="password_confirmation" type="password"
                    placeholder="Confirm Password" icon="fa-solid fa-shield-halved" />

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 active:scale-[0.98] text-white text-sm font-semibold rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 mt-2">
                    <span>Register</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Footer Link -->
            <div
                class="pt-4 border-t border-gray-100 dark:border-gray-700/50 text-center text-xs text-gray-500 dark:text-gray-400">
                Already have an account?
                <a class="font-semibold text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 ml-1 transition-colors"
                    href="{{ route('login') }}">
                    Log In
                </a>
            </div>

        </div>
    </div>

    <!-- Mapbox Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mapboxToken =
                '{{ config('services.mapbox.token') }}'; // Or add your Mapbox Public Token directly here

            const geocoder = new MapboxGeocoder({
                accessToken: mapboxToken,
                types: 'place,locality,neighborhood',
                placeholder: 'Search location (e.g. Evosmos, Thessaloniki)',
                mapboxgl: mapboxgl
            });

            geocoder.addTo('#geocoder-container');

            geocoder.on('result', function(e) {
                const placeName = e.result.text;
                const coordinates = e.result.center; // [lng, lat]

                document.getElementById('city').value = placeName;
                document.getElementById('longitude').value = coordinates[0];
                document.getElementById('latitude').value = coordinates[1];
            });

            geocoder.on('clear', function() {
                document.getElementById('city').value = '';
                document.getElementById('longitude').value = '';
                document.getElementById('latitude').value = '';
            });
        });
    </script>
</x-layout>
