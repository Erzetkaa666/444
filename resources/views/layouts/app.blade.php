<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('name','Laravel') }} | @yield('title')</title>

    {{-- 1. Bootstrap HARUS paling atas --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    {{-- 2. CSS global modern-mu --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{-- 3. Tailwind HARUS paling bawah --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @stack('styles')
</head>

<body>

    @include('layouts.nav')

    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success mt-3 mx-3">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3 mx-3">{{ session('error') }}</div>
        @endif

        @yield('content')
        @yield('custom_css')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
