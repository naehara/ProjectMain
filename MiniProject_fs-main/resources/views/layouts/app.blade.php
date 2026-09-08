<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pengurusan Jadual Waktu')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between p-4 shadow-lg">
            <div>
                <!-- System Logo / Title -->
                <div class="flex items-center space-x-3 mb-8 px-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <i class="fa-solid fa-calendar-days text-xl"></i>
                    </div>
                    <span class="text-xl font-bold tracking-wide">Sistem PJW</span>
                </div>

                <!-- Navigation Links Dynamic -->
                <nav class="space-y-1">
                    @yield('sidebar_menu')
                </nav>
            </div>

            <!-- User Info & Logout -->
            <div class="border-t border-slate-700 pt-4">
                <div class="flex items-center justify-between px-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center font-bold">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium leading-none">{{ auth()->user()->name ?? 'Admin User' }}</p>
                            <p class="text-xs text-slate-400 capitalize">{{ auth()->user()->role ?? 'Admin' }}</p>
                        </div>
                    </div>
                    
                    <!-- Logout Form (Icon Pintu) -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-400 transition cursor-pointer" title="Log Keluar">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-800">@yield('header_title', 'Dashboard')</h1>
                <div class="text-sm text-gray-500">
                    Sesi Semasa: <span class="font-bold text-indigo-600">II 2026/2027</span>
                </div>
            </header>

            <!-- Page Dynamic Content -->
            <main class="p-8">
                @yield('content')
            </main>

        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>