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
    </style>

    <div class="min-h-[85vh] flex items-center justify-center px-4 py-8">
        <!-- Main Card Container -->
        <div
            class="bg-white border border-gray-200 rounded-2xl shadow-xl w-full max-w-sm sm:max-w-md p-6 sm:p-8 space-y-6">

            <!-- Header Section -->
            <div class="text-center space-y-2">
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

                <!-- Location Field (Mapbox Geocoder) -->
                <div class="space-y-1">
                    <label class="block text-xs font-medium text-gray-600">Your Location / City</label>
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
