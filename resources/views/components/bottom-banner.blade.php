@props(['heading' => 'Looking for a rival?', 'subheading' => 'Discover your Capabilities'])

<section class="container mx-auto my-6">
    <div class="bg-blue-800 text-white rounded p-4 flex items-center justify-between flex-col md:flex-row gap-4">
        <div>
            <h2 class="text-xl font-semibold">{{$heading}}</h2>
            <p class="text-gray-200 text-lg mt-2"> {{$subheading}} </p>
        </div>  
        <x-button-link url="/games/create" icon="edit"> Create Game</x-button-link>
    </div>
</section>