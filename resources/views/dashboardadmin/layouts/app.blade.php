<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Medical Services')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        .dropdown-menu.active {
            max-height: 300px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('dashboardadmin.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            @include('dashboardadmin.partials.header')
            
            <!-- Page Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>