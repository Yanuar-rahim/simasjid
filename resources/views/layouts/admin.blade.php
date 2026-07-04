<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'SIMASJID Admin' }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-slate-50 font-sans">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main -->
    <div class="ml-72 min-h-screen">

        <!-- Topbar -->
        @include('partials.topbar')

        <!-- Content -->
        <main class="pt-28 px-8 pb-8">

            @yield('content')

        </main>

    </div>

    @stack('scripts')

</body>

</html>