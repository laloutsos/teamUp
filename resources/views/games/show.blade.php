<x-layout>

    <div class="max-w-6xl mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- Main Content -->
        <section class="order-1 md:col-span-3 space-y-6">

            <!-- Flash Session Notifications -->
            @if (session('error'))
                <div
                    class="p-4 bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900/60 rounded-xl text-red-700 dark:text-red-300 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-base"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/60 rounded-xl text-emerald-700 dark:text-emerald-300 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Game Details Post Card -->
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm overflow-hidden text-sm transition-colors">

                <!-- Navigation & Actions Bar -->
                <div
                    class="flex justify-between items-center p-3 border-b border-gray-100 dark:border-gray-700/60 bg-gray-50/50 dark:bg-gray-800/50">

                    <a class="inline-flex items-center gap-2 font-medium text-gray-700 dark:text-gray-300 hover:text-sky-500 dark:hover:text-sky-400 transition-colors"
                        href="{{ route('games.index') }}">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                        <span>Back To Available Games</span>
                    </a>

                    <!-- Action Buttons -->
                    @can('update', $game)
                        <div class="flex items-center gap-2">

                            <a href="{{ route('games.edit', $game->id) }}"
                                class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-lg transition-colors">
                                Edit
                            </a>

                            <!-- Delete Form -->
                            <form method="POST" action="{{ route('games.destroy', $game->id) }}" class="inline"
                                onsubmit="return confirm('Are you sure that you want to delete this game?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-3 py-1.5 bg-red-50 dark:bg-red-950/50 hover:bg-red-100 dark:hover:bg-red-900/60 text-red-600 dark:text-red-400 text-xs font-semibold rounded-lg border border-red-200 dark:border-red-900/60 transition-colors cursor-pointer">
                                    Delete
                                </button>

                            </form>
                        </div>
                    @endcan
                </div>

                <!-- Post Body -->
                <div class="p-5 space-y-4">

                    <div class="flex items-start justify-between gap-4">

                        <h2 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">
                            {{ $game->title }}
                        </h2>

                        <!-- Competitive Badge -->
                        @if ($game->competitive)
                            <span
                                class="text-xs font-semibold bg-red-50 dark:bg-red-950/50 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/60 rounded-full px-3 py-1 flex-shrink-0">
                                Competitive
                            </span>
                        @else
                            <span
                                class="text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900/60 rounded-full px-3 py-1 flex-shrink-0">
                                Not Competitive
                            </span>
                        @endif

                    </div>

                    <p class="text-gray-800 dark:text-gray-200 leading-relaxed text-base">
                        {{ $game->description }}
                    </p>

                    <!-- Info Box -->
                    <div
                        class="bg-gray-50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700/60 rounded-xl p-4 space-y-2 text-xs text-gray-700 dark:text-gray-300">

                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-900 dark:text-white w-24">Game Type:</span>
                            <span class="text-gray-800 dark:text-gray-200 font-medium">
                                {{ $game->game_type }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-900 dark:text-white w-24">Bet Amount:</span>
                            <span class="font-bold text-gray-900 dark:text-white text-sm">
                                {{ number_format($game->bet) }}€
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-900 dark:text-white w-24">Location:</span>
                            <span class="text-gray-800 dark:text-gray-200">
                                {{ $game->city }}, {{ $game->exact_location }}
                            </span>
                        </div>

                        @if ($game->tags)
                            <div
                                class="flex items-start gap-2 pt-1 border-t border-gray-200/60 dark:border-gray-700/60">
                                <span class="font-semibold text-gray-900 dark:text-white w-24">Tags:</span>
                                <span class="text-sky-600 dark:text-sky-400 font-medium">
                                    {{ ucwords(str_replace(',', ', ', $game->tags)) }}
                                </span>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- More Info & Arrange Section -->
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm p-5 space-y-4 transition-colors">

                <h3 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-sky-500 dark:text-sky-400"></i>
                    <span>More Information</span>
                </h3>

                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                    {{ $game->more_information ?? 'No additional information provided.' }}
                </p>

                <!-- Arrange Action Area -->
                <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60 space-y-3" x-data="{ open: false }">

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Send an application or contact the organizer directly regarding this match.
                    </p>

                    @php
                        $hasApplied = auth()->check() && $game->applicants()->where('user_id', auth()->id())->exists();
                    @endphp

                    <!-- Trigger Buttons -->
                    <div class="flex flex-col sm:flex-row gap-2">

                        @if ($hasApplied)
                            <!-- Already Applied Button -->
                            <button type="button" disabled
                                class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700/60 border border-gray-200 dark:border-gray-600 cursor-not-allowed flex items-center justify-center gap-2">

                                <i class="fa-solid fa-circle-check text-emerald-600 dark:text-emerald-400"></i>
                                <span>Already Applied</span>
                            </button>
                        @else
                            <!-- Arrange / Apply Button -->
                            <button @click="open = true" type="button"
                                class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 active:bg-sky-700 transition-colors flex items-center justify-center gap-2 shadow-sm cursor-pointer">

                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Arrange Now</span>
                            </button>
                        @endif

                        <!-- Direct Email Button -->
                        <a href="mailto:{{ $game->contact_email }}?subject=Game%20Arrangement:%20{{ urlencode($game->title) }}"
                            class="px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center justify-center gap-2 border border-gray-200 dark:border-gray-600">

                            <i class="fa-regular fa-envelope"></i>
                            <span>Send Email</span>
                        </a>

                    </div>

                    <!-- Application Form Modal -->
                    @if (!$hasApplied)
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-gray-900/60 dark:bg-black/70 backdrop-blur-sm overflow-y-auto">

                            <!-- Responsive Modal Container -->
                            <div @click.away="open = false"
                                class="bg-white dark:bg-gray-800 rounded-2xl max-w-lg w-full p-4 sm:p-6 shadow-xl space-y-4 text-left border border-gray-100 dark:border-gray-700 my-auto max-h-[90vh] overflow-y-auto">

                                <!-- Modal Header -->
                                <div
                                    class="flex items-center justify-between border-b border-gray-100 dark:border-gray-700 pb-3 sticky top-0 bg-white dark:bg-gray-800 z-10">

                                    <h3
                                        class="text-base sm:text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">

                                        <i class="fa-solid fa-trophy text-sky-500 dark:text-sky-400"></i>
                                        <span>Arrange Match Application</span>
                                    </h3>

                                    <button @click="open = false" type="button"
                                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-1 rounded-lg transition-colors cursor-pointer">
                                        <i class="fa-solid fa-xmark text-lg"></i>
                                    </button>

                                </div>

                                <p class="text-xs text-gray-600 dark:text-gray-300">
                                    Submit your details to apply for this game.
                                </p>

                                <!-- Applicant Form -->
                                <form method="POST" action="{{ route('applicant.store', $game->id) }}"
                                    enctype="multipart/form-data" class="space-y-3 sm:space-y-4 text-xs">

                                    @csrf

                                    <!-- Full Name -->
                                    <x-inputs.text id="full_name" name="full_name" label="Full Name" :value="old('full_name', auth()->user()?->name)"
                                        placeholder="Enter your full name" icon="fa-solid fa-user" required />

                                    <!-- Phone & Email -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                        <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone"
                                            :value="old('contact_phone')" placeholder="e.g. 6912345678" icon="fa-solid fa-phone"
                                            required />

                                        <x-inputs.text id="contact_email" name="contact_email" type="email"
                                            label="Contact Email" :value="old('contact_email', auth()->user()?->email)" placeholder="your@email.com"
                                            icon="fa-solid fa-envelope" required />

                                    </div>

                                    <!-- Location -->
                                    <x-inputs.text id="location" name="location" label="Location / City"
                                        :value="old('location')" placeholder="e.g. Athens" icon="fa-solid fa-location-dot" />

                                    <!-- Message -->
                                    <x-inputs.text-area id="message" name="message" label="Message / Notes"
                                        placeholder="Add a message for the organizer..." rows="3" />

                                    <!-- Resume Upload -->
                                    <x-inputs.file id="resume_path" name="resume_path"
                                        label="Upload Resume (Optional)" />

                                    <!-- Action Buttons -->
                                    <div
                                        class="flex flex-col-reverse sm:flex-row justify-end gap-2 pt-3 border-t border-gray-100 dark:border-gray-700">

                                        <button @click="open = false" type="button"
                                            class="w-full sm:w-auto px-4 py-2.5 sm:py-2 rounded-xl text-xs font-semibold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors cursor-pointer">
                                            Cancel
                                        </button>

                                        <button type="submit"
                                            class="w-full sm:w-auto px-5 py-2.5 sm:py-2 rounded-xl text-xs font-semibold text-white bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 transition-colors flex items-center justify-center gap-1.5 shadow-sm cursor-pointer">

                                            <i class="fa-solid fa-paper-plane"></i>
                                            <span>Submit Application</span>
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <!-- Map Container -->
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm p-4 transition-colors">

                <div id="map"
                    class="w-full h-64 rounded-lg bg-gray-100 dark:bg-gray-900 border border-gray-200/50 dark:border-gray-700/50">
                </div>

            </div>

        </section>

        <!-- Sidebar -->
        <aside class="order-2 md:col-span-1 space-y-4">

            <!-- Bookmark Card -->
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm p-5 text-center space-y-4 transition-colors">

                <div class="space-y-2">
                    <div
                        class="w-14 h-14 rounded-full bg-sky-50 dark:bg-sky-950/40 flex items-center justify-center mx-auto">
                        <i class="fa-solid fa-bookmark text-sky-500 dark:text-sky-400 text-xl"></i>
                    </div>

                    <h4 class="text-base font-bold text-gray-900 dark:text-white">
                        Save This Game
                    </h4>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Bookmark this listing to find it easily later.
                    </p>
                </div>

                <!-- Bookmark Button -->
                @if (auth()->user()?->bookmarkedGames->contains($game->id))
                    <form method="POST" action="{{ route('bookmarks.destroy', $game->id) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/40 hover:bg-red-100 dark:hover:bg-red-900/60 border border-red-200 dark:border-red-900/60 transition-colors cursor-pointer">

                            <i class="fa-solid fa-bookmark"></i>
                            <span>Remove Bookmark</span>
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('bookmarks.store', $game->id) }}">
                        @csrf

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold text-sky-600 dark:text-sky-400 bg-sky-50 dark:bg-sky-950/40 hover:bg-sky-100 dark:hover:bg-sky-900/60 border border-sky-200 dark:border-sky-900/60 transition-colors cursor-pointer">

                            <i class="fa-regular fa-bookmark"></i>
                            <span>Bookmark Game</span>
                        </button>
                    </form>
                @endif

            </div>
        </aside>

    </div>

