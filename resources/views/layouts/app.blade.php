<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Éclairora</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cream-pastel text-dark-cocoa">

    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Page Content --}}
    <main class="pt-12 pb-10 px-4 md:px-10">
        {{ $slot }}
    </main>

</body>
</html>
