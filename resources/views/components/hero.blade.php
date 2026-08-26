@props(['title' => 'Find Your Dream Team (or Enemy)'])

<section class="w-full max-w-2xl mx-auto px-4 py-6 sm:py-10 text-center space-y-5">
    <!-- Main Title with Gradient Text -->
    <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-gray-900 dark:text-white leading-tight">
        Find Your <span class="bg-gradient-to-r from-sky-400 to-blue-600 bg-clip-text text-transparent">Dream Team</span>
    </h1>

    <!-- Search Bar Component -->
    <div class="w-full">
        <x-search />
    </div>
</section>
