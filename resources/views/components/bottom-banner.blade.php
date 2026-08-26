@props(['heading' => 'Looking for a rival?', 'subheading' => 'Discover your Capabilities'])

<section class="container mx-auto my-6 px-4">
    <div
        class="bg-gradient-to-r from-blue-700 via-sky-600 to-indigo-700 dark:from-blue-900 dark:via-sky-900 dark:to-indigo-950 text-white rounded-2xl p-6 flex items-center justify-between flex-col md:flex-row gap-4 shadow-lg border border-blue-600/30 dark:border-sky-500/20">
        <div class="text-center md:text-left">
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-white">{{ $heading }}</h2>
            <p class="text-blue-100 dark:text-gray-300 text-sm sm:text-base mt-1 font-medium"> {{ $subheading }} </p>
        </div>

        <div class="shrink-0">
            <x-button-link url="/games/create" icon="edit">Create Game</x-button-link>
        </div>
    </div>
</section>