</x-layout>

<!-- Mapbox -->
<link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet" />

<script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Mapbox access token
        mapboxgl.accessToken = "{{ env('MAPBOX_API_KEY') }}";

        // Dynamic Map Theme
        const isDarkMode = document.documentElement.classList.contains('dark');

        const mapStyle = isDarkMode ?
            'mapbox://styles/mapbox/dark-v10' :
            'mapbox://styles/mapbox/streets-v11';

        // Initialize Map
        const map = new mapboxgl.Map({
            container: 'map',
            style: mapStyle,
            center: [-74.5, 40],
            zoom: 9
        });

        // Get address
        const city = @js($game->city);
        const location = @js($game->exact_location);
        const address = city + ', ' + location;

        // Geocode address
        fetch(`/geocode?address=${encodeURIComponent(address)}`)
            .then((response) => response.json())
            .then((data) => {

                if (data.features && data.features.length > 0) {

                    const [longitude, latitude] = data.features[0].center;

                    map.setCenter([longitude, latitude]);
                    map.setZoom(14);

                    new mapboxgl.Marker()
                        .setLngLat([longitude, latitude])
                        .addTo(map);

                } else {
                    console.error('No results found for the address.');
                }

            })
            .catch((error) => {
                console.error('Error geocoding address:', error);
            });

    });
</script>
