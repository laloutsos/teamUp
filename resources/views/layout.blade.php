<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Welcome to TeamUp' }}</title>

    <!-- External Assets & Frameworks -->
    <link rel="icon" type="image/png" href="{{ asset('/images/teamup.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>

    @vite('resources/css/app.css')

    <!-- Custom CSS Assets -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/theme-toggle.css') }}" />

    <!-- Custom JS Assets -->
    <script src="{{ asset('js/theme-toggle.js') }}"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-200">
    <x-header />

    @if (request()->is('/'))
        @auth
            <x-hero />
        @endauth
    @endif

    <main class="container mx-auto p-4 mt-4">
        {{-- Display alert messages --}}
        <x-alert type="success" :message="session('success')" />
        {{ $slot }}
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
