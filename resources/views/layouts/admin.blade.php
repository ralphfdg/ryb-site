<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RYB Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#050505] text-gray-400 antialiased flex h-screen overflow-hidden" style="font-family: 'Inter', sans-serif;">

    <aside class="w-[260px] bg-[#0a0a0a] border-r border-[#1a1a1a] flex flex-col shrink-0">
        <!-- Logo Section -->
        <div class="h-32 flex flex-col items-center justify-center px-6 shrink-0 border-b border-[#1a1a1a]/50">
            <img src="{{ asset('images/ryb-log.png') }}" alt="RYB Logo" class="h-20 w-auto object-contain opacity-90">
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 space-y-2 overflow-y-auto pt-8">
            <p class="px-4 text-[10px] text-[#333] font-bold tracking-[0.2em] uppercase mb-4">Main Navigation</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg border {{ request()->routeIs('admin.dashboard') ? 'bg-[#e52a2a]/10 text-white border-[#e52a2a]/20' : 'border-transparent text-gray-500 hover:text-white hover:bg-[#1a1a1a]/50 transition-all' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                <span class="text-xs font-semibold tracking-wide">Dashboard</span>
            </a>

            <!-- Using wildcards (*) so the tab stays active when viewing or editing a car -->
            <a href="{{ route('admin.cars.index') }}" class="flex items-center px-4 py-3 rounded-lg border {{ request()->routeIs('admin.cars.*') ? 'bg-[#e52a2a]/10 text-white border-[#e52a2a]/20' : 'border-transparent text-gray-500 hover:text-white hover:bg-[#1a1a1a]/50 transition-all' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="text-xs font-semibold tracking-wide">Inventory</span>
            </a>

            <a href="{{ route('admin.sales.index') }}" class="flex items-center px-4 py-3 rounded-lg border {{ request()->routeIs('admin.sales.*') ? 'bg-[#e52a2a]/10 text-white border-[#e52a2a]/20' : 'border-transparent text-gray-500 hover:text-white hover:bg-[#1a1a1a]/50 transition-all' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span class="text-xs font-semibold tracking-wide">Sales</span>
            </a>

            <p class="px-4 text-[10px] text-[#333] font-bold tracking-[0.2em] uppercase mt-6 mb-4">People</p>

            <a href="{{ route('admin.customers.index') }}" class="flex items-center px-4 py-3 rounded-lg border {{ request()->routeIs('admin.customers.*') ? 'bg-[#e52a2a]/10 text-white border-[#e52a2a]/20' : 'border-transparent text-gray-500 hover:text-white hover:bg-[#1a1a1a]/50 transition-all' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="text-xs font-semibold tracking-wide">Customers</span>
            </a>

            <a href="{{ route('admin.inquiries.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg border {{ request()->routeIs('admin.inquiries.*') ? 'bg-[#e52a2a]/10 text-white border-[#e52a2a]/20' : 'border-transparent text-gray-500 hover:text-white hover:bg-[#1a1a1a]/50 transition-all' }}">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    <span class="text-xs font-semibold tracking-wide">Inquiries</span>
                </div>
                <!-- Dynamic Pending Inquiries Count -->
                @php
                    $pendingInquiries = \App\Models\Inquiry::where('status', 'New')->count();
                @endphp
                @if($pendingInquiries > 0)
                    <span class="w-4 h-4 rounded-full bg-[#e52a2a] text-white text-[9px] flex items-center justify-center font-bold">{{ $pendingInquiries }}</span>
                @endif
            </a>
        </nav>

        <!-- Dynamic User Profile Section -->
        <div class="p-6 border-t border-[#1a1a1a] flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <!-- Grabs the first letter of the authenticated user's name -->
                <div class="w-8 h-8 rounded bg-[#e52a2a] flex items-center justify-center text-white text-[10px] font-bold">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-[11px] font-bold text-white uppercase tracking-wider">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[9px] text-[#444] uppercase font-bold">{{ auth()->user()->getRoleNames()->first() ?? 'Staff' }}</p>
                </div>
            </div>
            
            <!-- Secure Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-[#666] hover:text-[#e52a2a] transition-colors" title="Logout">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto bg-[#050505] p-10">
        @yield('content')
    </main>

</body>
</html>