<x-layout>
    <!-- Mapbox GL JS & Geocoder CSS/JS -->
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
            transition: background-color 0.2s, border-color 0.2s;
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
            fill: #9CA3AF !important;
        }

        /* Dark Mode adjustments for Mapbox Geocoder */
        .dark .mapboxgl-ctrl-geocoder {
            background-color: #374151 !important;
            border-color: #4B5563 !important;
        }

        .dark .mapboxgl-ctrl-geocoder--input {
            color: #F9FAFB !important;
        }

        .dark .mapboxgl-ctrl-geocoder--input::placeholder {
            color: #9CA3AF !important;
        }

        .dark .suggestions-wrapper,
        .dark .mapboxgl-ctrl-geocoder .suggestions {
            background-color: #1F2937 !important;
            border-color: #374151 !important;
        }

        .dark .mapboxgl-ctrl-geocoder .suggestions>li>a {
            color: #E5E7EB !important;
        }

        .dark .mapboxgl-ctrl-geocoder .suggestions>.active>a,
        .dark .mapboxgl-ctrl-geocoder .suggestions>li>a:hover {
            background-color: #374151 !important;
            color: #38BDF8 !important;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- Profile Info Form -->
            <div
                class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 p-6 sm:p-8 rounded-3xl shadow-sm space-y-6 transition-colors">
                <div>
                    <h3
                        class="text-xl font-extrabold text-gray-900 dark:text-white tracking-tight flex items-center gap-2">
                        <i class="fa-solid fa-user-pen text-sky-500 dark:text-sky-400"></i>
                        <span>Profile Info</span>
                    </h3>

                    <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">
                        Update your account details, location, and profile picture.
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Preview & Upload -->
                    <div class="flex items-center gap-4 py-2 border-b border-gray-100 dark:border-gray-700/60 pb-4">
                        @if (auth()->user()->avatar)
                            <div class="relative">
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Profile Avatar"
                                    class="w-16 h-16 rounded-2xl object-cover border-2 border-sky-100 dark:border-sky-900/50 shadow-sm">
                            </div>
                        @endif

                        <div class="flex-1">
                            <x-inputs.file id="avatar" name="avatar" label="Upload Avatar" />
                        </div>
                    </div>

                    <!-- Name Field -->
                    <x-inputs.text id="name" name="name" label="Name" value="{{ auth()->user()->name }}" />

                    <!-- Email Field -->
                    <x-inputs.text id="email" name="email" type="email" label="Email Address"
                        value="{{ auth()->user()->email }}" />

                    <!-- Location Field (Mapbox Geocoder) -->
                    <div class="space-y-1">
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300">Location /
                            City</label>
                        <div id="geocoder-container"></div>
                        @error('city')
                            <p class="text-xs text-red-500 dark:text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden Location Inputs -->
                    <input type="hidden" name="city" id="city"
                        value="{{ old('city', auth()->user()->location) }}">
                    <input type="hidden" name="latitude" id="latitude"
                        value="{{ old('latitude', auth()->user()->latitude) }}">
                    <input type="hidden" name="longitude" id="longitude"
                        value="{{ old('longitude', auth()->user()->longitude) }}">

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3 px-5 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 text-white text-xs font-semibold rounded-2xl shadow-md shadow-sky-500/20 active:scale-95 transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Game Listings -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Page Header -->
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 p-6 rounded-3xl shadow-sm transition-colors">

                    <div>
                        <h3
                            class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-sky-500 dark:text-sky-400"></i>
                            <span>My Game Listings</span>
                        </h3>

                        <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm mt-1">
                            Manage and track all the matches you have created.
                        </p>
                    </div>

                    <!-- Create New Game -->
                    <a href="{{ route('games.create') }}"
                        class="inline-flex items-center justify-center gap-2 min-w-[155px] px-5 py-3 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 text-white text-xs font-semibold rounded-2xl shadow-md shadow-sky-500/20 active:scale-95 transition-all whitespace-nowrap">
                        <i class="fa-solid fa-plus"></i>
                        <span>Create New Game</span>
                    </a>

                </div>

                <!-- Games List -->
                <div class="space-y-4">

                    @forelse($games as $game)
                        <div
                            class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/70 hover:border-gray-200 dark:hover:border-gray-600 rounded-2xl p-5 shadow-sm transition-all space-y-4">

                            <!-- Top Section: Game Details & Actions -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                                <!-- Game Details -->
                                <div class="space-y-2">

                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span
                                            class="px-2.5 py-1 bg-sky-50 dark:bg-sky-950/50 text-sky-700 dark:text-sky-300 border border-sky-100 dark:border-sky-800/60 rounded-lg text-xs font-bold uppercase tracking-wider">
                                            {{ $game->game_type ?? 'Match' }}
                                        </span>

                                        <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ $game->title }}
                                        </h4>
                                    </div>

                                    <!-- Info Pills -->
                                    <div
                                        class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400 flex-wrap">

                                        @if (isset($game->city) || isset($game->exact_location))
                                            <span class="flex items-center gap-1">
                                                <i
                                                    class="fa-solid fa-location-dot text-rose-500 dark:text-rose-400"></i>
                                                {{ $game->city ?? $game->exact_location }}
                                            </span>
                                        @endif

                                        @if (isset($game->created_at))
                                            <span class="flex items-center gap-1">
                                                <i class="fa-solid fa-calendar text-gray-400 dark:text-gray-500"></i>
                                                {{ $game->created_at->format('d M Y') }}
                                            </span>
                                        @endif

                                    </div>
                                </div>

                                <!-- Actions -->
                                <div
                                    class="flex items-center gap-2 pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100 dark:border-gray-700/60 justify-end">
                                    <a href="{{ route('games.show', $game) }}"
                                        class="px-3 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-colors flex items-center gap-1.5">
                                        <i class="fa-solid fa-eye text-gray-400 dark:text-gray-400"></i>
                                        <span>View</span>
                                    </a>

                                    @if (Route::has('games.edit'))
                                        <a href="{{ route('games.edit', $game) }}"
                                            class="px-3 py-2 text-xs font-semibold text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 bg-sky-50 dark:bg-sky-950/40 hover:bg-sky-100 dark:hover:bg-sky-900/50 rounded-xl transition-colors flex items-center gap-1.5">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span>Edit</span>
                                        </a>
                                    @endif

                                    @if (Route::has('games.destroy'))
                                        <form method="POST"
                                            action="{{ route('games.destroy', $game) }}?from=dashboard"
                                            onsubmit="return confirm('Are you sure you want to delete this game?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-3 py-2 text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/50 rounded-xl transition-colors flex items-center gap-1.5 cursor-pointer">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <!-- Applicants -->
                            <x-applicants :game="$game" />

                        </div>

                    @empty

                        <!-- Empty State -->
                        <div
                            class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 rounded-3xl p-10 text-center space-y-4 shadow-sm transition-colors">
                            <div
                                class="w-16 h-16 bg-sky-50 dark:bg-sky-950/50 text-sky-500 dark:text-sky-400 rounded-full flex items-center justify-center mx-auto text-2xl">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>

                            <div class="space-y-1">
                                <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                    No Game Listings Found
                                </h4>

                                <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm max-w-sm mx-auto">
                                    You haven't created any matches yet. Start organizing your first game now!
                                </p>
                            </div>

                            <a href="{{ route('games.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 text-white text-xs font-semibold rounded-2xl shadow-md shadow-sky-500/20 active:scale-95 transition-all">
                                <i class="fa-solid fa-plus"></i>
                                <span>Create Your First Game</span>
                            </a>
                        </div>
                    @endforelse

                </div>

                <!-- My Teams -->
                <div class="space-y-6">

                    <!-- Section Header -->
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 p-6 rounded-3xl shadow-sm transition-colors">

                        <div>
                            <h3
                                class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight flex items-center gap-2">
                                <i class="fa-solid fa-people-group text-emerald-500 dark:text-emerald-400"></i>
                                <span>My Teams</span>
                            </h3>

                            <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm mt-1">
                                View and manage the teams you have created or joined.
                            </p>
                        </div>

                        <a href="{{ route('teams.create') }}"
                            class="inline-flex items-center justify-center gap-2 min-w-[155px] px-5 py-3 bg-emerald-500 hover:bg-emerald-600 dark:bg-emerald-500 dark:hover:bg-emerald-400 text-white text-xs font-semibold rounded-2xl shadow-md shadow-emerald-500/20 active:scale-95 transition-all whitespace-nowrap">

                            <i class="fa-solid fa-plus"></i>
                            <span>Create New Team</span>
                        </a>
                    </div>

                    <!-- Teams List -->
                    <div class="space-y-4">

                        @forelse($teams as $team)
                            <a href="{{ route('teams.show', $team) }}"
                                class="block bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/70 hover:border-emerald-300 dark:hover:border-emerald-600 rounded-2xl p-5 shadow-sm transition-all">

                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                                    <!-- Team Details -->
                                    <div class="space-y-2">

                                        <div class="flex items-center gap-2 flex-wrap">

                                            <span
                                                class="px-2.5 py-1 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 border border-emerald-100 dark:border-emerald-800/60 rounded-lg text-xs font-bold uppercase tracking-wider">
                                                {{ $team->sport }}
                                            </span>

                                            @if ($team->created_by === auth()->id())
                                                <span
                                                    class="px-2.5 py-1 bg-sky-50 dark:bg-sky-950/50 text-sky-700 dark:text-sky-300 border border-sky-100 dark:border-sky-800/60 rounded-lg text-xs font-bold">
                                                    Owner
                                                </span>
                                            @else
                                                <span
                                                    class="px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg text-xs font-bold">
                                                    Member
                                                </span>
                                            @endif

                                        </div>

                                        <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ $team->name }}
                                        </h4>

                                        @if ($team->description)
                                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                                {{ $team->description }}
                                            </p>
                                        @endif

                                        <!-- Info Pills -->
                                        <div
                                            class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400 flex-wrap">

                                            @if ($team->city)
                                                <span class="flex items-center gap-1">
                                                    <i
                                                        class="fa-solid fa-location-dot text-rose-500 dark:text-rose-400"></i>
                                                    {{ $team->city }}
                                                </span>
                                            @endif

                                            <span class="flex items-center gap-1">
                                                <i
                                                    class="fa-solid fa-users text-emerald-500 dark:text-emerald-400"></i>
                                                {{ $team->members_count }}
                                                {{ $team->members_count === 1 ? 'member' : 'members' }}
                                            </span>

                                            @if ($team->created_at)
                                                <span class="flex items-center gap-1">
                                                    <i
                                                        class="fa-solid fa-calendar text-gray-400 dark:text-gray-500"></i>
                                                    {{ $team->created_at->format('d M Y') }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <!-- View Action -->
                                    <div
                                        class="flex items-center justify-end pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100 dark:border-gray-700/60">

                                        <span
                                            class="px-3 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 bg-gray-50 dark:bg-gray-700/50 rounded-xl transition-colors flex items-center gap-1.5">

                                            <i class="fa-solid fa-eye text-gray-400"></i>
                                            <span>View Team</span>
                                            <i class="fa-solid fa-arrow-right ml-1"></i>
                                        </span>

                                    </div>
                                </div>
                            </a>

                        @empty

                            <!-- Empty State -->
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 rounded-3xl p-10 text-center space-y-4 shadow-sm transition-colors">

                                <div
                                    class="w-16 h-16 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-500 dark:text-emerald-400 rounded-full flex items-center justify-center mx-auto text-2xl">

                                    <i class="fa-solid fa-people-group"></i>
                                </div>

                                <div class="space-y-1">
                                    <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                        No Teams Found
                                    </h4>

                                    <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm max-w-sm mx-auto">
                                        You haven't created or joined any teams yet. Create your own team or join an
                                        existing one!
                                    </p>
                                </div>

                                <a href="{{ route('teams.create') }}"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 dark:bg-emerald-500 dark:hover:bg-emerald-400 text-white text-xs font-semibold rounded-2xl shadow-md shadow-emerald-500/20 active:scale-95 transition-all">

                                    <i class="fa-solid fa-plus"></i>
                                    <span>Create Your First Team</span>
                                </a>
                            </div>
                        @endforelse

                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- Mapbox Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mapboxToken = '{{ config('services.mapbox.token') }}';

            const geocoder = new MapboxGeocoder({
                accessToken: mapboxToken,
                types: 'place,locality,neighborhood',
                placeholder: 'Search location (e.g. Evosmos, Thessaloniki)',
                mapboxgl: mapboxgl
            });

            geocoder.addTo('#geocoder-container');

            const savedLocation = document.getElementById('city').value;
            if (savedLocation) {
                geocoder.setInput(savedLocation);

                // Close dropdown suggestions and remove focus on page load
                setTimeout(() => {
                    const suggestions = document.querySelector('.suggestions');
                    if (suggestions) {
                        suggestions.style.display = 'none';
                    }
                    const geocoderInput = document.querySelector('.mapboxgl-ctrl-geocoder--input');
                    if (geocoderInput) {
                        geocoderInput.blur();
                    }
                }, 100);
            }

            geocoder.on('result', function(e) {
                const placeName = e.result.text;
                const coordinates = e.result.center;

                document.getElementById('city').value = placeName;
                document.getElementById('longitude').value = coordinates[0];
                document.getElementById('latitude').value = coordinates[1];
            });

            geocoder.on('clear', function() {
                document.getElementById('city').value = '';
                document.getElementById('longitude').value = '';
                document.getElementById('latitude').value = '';
            });

            // Fallback: sync input value directly if user types without clicking dropdown
            const geocoderInput = document.querySelector('.mapboxgl-ctrl-geocoder--input');
            if (geocoderInput) {
                geocoderInput.addEventListener('input', function(e) {
                    document.getElementById('city').value = e.target.value;
                });

                // Re-enable suggestions display when user interacts with input
                geocoderInput.addEventListener('focus', function() {
                    const suggestions = document.querySelector('.suggestions');
                    if (suggestions) {
                        suggestions.style.display = 'block';
                    }
                });
            }
        });
    </script>
</x-layout>
