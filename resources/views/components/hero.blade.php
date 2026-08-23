@props(['title' => 'Find Your Dream Team (or Enemy)'])

<section
    class="relative bg-cover bg-center bg-no-repeat min-h-[340px] md:h-80 flex items-center justify-center py-10 md:py-0 overflow-hidden">
    <!-- Instagram-style Gradient & Blur Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70 backdrop-blur-[2px]"></div>

    <div class="container mx-auto text-center z-10 px-4 max-w-3xl">
        <!-- Main Title -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl text-white font-extrabold tracking-tight mb-6 drop-shadow-md">
            {{ $title }}
        </h2>
        <x-search />



    </div>
</section>
