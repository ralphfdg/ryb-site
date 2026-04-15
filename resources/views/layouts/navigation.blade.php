<nav x-data="{ open: false }" class="fixed w-full z-50 bg-ryb-black/80 backdrop-blur-lg border-b border-ryb-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex items-center">
                <a href="/" class="flex items-center transition hover:opacity-80">
                    <img src="{{ asset('images/ryb-log.png') }}" alt="RYB Motors Logo"
                        class="h-16 w-auto object-contain">
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="{{ url('/catalog') }}" class="text-ryb-light/80 hover:text-ryb-red transition duration-150">Car
                    Catalog</a>
                <a href="{{ url('/about') }}"
                    class="text-ryb-light/80 hover:text-ryb-red transition duration-150">About</a>
                <a href="#" class="text-ryb-light/80 hover:text-ryb-red transition duration-150">Contact</a>

                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-5 py-2 bg-ryb-dark/50 hover:bg-ryb-dark border border-ryb-dark rounded-full text-ryb-light transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 bg-ryb-red text-white hover:bg-red-700 font-semibold rounded-full transition shadow-[0_0_15px_rgba(215,35,35,0.4)]">Log
                        in</a>
                @endauth
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="text-ryb-light hover:text-ryb-red focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-ryb-black border-b border-ryb-dark">
        <div class="pt-2 pb-3 space-y-1 px-4 text-center">
            <a href="#" class="block py-2 text-ryb-light/80 hover:text-ryb-red">Car Catalog</a>
            <a href="#" class="block py-2 text-ryb-light/80 hover:text-ryb-red">About</a>
            <a href="{{ route('login') ?? '#' }}" class="block py-2 text-ryb-red font-semibold">Log in</a>
        </div>
    </div>
</nav>
