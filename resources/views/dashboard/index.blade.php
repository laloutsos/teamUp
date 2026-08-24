<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- Profile Info Form -->
            <div class="bg-white border border-gray-100 p-6 sm:p-8 rounded-3xl shadow-sm space-y-6">
                <div>
                    <h3 class="text-xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                        <i class="fa-solid fa-user-pen text-sky-500"></i>
                        <span>Profile Info</span>
                    </h3>

                    <p class="text-gray-500 text-xs mt-1">
                        Update your account details and profile picture.
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Preview & Upload -->
                    <div class="flex items-center gap-4 py-2 border-b border-gray-50 pb-4">
                        @if (auth()->user()->avatar)
                            <div class="relative">
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Profile Avatar"
                                    class="w-16 h-16 rounded-2xl object-cover border-2 border-sky-100 shadow-sm">
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

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3 px-5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold rounded-2xl shadow-md shadow-sky-500/20 active:scale-95 transition-all flex items-center justify-center gap-2 cursor-pointer">
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
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white border border-gray-100 p-6 rounded-3xl shadow-sm">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-sky-500"></i>
                            <span>My Game Listings</span>
                        </h3>

                        <p class="text-gray-500 text-xs sm:text-sm mt-1">
                            Manage and track all the matches you have created.
                        </p>
                    </div>

                    <a href="{{ route('games.create') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold rounded-2xl shadow-md shadow-sky-500/20 active:scale-95 transition-all">
                        <i class="fa-solid fa-plus"></i>
                        <span>Create New Game</span>
                    </a>
                </div>

                <!-- Games List -->
                <div class="space-y-4">

                    @forelse($games as $game)
                        <div
                            class="bg-white border border-gray-100 hover:border-gray-200 rounded-2xl p-5 shadow-sm transition-all space-y-4">

                            <!-- Top Section: Game Details & Actions -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                                <!-- Game Details -->
                                <div class="space-y-2">

                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span
                                            class="px-2.5 py-1 bg-sky-50 text-sky-700 border border-sky-100 rounded-lg text-xs font-bold uppercase tracking-wider">
                                            {{ $game->game_type ?? 'Match' }}
                                        </span>

                                        <h4 class="text-base font-bold text-gray-900">
                                            {{ $game->title }}
                                        </h4>
                                    </div>

                                    <!-- Info Pills -->
                                    <div class="flex items-center gap-4 text-xs text-gray-500 flex-wrap">

                                        @if (isset($game->city) || isset($game->exact_location))
                                            <span class="flex items-center gap-1">
                                                <i class="fa-solid fa-location-dot text-rose-500"></i>
                                                {{ $game->city ?? $game->exact_location }}
                                            </span>
                                        @endif

                                        @if (isset($game->created_at))
                                            <span class="flex items-center gap-1">
                                                <i class="fa-solid fa-calendar text-gray-400"></i>
                                                {{ $game->created_at->format('d M Y') }}
                                            </span>
                                        @endif

                                    </div>
                                </div>

                                <!-- Actions -->
                                <div
                                    class="flex items-center gap-2 pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100 justify-end">
                                    <a href="{{ route('games.show', $game) }}"
                                        class="px-3 py-2 text-xs font-semibold text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 rounded-xl transition-colors flex items-center gap-1.5">
                                        <i class="fa-solid fa-eye text-gray-400"></i>
                                        <span>View</span>
                                    </a>

                                    @if (Route::has('games.edit'))
                                        <a href="{{ route('games.edit', $game) }}"
                                            class="px-3 py-2 text-xs font-semibold text-sky-600 hover:text-sky-700 bg-sky-50 hover:bg-sky-100 rounded-xl transition-colors flex items-center gap-1.5">
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
                                                class="px-3 py-2 text-xs font-semibold text-rose-600 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors flex items-center gap-1.5 cursor-pointer">
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
                        <div class="bg-white border border-gray-100 rounded-3xl p-10 text-center space-y-4 shadow-sm">
                            <div
                                class="w-16 h-16 bg-sky-50 text-sky-500 rounded-full flex items-center justify-center mx-auto text-2xl">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>

                            <div class="space-y-1">
                                <h4 class="text-base font-bold text-gray-900">
                                    No Game Listings Found
                                </h4>

                                <p class="text-gray-500 text-xs sm:text-sm max-w-sm mx-auto">
                                    You haven't created any matches yet. Start organizing your first game now!
                                </p>
                            </div>

                            <a href="{{ route('games.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold rounded-2xl shadow-md shadow-sky-500/20 active:scale-95 transition-all">
                                <i class="fa-solid fa-plus"></i>
                                <span>Create Your First Game</span>
                            </a>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>
    </div>
</x-layout>
