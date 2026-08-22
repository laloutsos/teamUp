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

                            <!-- Styled Applicants Accordion Section -->
                            <div class="pt-3 border-t border-gray-100" x-data="{ showApplicants: false }">
                                <button @click="showApplicants = !showApplicants" type="button"
                                    class="w-full flex items-center justify-between py-1.5 px-3 bg-gray-50 hover:bg-sky-50/60 rounded-xl transition-colors text-xs font-semibold text-gray-700 hover:text-sky-600">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-users text-sky-500"></i>
                                        <span>Applicants</span>
                                        <span
                                            class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-white border border-gray-200 text-gray-700 shadow-2xs">
                                            {{ $game->applicants->count() }}
                                        </span>
                                    </div>
                                    <i class="fa-solid text-gray-400 transition-transform duration-200"
                                        :class="showApplicants ? 'fa-chevron-up text-sky-500' : 'fa-chevron-down'"></i>
                                </button>

                                <!-- Applicants List Collapse -->
                                <div x-show="showApplicants" x-cloak class="mt-3 space-y-2.5">
                                    @forelse($game->applicants as $applicant)
                                        <div class="p-3.5 bg-gray-50/70 border border-gray-100 rounded-xl space-y-2.5">

                                            <!-- Applicant Header & All Action Buttons -->
                                            <div class="flex items-center justify-between gap-3 flex-wrap">
                                                <div class="flex items-center gap-2.5">
                                                    <!-- Initials Avatar -->
                                                    <div
                                                        class="w-8 h-8 rounded-xl bg-sky-100 text-sky-600 font-bold text-xs flex items-center justify-center shadow-2xs">
                                                        {{ strtoupper(substr($applicant->full_name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h5 class="text-xs font-bold text-gray-900">
                                                            {{ $applicant->full_name }}
                                                        </h5>
                                                        <p class="text-[10px] text-gray-400">
                                                            Applied {{ $applicant->created_at?->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- Action Buttons Group (Resume, Email, Delete) -->
                                                <div class="flex items-center gap-1.5">
                                                    @if ($applicant->resume_path)
                                                        <a href="{{ asset('storage/' . $applicant->resume_path) }}"
                                                            target="_blank"
                                                            class="px-2.5 py-1 bg-white hover:bg-gray-100 text-gray-700 border border-gray-200 rounded-lg text-[11px] font-medium transition-colors flex items-center gap-1">
                                                            <i class="fa-solid fa-paperclip text-sky-500"></i>
                                                            <span>Resume</span>
                                                        </a>
                                                    @endif

                                                    <a href="mailto:{{ $applicant->contact_email }}?subject=Game%20Application:%20{{ urlencode($game->title) }}"
                                                        class="px-2.5 py-1 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-[11px] font-semibold transition-colors flex items-center gap-1 shadow-2xs">
                                                        <i class="fa-regular fa-envelope"></i>
                                                        <span>Contact</span>
                                                    </a>

                                                    <!-- Properly Aligned Delete Button -->
                                                    <form method="POST"
                                                        action="{{ route('applicant.destroy', $applicant->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this applicant?')"
                                                        class="inline flex items-center">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1.5 text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200/60 rounded-lg transition-colors flex items-center justify-center cursor-pointer"
                                                            title="Delete Applicant">
                                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Contact Details Grid -->
                                            <div
                                                class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-2 border-t border-gray-200/50 text-[11px] text-gray-600">
                                                <div class="flex items-center gap-2">
                                                    <i class="fa-solid fa-envelope text-gray-400 w-3.5"></i>
                                                    <span>{{ $applicant->contact_email }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <i class="fa-solid fa-phone text-gray-400 w-3.5"></i>
                                                    <a href="tel:{{ $applicant->contact_phone }}"
                                                        class="hover:underline hover:text-sky-600">
                                                        {{ $applicant->contact_phone ?? 'N/A' }}
                                                    </a>
                                                </div>
                                                @if ($applicant->location)
                                                    <div class="flex items-center gap-2 sm:col-span-2">
                                                        <i class="fa-solid fa-location-dot text-gray-400 w-3.5"></i>
                                                        <span>{{ $applicant->location }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Optional Message Box -->
                                            @if ($applicant->message)
                                                <div
                                                    class="p-2.5 bg-white border border-gray-100 rounded-lg text-[11px] text-gray-600 italic leading-relaxed">
                                                    "{{ $applicant->message }}"
                                                </div>
                                            @endif

                                        </div>
                                    @empty
                                        <div
                                            class="p-4 bg-gray-50/50 border border-dashed border-gray-200 rounded-xl text-center text-gray-400 text-xs">
                                            <i class="fa-regular fa-folder-open mb-1 text-sm block text-gray-300"></i>
                                            No applicants for this game yet.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="bg-white border border-gray-100 rounded-3xl p-10 text-center space-y-4 shadow-sm">
                            <div
                                class="w-16 h-16 bg-sky-50 text-sky-500 rounded-full flex items-center justify-center mx-auto text-2xl">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-base font-bold text-gray-900">No Game Listings Found</h4>
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
