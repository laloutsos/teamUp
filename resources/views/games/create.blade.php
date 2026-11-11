<x-layout>
    <x-slot name="title">Create Game</x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8">
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm overflow-hidden transition-colors">

            <!-- Header Bar -->
            <div
                class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-700/60 bg-gray-50/50 dark:bg-gray-800/50">

                <a href="{{ route('games.index') }}"
                    class="inline-flex items-center gap-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-sky-500 dark:hover:text-sky-400 transition-colors">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span>Back</span>
                </a>

                <h1 class="text-base font-bold text-gray-900 dark:text-white">
                    Create New Game
                </h1>

                <div class="w-8"></div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('games.store') }}" class="p-6 space-y-6">
                @csrf

                <!-- Section: Game Details -->
                <div class="space-y-4">
                    <div
                        class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-400 pb-1 border-b border-gray-100 dark:border-gray-700/60">
                        <i class="fa-solid fa-gamepad text-sky-500 dark:text-sky-400"></i>
                        <span>Game Details</span>
                    </div>

                    <!-- Game Title -->
                    <x-inputs.text id="title" name="title" label="Game Title"
                        placeholder="e.g. 5v5 Friendly Football Match" />

                    <!-- Description -->
                    <x-inputs.text-area id="description" name="description" label="Description"
                        placeholder="Looking for a friendly match..." />

                    <!-- Game Type & Bet Amount -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <x-inputs.select id="game_type" name="game_type" label="Game Type"
                            value="{{ old('game_type') }}" :options="[
                                'Football' => 'Football',
                                'Basketball' => 'Basketball',
                                'Volleyball' => 'Volleyball',
                                'Tennis' => 'Tennis',
                                'Other' => 'Other',
                            ]" />

                        <x-inputs.text id="bet" name="bet" label="Bet Amount (€)" type="number"
                            placeholder="0" />

                    </div>

                    <!-- Competitive -->
                    <x-inputs.select id="competitive" name="competitive" label="Competitive"
                        value="{{ old('competitive') }}" :options="[
                            0 => 'No',
                            1 => 'Yes',
                        ]" />

                    <!-- Tags -->
                    <x-inputs.text id="tags" name="tags" label="Tags (comma-separated)"
                        placeholder="outdoor, 5v5, night-game, beginner-friendly" />

                </div>

                <!-- Section: Location & Contact -->
                <div class="space-y-4 pt-2">
                    <div
                        class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-400 pb-1 border-b border-gray-100 dark:border-gray-700/60">
                        <i class="fa-solid fa-location-dot text-sky-500 dark:text-sky-400"></i>
                        <span>Location & Contact</span>
                    </div>

                    <!-- City & Location -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-inputs.text id="city" name="city" label="City" placeholder="Thessaloniki" />

                        <x-inputs.text id="exact_location" name="exact_location" label="Exact Location"
                            placeholder="Toumba" />
                    </div>

                    <!-- Contact Email & Phone -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1"
                                for="contact_email">
                                Contact Email
                            </label>

                            <input id="contact_email" type="email" name="contact_email"
                                value="{{ old('contact_email') }}"
                                class="w-full px-3.5 py-2 text-sm bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:bg-white dark:focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 dark:focus:border-sky-400 transition-all placeholder:text-gray-400 dark:placeholder:text-gray-400"
                                placeholder="organizer@example.com" />

                            @error('contact_email')
                                <p class="text-red-500 dark:text-rose-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone"
                            placeholder="+30 6912345678" />

                    </div>

                    <!-- More Information -->
                    <x-inputs.text-area id="more_information" name="more_information"
                        label="More Information / Instructions"
                        placeholder="Additional details for players joining..." />

                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60">
                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 active:bg-sky-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500/50 cursor-pointer">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-layout>
