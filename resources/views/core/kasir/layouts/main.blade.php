<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/nbc-logo.PNG') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body class="bg-gray-100 dark:bg-gray-800">
    <!-- Navbar -->
    @include('core.partials.navigation')
    <!-- End of Navbar -->

    <div class="flex pt-20 overflow-hidden">
        @include('core.kasir.layouts.sidebar')
        <div id="main-content" class="relative w-full h-full overflow-y-auto lg:ml-64">
            <main>
                <!-- Main Content -->
                @yield('content')
                <!-- End of Content -->
            </main>
        </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>