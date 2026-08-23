@props(['title' => 'Find Your Dream Team (or Enemy)'])

<section
    class="relative bg-gradient-to-r from-sky-500 to-blue-600 rounded-3xl min-h-[300px] md:h-80 flex items-center justify-center py-10 md:py-0 overflow-hidden shadow-sm my-6 text-white">

    <!-- Decorative Background Circles -->
    <div class="absolute -top-12 -left-12 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
    <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-sky-300/20 rounded-full blur-2xl pointer-events-none"></div>

    <div class="container mx-auto text-center z-10 px-4 max-w-3xl">
        <!-- Main Title -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl text-white font-extrabold tracking-tight mb-6 drop-shadow-sm">
            {{ $title }}
        </h2>

        <x-search />
    </div>
</section>
