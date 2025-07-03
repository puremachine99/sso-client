<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SmartID Client') }}</title>
    @vite('resources/css/app.css') {{-- Atau sesuaikan dengan build system kamu --}}
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-900 font-sans antialiased min-h-screen">

    @include('layouts.navigation')

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        @yield('content')
    </main>

</body>

</html>
