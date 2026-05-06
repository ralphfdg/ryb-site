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
                    $inactiveClass =
                        'text-ryb-light hover:text-white transition pb-1 border-b-2 border-transparent hover:border-ryb-muted';
                @endphp

                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? $activeClass : $inactiveClass }}">Home</a>
                <a href="{{ route('catalog.index') }}"
                    class="{{ request()->routeIs('catalog.*') ? $activeClass : $inactiveClass }}">Catalog</a>
                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? $activeClass : $inactiveClass }}">About</a>
                <a href="{{ route('contact.index') }}"
                    class="{{ request()->routeIs('contact.*') ? $activeClass : $inactiveClass }}">Contact</a>

                @guest
                    {{-- Shown ONLY to visitors not logged in --}}
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 bg-ryb-red text-white font-bold rounded-lg hover:bg-ryb-red-dark transition shadow-md border border-ryb-red-dark">
                        Log in
                    </a>
                @endguest

                @auth
                    {{-- User Profile Dropdown (Alpine.js) --}}
                    <div x-data="{ open: false }" class="relative inline-block text-left ml-4">

                        {{-- Dropdown Toggle Button --}}
                        <button @click="open = !open" @click.away="open = false" type="button"
                            class="flex items-center gap-2 px-4 py-2 bg-ryb-dark text-ryb-light font-medium rounded-lg hover:text-white hover:bg-ryb-muted transition border border-ryb-muted cursor-pointer shadow-sm">
                            <span>{{ auth()->user()->name }}</span>
                            {{-- Chevron Icon --}}
                            <svg class="w-4 h-4 text-ryb-light transition-transform duration-200"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu Panel --}}
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 origin-top-right rounded-xl bg-ryb-darker border border-ryb-muted shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden"
                            style="display: none;">

                            <div class="py-1">
                                @if (auth()->user()->hasRole('Admin'))
                                    {{-- Admin Controls --}}
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="block px-4 py-3 text-sm text-ryb-light hover:bg-ryb-muted hover:text-white transition">
                                        Admin Portal
                                    </a>
                                @else
                                    {{-- Customer Controls --}}
                                    <a href="{{ route('dashboard.appointments.index') }}"
                                        class="block px-4 py-3 text-sm text-ryb-light hover:bg-ryb-muted hover:text-white transition">
                                        Appointments & Inquiries
                                    </a>

                                    {{-- WISH LIST DROPDOWN ITEM WITH ALPINE BADGE --}}
                                    <a href="{{ route('dashboard.wishlist.index') }}"
                                        class="flex items-center justify-between px-4 py-3 text-sm text-ryb-light hover:bg-ryb-muted hover:text-white transition group">
                                        <span>My Wishlist</span>
                                        <span x-data x-show="$store.wishlist.count() > 0" x-text="$store.wishlist.count()"
                                            style="display: none;"
                                            class="bg-ryb-red text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-[0_0_10px_rgba(220,38,38,0.5)] group-hover:scale-110 transition-transform">
                                        </span>
                                    </a>

                                    <a href="{{ route('dashboard.profile') }}"
                                        class="block px-4 py-3 text-sm text-ryb-light hover:bg-ryb-muted hover:text-white transition">
                                        Profile Settings
                                    </a>
      
                                @endif

                                {{-- Divider --}}
                                <div class="border-t border-ryb-muted my-1"></div>

                                {{-- Logout Action --}}
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-3 text-sm text-ryb-red font-medium hover:bg-ryb-muted transition cursor-pointer">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
