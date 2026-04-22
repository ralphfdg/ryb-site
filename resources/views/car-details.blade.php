@extends('layouts.app')

@section('content')
@php
    /**
     * PRINCE — Car Details Page
     * Dark-mode glassmorphism aesthetic.
     * Yellow (#F5C518) is the primary branding color for buttons & interactive elements.
     * Backend will inject a real $car Eloquent model. Dummy data is used here for simulation.
     */
    $car = $car ?? [
        'id'          => 1,
        'brand'       => 'Tesla',
        'model'       => 'Model 3',
        'year'        => 2024,
        'price'       => 45990,
        'mileage'     => 12450,
        'status'      => 'Available',
        'description' => 'The Tesla Model 3 is an all-electric sedan that combines performance, range, and
                          cutting-edge technology. With over-the-air updates and a minimalist interior centered
                          around a 15.4-inch touchscreen, it redefines what a modern car can be.',
        'images'      => [
            'https://placehold.co/1200x700/1a1a1a/f5eded?text=Tesla+Model+3+Front',
            'https://placehold.co/1200x700/2a2020/f5eded?text=Tesla+Model+3+Side',
            'https://placehold.co/1200x700/1a1a1a/f5eded?text=Tesla+Model+3+Rear',
            'https://placehold.co/1200x700/2a2020/f5eded?text=Interior+Dashboard',
        ],
        'specs' => [
            ['label' => 'Engine',        'value' => 'Dual Motor Electric'],
            ['label' => 'Range',         'value' => '358 mi (EPA est.)'],
            ['label' => '0–60 mph',      'value' => '3.1 seconds'],
            ['label' => 'Top Speed',     'value' => '162 mph'],
            ['label' => 'Drivetrain',    'value' => 'All-Wheel Drive'],
            ['label' => 'Seating',       'value' => '5 Adults'],
            ['label' => 'Cargo Space',   'value' => '23 cu ft'],
            ['label' => 'Charging',      'value' => 'Supercharger V3'],
            ['label' => 'Autopilot',     'value' => 'Standard'],
            ['label' => 'Color',         'value' => 'Midnight Silver Metallic'],
            ['label' => 'Transmission',  'value' => 'Single-Speed Fixed Gear'],
            ['label' => 'VIN',           'value' => '5YJ3E1EA1RF123456'],
        ],
    ];
@endphp

