<nav class="bg-ryb-darker border-b border-ryb-muted fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center transition hover:opacity-80">
                    <img src="{{ asset('images/ryb-log.png') }}" alt="RYB Motors Logo" class="h-16 w-auto object-contain">
                </a>
            </div>

            {{-- Links --}}
            <div class="hidden sm:flex items-center space-x-8">
                @php
                    $activeClass = 'text-ryb-red font-bold border-b-2 border-ryb-red pb-1';
                    $inactiveClass = 'text-ryb-light hover:text-white transition pb-1 border-b-2 border-transparent hover:border-ryb-muted';
                @endphp

                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? $activeClass : $inactiveClass }}">Home</a>
                <a href="{{ route('catalog.index') }}" class="{{ request()->routeIs('catalog.*') ? $activeClass : $inactiveClass }}">Catalog</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? $activeClass : $inactiveClass }}">About</a>
                <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? $activeClass : $inactiveClass }}">Contact</a>
                
                @guest
                    {{-- Shown ONLY to visitors not logged in --}}
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-ryb-red text-white font-bold rounded-lg hover:bg-ryb-red-dark transition shadow-md border border-ryb-red-dark">
                        Log in
                    </a>
                @endguest

                @auth
                    {{-- Shown ONLY to logged-in users --}}
                    @if(auth()->user()->hasRole('Admin'))
                        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 bg-ryb-dark text-white font-bold rounded-lg hover:bg-ryb-muted transition border border-ryb-muted">
                            Admin Portal
                        </a>
                    @else
                        {{-- Customer Dashboard Link --}}
                        <a href="{{ route('dashboard.appointments.index') }}" class="{{ request()->routeIs('dashboard.*') ? $activeClass : $inactiveClass }}">
                            Appointments & Inquiries
                        </a>
                    @endif

                    {{-- Properly configured POST Form for Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                        @csrf
                        <button type="submit" class="px-5 py-2 bg-ryb-red text-white font-bold rounded-lg hover:bg-ryb-red-dark transition shadow-md border border-ryb-red-dark cursor-pointer">
                            Log out
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>