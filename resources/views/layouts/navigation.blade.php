<nav class="bg-ryb-darker border-b border-ryb-muted fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="/" class="flex items-center transition hover:opacity-80">
                    <img src="{{ asset('images/ryb-log.png') }}" alt="RYB Motors Logo" class="h-16 w-auto object-contain">

                </a>
            </div>

            {{-- Links --}}
            <div class="hidden sm:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-ryb-light hover:text-white transition">Home</a>
                <a href="{{ route('catalog.index') }}" class="text-ryb-light hover:text-white transition">Catalog</a>
                <a href="{{ route('about') }}" class="text-ryb-light hover:text-white transition">About</a>
                
                @guest
                    {{-- Shown ONLY to visitors not logged in --}}
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-ryb-red text-white font-bold rounded-lg hover:bg-ryb-red-dark transition shadow-md border border-ryb-red-dark">
                        Log in
                    </a>
                @endguest

                @auth
                    {{-- Shown ONLY to logged-in users (Admin or Customer) --}}
                    @if(auth()->user()->hasRole('Admin'))
                        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 bg-ryb-dark text-white font-bold rounded-lg hover:bg-ryb-muted transition border border-ryb-muted">
                            Admin Portal
                        </a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="px-5 py-2 bg-ryb-dark text-white font-bold rounded-lg hover:bg-ryb-muted transition border border-ryb-muted">
                            My Dashboard
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>