<div x-data="carDetailsController()" class="bg-ryb-black min-h-screen">

    {{-- ===== BREADCRUMB ===== --}}
    <div class="pt-28 pb-4 border-b border-ryb-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm text-ryb-light/50">
                <a href="/" class="hover:text-ryb-yellow transition">Home</a>
                <span>/</span>
                <a href="/catalog" class="hover:text-ryb-yellow transition">Catalog</a>
                <span>/</span>
                <span class="text-ryb-light">{{ $car['year'] }} {{ $car['brand'] }} {{ $car['model'] }}</span>
            </nav>
        </div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- =========================================
                 LEFT COL — Swipeable Image Gallery
                 ========================================= --}}
            <div>
                {{-- Main Image Viewer --}}
                <div class="relative rounded-2xl overflow-hidden bg-ryb-dark/20 border border-ryb-dark aspect-[16/10]">
                    <img
                        :src="images[activeImage]"
                        alt="Car image"
                        class="w-full h-full object-cover transition-opacity duration-400"
                        :class="{ 'opacity-0': transitioning, 'opacity-100': !transitioning }">

                    {{-- Status badge overlay --}}
                    @if($car['status'] === 'Available')
                        <span class="absolute top-4 left-4 px-3 py-1 bg-green-500/20 text-green-400
                                     border border-green-500/30 rounded-full text-xs font-bold uppercase
                                     tracking-wider backdrop-blur-md">Available</span>
                    @else
                        <span class="absolute top-4 left-4 px-3 py-1 bg-ryb-yellow/20 text-ryb-yellow
                                     border border-ryb-yellow/30 rounded-full text-xs font-bold uppercase
                                     tracking-wider backdrop-blur-md">{{ $car['status'] }}</span>
                    @endif

                    {{-- Prev / Next Arrows --}}
                    <button @click="prevImage()"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center
                               bg-ryb-black/60 backdrop-blur-sm rounded-full border border-ryb-dark/60
                               hover:border-ryb-yellow hover:text-ryb-yellow text-ryb-light transition">
                        ‹
                    </button>
                    <button @click="nextImage()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center
                               bg-ryb-black/60 backdrop-blur-sm rounded-full border border-ryb-dark/60
                               hover:border-ryb-yellow hover:text-ryb-yellow text-ryb-light transition">
                        ›
                    </button>

                    {{-- Dot indicators --}}
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                        <template x-for="(img, i) in images" :key="i">
                            <button @click="goToImage(i)"
                                class="w-2 h-2 rounded-full transition-all duration-300"
                                :class="activeImage === i
                                    ? 'bg-ryb-yellow w-5'
                                    : 'bg-ryb-light/30 hover:bg-ryb-light/60'">
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Thumbnail Strip --}}
                <div class="mt-4 grid grid-cols-4 gap-3">
                    @foreach ($car['images'] as $idx => $thumb)
                        <button
                            @click="goToImage({{ $idx }})"
                            class="aspect-[4/3] rounded-xl overflow-hidden border-2 transition duration-200"
                            :class="activeImage === {{ $idx }}
                                ? 'border-ryb-yellow shadow-[0_0_12px_rgba(245,197,24,0.4)]'
                                : 'border-ryb-dark hover:border-ryb-light/40'">
                            <img src="{{ $thumb }}" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition">
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- =========================================
                 RIGHT COL — Info, Price & CTA
                 ========================================= --}}
            <div class="flex flex-col">

                {{-- Year + Make + Model --}}
                <p class="text-ryb-light/50 font-mono text-sm mb-1 uppercase tracking-widest">
                    {{ $car['year'] }} • {{ number_format($car['mileage']) }} mi
                </p>
                <h1 class="text-3xl md:text-4xl font-bold text-ryb-light leading-tight mb-2">
                    {{ $car['brand'] }}
                    <span class="text-ryb-light/70 font-medium">{{ $car['model'] }}</span>
                </h1>

                {{-- Price --}}
                <p class="text-4xl font-bold text-ryb-yellow mt-4 mb-2">
                    ${{ number_format($car['price']) }}
                </p>
                <p class="text-ryb-light/40 text-sm mb-8">
                    Exclusive of registration & taxes. Financing available upon inquiry.
                </p>

                {{-- Glassmorphism quick-stat strip --}}
                <div class="grid grid-cols-3 gap-3 mb-8">
                    <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-xl p-4 text-center">
                        <p class="text-xs text-ryb-light/50 uppercase tracking-wider mb-1">Year</p>
                        <p class="text-ryb-light font-bold text-lg">{{ $car['year'] }}</p>
                    </div>
                    <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-xl p-4 text-center">
                        <p class="text-xs text-ryb-light/50 uppercase tracking-wider mb-1">Mileage</p>
                        <p class="text-ryb-light font-bold text-lg">{{ number_format($car['mileage']) }}</p>
                    </div>
                    <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-xl p-4 text-center">
                        <p class="text-xs text-ryb-light/50 uppercase tracking-wider mb-1">Status</p>
                        <p class="text-ryb-yellow font-bold text-lg">{{ $car['status'] }}</p>
                    </div>
                </div>

                {{-- Description --}}
                <p class="text-ryb-light/70 leading-relaxed mb-8 text-sm">
                    {{ $car['description'] }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                    {{-- PRIMARY: Yellow button --}}
                    <a href="/contact?car={{ $car['id'] }}"
                        class="flex-1 text-center py-4 px-6 bg-ryb-yellow text-ryb-black font-bold rounded-xl
                               hover:bg-ryb-yellow-dark transition
                               shadow-[0_0_24px_rgba(245,197,24,0.4)] hover:shadow-[0_0_32px_rgba(245,197,24,0.6)]">
                        Inquire About This Car
                    </a>
                    {{-- SECONDARY: Glass ghost button --}}
                    <a href="/catalog"
                        class="flex-1 text-center py-4 px-6 bg-ryb-dark/30 backdrop-blur-sm text-ryb-light font-semibold
                               rounded-xl border border-ryb-dark hover:border-ryb-yellow/50 hover:text-ryb-yellow
                               transition">
                        ← Back to Catalog
                    </a>
                </div>
            </div>
        </div>

        {{-- ===== SPECIFICATIONS TABLE ===== --}}
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-ryb-light mb-6">
                Vehicle <span class="text-ryb-yellow">Specifications</span>
            </h2>

            <div class="bg-ryb-dark/20 backdrop-blur-lg border border-ryb-dark rounded-2xl overflow-hidden">
                <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-ryb-dark">
                    @foreach (array_chunk($car['specs'], (int) ceil(count($car['specs']) / 2)) as $col)
                        <div class="divide-y divide-ryb-dark">
                            @foreach ($col as $spec)
                                <div class="flex justify-between items-center px-6 py-4 hover:bg-ryb-dark/30 transition">
                                    <span class="text-ryb-light/50 text-sm">{{ $spec['label'] }}</span>
                                    <span class="text-ryb-light font-semibold text-sm text-right">{{ $spec['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== STICKY MOBILE CTA BAR ===== --}}
        <div class="fixed bottom-0 left-0 right-0 z-50 lg:hidden
                    bg-ryb-black/80 backdrop-blur-xl border-t border-ryb-dark px-4 py-3 flex gap-3">
            <div class="flex-1">
                <p class="text-xs text-ryb-light/50">Asking Price</p>
                <p class="text-ryb-yellow font-bold text-lg leading-tight">${{ number_format($car['price']) }}</p>
            </div>
            <a href="/contact?car={{ $car['id'] }}"
                class="px-6 py-3 bg-ryb-yellow text-ryb-black font-bold rounded-xl
                       hover:bg-ryb-yellow-dark transition shadow-[0_0_20px_rgba(245,197,24,0.4)]">
                Inquire Now
            </a>
        </div>
        {{-- Bottom padding so sticky bar doesn't overlap content on mobile --}}
        <div class="h-20 lg:hidden"></div>

    </div>
</div>

{{-- ===== ALPINE.JS CONTROLLER ===== --}}
<script>
    function carDetailsController() {
        return {
            images: @json($car['images']),
            activeImage: 0,
            transitioning: false,

            goToImage(index) {
                if (index === this.activeImage) return;
                this.transitioning = true;
                setTimeout(() => {
                    this.activeImage = index;
                    this.transitioning = false;
                }, 200);
            },

            nextImage() {
                this.goToImage((this.activeImage + 1) % this.images.length);
            },

            prevImage() {
                this.goToImage((this.activeImage - 1 + this.images.length) % this.images.length);
            },
        };
    }
</script>
@endsection
