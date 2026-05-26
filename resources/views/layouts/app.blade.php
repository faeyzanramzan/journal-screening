<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Journal Screening System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-indigo-700 via-blue-700 to-indigo-900 text-white hidden md:flex md:flex-col shadow-2xl">

            <!-- Logo -->
            <div class="p-6 border-b border-white/10">

                <div class="flex items-center gap-3">

                    <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center shadow-lg">
                        <span class="text-2xl font-bold text-white">
                            JS
                        </span>
                    </div>

                    <div>
                        <h1 class="text-lg font-bold leading-tight">
                            Data-Driven Predatory
                            Journal Screening System
                        </h1>

                        <p class="text-blue-100 mt-1 text-xs">
                            Trust Evaluation & Analysis
                        </p>
                    </div>

                </div>

            </div>

            <!-- Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2">

                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                {{ request()->routeIs('dashboard')
                    ? 'bg-white/20 shadow-md backdrop-blur-md'
                    : 'hover:bg-white/10' }}">

                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                        </svg>
                    </div>

                    <span class="text-sm font-medium">
                        Dashboard
                    </span>
                </a>

                <!-- Screen Journal -->
                <a href="{{ route('screen-journal.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 
                {{ request()->routeIs('screen-journal') ? 'bg-white/20 shadow-md backdrop-blur-md' : 'hover:bg-white/10' }}">

                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                        </svg>
                    </div>

                    <span class="text-sm font-medium">
                        Screen Journal
                    </span>
                </a>

                <!-- Results -->
                <a href="{{ route('results.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 
                {{ request()->routeIs('results.*') ? 'bg-white/20 shadow-md backdrop-blur-md' : 'hover:bg-white/10' }}">

                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check-fill" viewBox="0 0 16 16">
                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm6.854 7.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                        </svg>
                    </div>

                    <span class="text-sm font-medium">
                        Results
                    </span>
                </a>

                <!-- ADMIN ONLY -->
                @if(Auth::user()->role && Auth::user()->role->slug === 'admin')

                    <!-- Divider -->
                    <div class="pt-4 pb-2">
                        <p class="text-xs uppercase tracking-wider text-blue-200 font-semibold px-2">
                            Administration
                        </p>
                    </div>

                    <!-- Reports -->
                    <div x-data="{ openManagement: {{ request()->routeIs('reports.*') ? 'true' : 'false' }} }">

                        <button type="button"
                            @click="openManagement = !openManagement"
                            class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10">

                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z"/>
                                    </svg>
                                </div>

                                <span class="text-sm font-medium">
                                    Reports
                                </span>
                            </div>

                            <span class="text-xs" x-text="openManagement ? '▲' : '▼'"></span>
                        </button>

                        <div x-show="openManagement" x-cloak class="mt-2 ml-11 space-y-1">
                            <a href="{{ route('reports.index') }}"
                            class="block px-4 py-2 rounded-lg text-sm transition
                            {{ request()->routeIs('reports.index') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                                Screening Summary Report
                            </a>

                            <a href="{{ route('reports.country') }}"
                            class="block px-4 py-2 rounded-lg text-sm transition
                            {{ request()->routeIs('reports.country') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                                View Country Analysis
                            </a>

                            <a href="{{ route('reports.trend') }}"
                            class="block px-4 py-2 rounded-lg text-sm transition
                            {{ request()->routeIs('reports.trend') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                                View Screening Trend
                            </a>

                            <a href="{{ route('reports.risk') }}"
                            class="block px-4 py-2 rounded-lg text-sm transition
                            {{ request()->routeIs('reports.risk') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                                Risk Distribution
                            </a>

                            @if(Auth::user()->role && Auth::user()->role->slug === 'admin')
                                <a href="{{ route('reports.user-activity') }}"
                                class="block px-4 py-2 rounded-lg text-sm transition
                                {{ request()->routeIs('reports.user-activity') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                                    User Activity
                                </a>
                            @endif
                        </div>

                    </div>

                    <!-- Management -->
                    <div x-data="{ openManagement: {{ request()->routeIs('countries.*') ? 'true' : 'false' }} }">

                    <button type="button"
                        @click="openManagement = !openManagement"
                        class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10">

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z"/>
                                </svg>
                            </div>

                            <span class="text-sm font-medium">
                                Management
                            </span>
                        </div>

                        <span class="text-xs" x-text="openManagement ? '▲' : '▼'"></span>
                    </button>

                    <div x-show="openManagement" x-cloak class="mt-2 ml-11 space-y-1">
                        <a href="{{ route('countries.index') }}"
                        class="block px-4 py-2 rounded-lg text-sm transition
                        {{ request()->routeIs('countries.index') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                            Country
                        </a>

                        <a href="{{ route('users.index') }}"
                        class="block px-4 py-2 rounded-lg text-sm transition
                        {{ request()->routeIs('users.*') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                            User Management
                        </a>
                    </div>

                </div>

                
                   

                @endif

            </nav>

            <!-- User Card -->
            <div class="p-4 border-t border-white/10">

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 shadow-md">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <span class="text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>

                        <div>
                            <h3 class="font-semibold text-sm">
                                {{ Auth::user()->name }}
                            </h3>

                            <p class="text-blue-100 text-xs">
                                {{ Auth::user()->role->name ?? 'User' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <div>
                    @isset($header)
                        {{ $header }}
                    @else
                        <!-- <h2 class="font-semibold text-xl text-gray-800">
                            Dashboard
                        </h2> -->
                    @endisset
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 hover:underline">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <div class="p-6">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>