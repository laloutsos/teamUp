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

    <style>
        .theme-toggle-sun {
            display: inline-block !important;
        }

        .theme-toggle-moon {
            display: none !important;
        }

        html.dark .theme-toggle-sun {
            display: none !important;
        }

        html.dark .theme-toggle-moon {
            display: inline-block !important;
        }
    </style>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>



    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <title>{{ $title ?? 'Welcome to TeamUp' }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
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

    <script>
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
