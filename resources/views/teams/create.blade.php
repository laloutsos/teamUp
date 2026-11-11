<x-layout>
    <x-slot name="title">Create Team</x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8">
        <!-- Instagram Card Container -->
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm overflow-hidden transition-colors">

            <!-- Header Bar -->
            <div
                class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-700/60 bg-gray-50/50 dark:bg-gray-800/50">

                <a href="{{ route('teams.index') }}"
                    class="inline-flex items-center gap-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-sky-500 dark:hover:text-sky-400 transition-colors">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span>Back</span>
                </a>

                <h1 class="text-base font-bold text-gray-900 dark:text-white">
                    Create New Team
                </h1>

                <div class="w-8"></div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('teams.store') }}" class="p-6 space-y-6">
                @csrf

                <!-- Section: Team Details -->
                <div class="space-y-4">

                    <div
                        class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-400 pb-1 border-b border-gray-100 dark:border-gray-700/60">
                        <i class="fa-solid fa-users text-sky-500 dark:text-sky-400"></i>
                        <span>Team Details</span>
                    </div>

                    <!-- Team Name -->
                    <x-inputs.text id="name" name="name" label="Team Name" placeholder="e.g. Ioannina FC" />

                    <!-- Team Description -->
                    <x-inputs.text-area id="description" name="description" label="Description"
                        placeholder="Tell us a little about your team, its goals and playing style..." />

                </div>

                <!-- Section: Sport & Location -->
                <div class="space-y-4 pt-2">

                    <div
                        class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-400 pb-1 border-b border-gray-100 dark:border-gray-700/60">
                        <i class="fa-solid fa-futbol text-sky-500 dark:text-sky-400"></i>
                        <span>Sport & Location</span>
                    </div>

                    <!-- Sport & City -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <x-inputs.select id="sport" name="sport" label="Sport" value="{{ old('sport') }}"
                            :options="[
                                'football' => 'Football',
                                'basketball' => 'Basketball',
                                'volleyball' => 'Volleyball',
                            ]" />

                        <x-inputs.text id="city" name="city" label="City" placeholder="e.g. Thessaloniki" />

                    </div>

                </div>

                <!-- Section: Team Capacity -->
                <div class="space-y-4 pt-2">

                    <div
                        class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-400 pb-1 border-b border-gray-100 dark:border-gray-700/60">
                        <i class="fa-solid fa-user-group text-sky-500 dark:text-sky-400"></i>
                        <span>Team Capacity</span>
                    </div>

                    <!-- Maximum Members -->
                    <x-inputs.text id="max_members" name="max_members" label="Maximum Members" type="number"
                        placeholder="e.g. 15" />

                    <p class="text-xs text-gray-400 dark:text-gray-500">
                        Set the maximum number of members allowed in your team.
                        Leave empty if there is no specific limit.
                    </p>

                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60">

                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 active:bg-sky-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500/50 cursor-pointer">

                        <i class="fa-solid fa-plus mr-1"></i>
                        Create Team

                    </button>

                </div>

            </form>
        </div>
    </div>
</x-layout>
