@extends('layouts.app')

@section('content')
<div class="bg-ryb-darker min-h-screen w-full select-none" x-data="{ heroTitle: 'Premium Vehicles. Unmatched Trust.' }">

    {{-- 1 & 5. HERO & MARKETING TEXT SECTION --}}
    <div class="relative h-[85vh] flex items-center justify-center overflow-hidden bg-ryb-darker">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/home/home-01.jpg') }}" alt="Showroom" class="w-full h-full object-cover opacity-50 mix-blend-luminosity">
            <div class="absolute inset-0 bg-gradient-to-t from-ryb-darker via-ryb-darker/70 to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-10">
            <span class="text-ryb-red font-bold uppercase tracking-[0.3em] text-sm mb-4 block">Engineered for Excellence</span>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight" x-text="heroTitle"></h1>
            <p class="text-lg md:text-xl text-ryb-light mb-6 max-w-3xl mx-auto leading-relaxed">
                Beyond transactions, we build lasting relationships. Discover a curated collection of 
                <span class="text-white font-bold underline decoration-ryb-red">meticulously inspected vehicles</span> 
                tailored for the modern driver who demands quality.
            </p>
            <p class="text-sm md:text-base text-ryb-light/70 mb-10 max-w-2xl mx-auto">
                No hidden fees. No aggressive sales tactics. Just transparent pricing and a seamless buying experience from our garage to yours.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('catalog.index') }}" class="px-8 py-4 bg-ryb-red text-white font-bold rounded-full hover:bg-ryb-red-dark transition shadow-lg shadow-black/50 border border-ryb-red-dark">
                    Explore Inventory
                </a>
                <a href="/contact" class="px-8 py-4 border border-ryb-muted text-ryb-light font-semibold rounded-full hover:bg-ryb-muted hover:text-white transition backdrop-blur-sm">
                    Book a Viewing
                </a>
            </div>
        </div>
    </div>

    {{-- 2. BRAND LOGO MARQUEE --}}
    <div class="border-y border-ryb-muted bg-ryb-dark py-8 overflow-hidden">
        <div class="flex space-x-12 animate-marquee whitespace-nowrap opacity-60 hover:opacity-100 transition duration-500 items-center w-max">
            @foreach($brands->concat($brands) as $brand)
                <div class="flex items-center gap-4">
                    @if($brand->hasMedia('brand_logos'))
                        <img src="{{ $brand->getFirstMediaUrl('brand_logos') }}" alt="{{ $brand->brand_name }}" class="h-10 w-auto object-contain grayscale">
                    @else
                        <span class="text-2xl font-bold text-ryb-light tracking-widest">{{ strtoupper($brand->brand_name) }}</span>
                    @endif
                    <span class="text-ryb-red text-xl font-bold mx-4">•</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 3. SCROLLABLE FEATURED INVENTORY (Native CSS Fix) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 bg-ryb-darker">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-3xl font-bold text-white uppercase italic">Featured <span class="text-ryb-red">Inventory</span></h2>
            <p class="hidden md:block text-ryb-light/50 text-sm italic">Scroll to view more →</p>
        </div>
        
        {{-- Added native scrollbar styling so desktop users can click and drag the bar --}}
        <div class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory scroll-smooth" style="scrollbar-width: thin; scrollbar-color: #dc2626 #18181b;">
            @forelse ($featuredCars as $car)
                <div class="snap-start shrink-0 w-[85vw] max-w-[320px] md:max-w-[400px] group bg-ryb-dark border border-ryb-muted rounded-2xl overflow-hidden hover:border-ryb-red/50 transition duration-300 shadow-xl shadow-black/40">
                    <div class="relative overflow-hidden bg-ryb-darker h-56">
                        <img src="{{ $car->getFirstMediaUrl('images') ?: 'https://placehold.co/600x400/18181b/27272a?text=Vehicle' }}"
                             class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 right-4 bg-ryb-darker/90 backdrop-blur px-3 py-1 rounded-full border border-ryb-muted">
                            <span class="text-[10px] font-bold text-white uppercase tracking-widest">{{ $car->status }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white">{{ $car->brand->brand_name ?? 'Brand' }} {{ $car->model_name }}</h3>
                        <p class="text-xs text-ryb-light/60 mb-4 font-mono">VIN: {{ $car->specification->vin_number ?? 'N/A' }}</p>
                        <div class="flex justify-between items-center mt-2 mb-6">
                            <p class="text-ryb-red font-bold text-xl">₱{{ number_format($car->price) }}</p>
                            <span class="text-xs text-white/40 italic">{{ $car->year }} | {{ $car->transmission }}</span>
                        </div>
                        <a href="{{ route('catalog.show', $car->id) }}"
                           class="flex justify-center w-full px-5 py-3 bg-ryb-darker border border-ryb-muted text-ryb-light text-sm font-bold rounded-lg hover:bg-ryb-red hover:border-ryb-red hover:text-white transition uppercase tracking-widest">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-ryb-light/50 col-span-3 text-center py-10 w-full border border-dashed border-ryb-muted rounded-2xl">Inventory updating...</p>
            @endforelse
        </div>
    </div>

    {{-- 6. RECENTLY DELIVERED (CSS Auto-Marquee Carousel) --}}
    <div class="bg-ryb-dark border-y border-ryb-muted py-24 shadow-inner overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white mb-2">Recently <span class="text-ryb-red">Delivered</span></h2>
                <p class="text-ryb-light/50 text-sm italic">Hover to pause and read what our clients are saying</p>
            </div>
        </div>
            
        <div class="flex overflow-hidden group">
            {{-- Duplicating the array items so the marquee seamlessly loops without blank spaces. Pause on hover. --}}
            <div class="flex space-x-6 animate-marquee group-hover:[animation-play-state:paused] min-w-max px-6">
                @foreach (array_merge($testimonials, $testimonials) as $index => $t)
                <div class="w-[300px] md:w-[380px] shrink-0 bg-ryb-darker border border-ryb-muted rounded-2xl overflow-hidden shadow-2xl flex flex-col whitespace-normal">
                    {{-- 1 Image Placeholder --}}
                    <div class="h-48 bg-ryb-darker relative">
                        <img src="{{ asset('images/home/recent' . (($index % 6) + 1) . '.png') }}" alt="Sold Unit" class="w-full h-full object-cover opacity-100">
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            {{-- Star Ratings --}}
                            <div class="flex text-ryb-red mb-4">
                                @for($i=0; $i<$t['rating']; $i++) 
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            {{-- Comments --}}
                            <p class="text-ryb-light text-sm italic mb-6 leading-relaxed">"{{ $t['comment'] }}"</p>
                        </div>
                        <div class="border-t border-ryb-muted pt-4 mt-auto">
                            <p class="text-white font-bold text-sm">{{ $t['name'] }}</p>
                            <p class="text-ryb-red text-[10px] font-bold uppercase tracking-widest mt-1">Verified Owner</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 4. WHERE WE ARE SECTION --}}
    <div class="bg-ryb-darker py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold text-white mb-6 italic">Visit <span class="text-ryb-red">RYB Garage</span></h2>
                <p class="text-ryb-light text-lg mb-8 leading-relaxed">
                    Conveniently located in Angeles City, our showroom is designed for a premium viewing experience. Stop by to see our current inventory in person, inspect the vehicles, and speak with our automotive specialists about your next upgrade.
                </p>
                <div class="space-y-6">
                    <div class="flex items-start gap-4 text-ryb-light bg-ryb-dark/50 p-4 rounded-xl border border-ryb-muted">
                        <svg class="w-6 h-6 text-ryb-red mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <div>
                            <span class="text-white font-bold block mb-1">ADDRESS:</span>
                            <span class="text-sm">123 McArthur Highway, Angeles City<br>Pampanga, Philippines 2009</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 text-ryb-light bg-ryb-dark/50 p-4 rounded-xl border border-ryb-muted">
                        <svg class="w-6 h-6 text-ryb-red mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <span class="text-white font-bold block mb-1">HOURS:</span>
                            <span class="text-sm">Mon - Sat | 9:00 AM - 6:00 PM<br>Sunday | By Appointment Only</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-3xl overflow-hidden border border-ryb-muted h-[400px] shadow-2xl shadow-black relative group">
                <div class="absolute inset-0 bg-ryb-red/10 group-hover:bg-transparent transition duration-500 z-10 pointer-events-none"></div>
                {{-- Map Placeholder --}}
                <iframe class="w-full h-full opacity-100 contrast-125" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3851.353457173617!2d120.5901!3d15.1444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f26ab4500001%3A0xc3b832b85e1975e5!2sAngeles%20University%20Foundation!5e0!3m2!1sen!2sph!4v1710000000000!5m2!1sen!2sph" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection