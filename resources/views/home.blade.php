@extends('layouts.app')

@section('content')
    <div class="bg-ryb-darker min-h-screen w-full" x-data="homeController()">

        {{-- ===== HERO SECTION (Base Level) ===== --}}
        <div class="relative h-[85vh] flex items-center justify-center overflow-hidden bg-ryb-darker">
            <div class="absolute inset-0 z-0">
                <img src="https://placehold.co/1920x1080/09090b/18181b" alt="Showroom Background"
                    class="w-full h-full object-cover opacity-50 mix-blend-luminosity">
                <div class="absolute inset-0 bg-gradient-to-t from-ryb-darker via-ryb-darker/60 to-transparent"></div>
            </div>

            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-10">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight" x-text="heroTitle"></h1>
                <p class="text-lg md:text-xl text-ryb-light mb-10 max-w-2xl mx-auto">Premium vehicles, transparent
                    pricing, and a seamless buying experience.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('catalog.index') }}"
                        class="px-8 py-4 bg-ryb-red text-white font-bold rounded-full hover:bg-ryb-red-dark transition shadow-lg shadow-black/50 border border-ryb-red-dark">
                        View Inventory
                    </a>
                    <a href="/contact"
                        class="px-8 py-4 border border-ryb-muted text-ryb-light font-semibold rounded-full hover:bg-ryb-muted hover:text-white transition backdrop-blur-sm">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>

        {{-- ===== QUICK SEARCH BAR (Elevated Container) ===== --}}
        <div class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-16">
            {{-- Container is mid-level, borders are muted-level --}}
            <div class="bg-ryb-dark border border-ryb-muted rounded-2xl p-6 shadow-2xl shadow-black/80">
                <form action="{{ route('catalog.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Make / Brand</label>
                        {{-- Inputs are base-level (darker) so they look pressed-in --}}
                        <select name="filter[brand_id]"
                            class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition cursor-pointer">
                            <option value="">All Brands</option>
                            <option value="1">Toyota</option>
                            <option value="2">Tesla</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Max Price</label>
                        <select name="filter[price]"
                            class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition cursor-pointer">
                            <option value="">Any Price</option>
                            <option value="30000">Under $30,000</option>
                            <option value="50000">Under $50,000</option>
                            <option value="80000">Under $80,000</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Availability</label>
                        <select name="filter[status]"
                            class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition cursor-pointer">
                            <option value="Available">Available Now</option>
                            <option value="Reserved">Reserved</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="w-full bg-ryb-red text-white font-bold py-3 rounded-lg hover:bg-ryb-red-dark transition border border-ryb-red-dark">
                        Search Vehicles
                    </button>
                </form>
            </div>
        </div>

        {{-- ===== BRAND MARQUEE (Mid Level) ===== --}}
        {{-- Alternating background to distinguish from the Hero --}}
        <div class="border-y border-ryb-muted bg-ryb-dark py-8 overflow-hidden shadow-inner">
            <div class="flex space-x-12 animate-marquee whitespace-nowrap opacity-50 hover:opacity-100 transition duration-500">
                @for ($i = 0; $i < 2; $i++)
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">TOYOTA</span>
                    <span class="text-ryb-red text-2xl font-bold tracking-widest">•</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">HONDA</span>
                    <span class="text-ryb-red text-2xl font-bold tracking-widest">•</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">TESLA</span>
                    <span class="text-ryb-red text-2xl font-bold tracking-widest">•</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">FORD</span>
                    <span class="text-ryb-red text-2xl font-bold tracking-widest">•</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">BMW</span>
                    <span class="text-ryb-red text-2xl font-bold tracking-widest">•</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">MERCEDES</span>
                    <span class="text-ryb-red text-2xl font-bold tracking-widest">•</span>
                @endfor
            </div>
        </div>

        {{-- ===== FEATURED INVENTORY (Base Level) ===== --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 bg-ryb-darker">
            <h2 class="text-3xl font-bold text-white mb-8">Featured <span class="text-ryb-red">Inventory</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($featuredCars as $car)
                    {{-- Cards are elevated to Mid Level to pop off the Base Level background --}}
                    <div class="group bg-ryb-dark border border-ryb-muted rounded-2xl overflow-hidden hover:border-ryb-red/50 transition duration-300 shadow-xl shadow-black/40">
                        <div class="relative overflow-hidden bg-ryb-darker">
                            <img src="{{ $car->getFirstMediaUrl('images') ?: 'https://placehold.co/600x400/18181b/27272a?text=Vehicle' }}"
                                class="w-full h-56 object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition duration-500">
                            <div class="absolute top-4 right-4 bg-ryb-darker/90 backdrop-blur px-3 py-1 rounded-full border border-ryb-muted">
                                <span class="text-xs font-bold text-white">Available</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white">{{ $car->brand->brand_name ?? 'Unknown Brand' }}</h3>
                            <p class="text-sm text-ryb-light/60 mb-2">VIN: {{ $car->specification->vin_number ?? 'N/A' }}</p>
                            <p class="text-ryb-red font-bold text-xl mt-2">${{ number_format($car->price, 2) }}</p>
                            <a href="{{ route('catalog.show', $car->id) }}"
                                class="mt-6 flex justify-center w-full px-5 py-3 bg-ryb-darker border border-ryb-muted text-ryb-light text-sm font-bold rounded-lg hover:bg-ryb-red hover:border-ryb-red hover:text-white transition">
                                View Details →
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-ryb-light/50 col-span-3 text-center py-10 border border-dashed border-ryb-muted rounded-2xl">Inventory is currently being updated.</p>
                @endforelse
            </div>
        </div>

        {{-- ===== RECENTLY DELIVERED (Mid Level) ===== --}}
        {{-- Section background changes back to Mid Level to create a distinct boundary --}}
        <div class="bg-ryb-dark border-y border-ryb-muted py-20 shadow-inner">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-white mb-8">Recently <span class="text-ryb-red">Delivered</span></h2>

                <div class="flex overflow-x-auto space-x-6 pb-8 snap-x scrollbar-hide">
                    @forelse ($soldCars as $sold)
                        {{-- Cards drop down to Base Level to pop against the Mid Level background --}}
                        <div class="min-w-[300px] md:min-w-[400px] bg-ryb-darker border border-ryb-muted rounded-2xl overflow-hidden snap-center shrink-0 shadow-lg shadow-black/50">
                            <img src="{{ $sold->getFirstMediaUrl('images') ?: 'https://placehold.co/400x300/18181b/27272a?text=Sold' }}"
                                class="w-full h-56 object-cover opacity-60 grayscale hover:grayscale-0 transition duration-500">
                            <div class="p-5">
                                <h3 class="font-bold text-white">{{ $sold->brand->brand_name ?? 'Premium Vehicle' }}</h3>
                                <p class="text-sm text-ryb-red mt-1 font-semibold">✓ Delivered</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-ryb-light/50">No recent deliveries to show.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ===== STATS (Base Level with gradient) ===== --}}
        <div class="bg-gradient-to-b from-ryb-darker to-black py-16" x-data="statsCounter()">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-ryb-muted">
                    <div class="p-4">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                            <span x-text="vehiclesDelivered">0</span>+
                        </div>
                        <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Delivered</p>
                    </div>
                    <div class="p-4">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                            <span x-text="partneredBrands">0</span>+
                        </div>
                        <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Brands</p>
                    </div>
                    <div class="p-4">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                            <span x-text="happyClients">0</span>%
                        </div>
                        <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Happy Clients</p>
                    </div>
                    <div class="p-4">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                            <span x-text="yearsExperience">0</span>
                        </div>
                        <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Years Exp.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection