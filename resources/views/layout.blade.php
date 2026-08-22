<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="//unpkg.com/alpinejs" defer></script>

    <title>{{ $title ?? 'Welcome to TeamUp' }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100">
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
