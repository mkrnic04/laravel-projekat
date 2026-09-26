<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-dashboard">

    @include('partials.admin.topbar')

    <div class="d-flex">
        @include('partials.admin.sidebar')

        <main class="content-wrapper flex-grow-1 p-4">
            @include('partials.messages') @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>