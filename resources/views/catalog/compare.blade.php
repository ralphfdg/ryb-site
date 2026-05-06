@extends('layouts.app')

@section('content')
    <div class="bg-[#0f0f11] min-h-screen pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header & Navigation --}}
            <div class="flex justify-between items-center mb-8">
                <div>
                    <a href="{{ route('catalog.index') }}"
                        class="inline-flex items-center text-zinc-400 hover:text-white transition font-medium mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Catalog
                    </a>
                    <h1 class="text-3xl md:text-4xl font-bold text-white">Vehicle Comparison</h1>
                </div>

                {{-- Dynamic Counter --}}
                <div class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-zinc-300 text-sm backdrop-blur-md">
                    Comparing <span class="text-[#dc2626] font-bold">{{ count($cars) }}</span> Vehicles
                </div>
            </div>

            {{-- Comparison Matrix --}}
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl overflow-hidden shadow-2xl">

                {{-- Responsive Grid: 1 Label Column + X Car Columns --}}
                <div class="grid grid-cols-2 md:grid-cols-{{ count($cars) + 1 }} divide-x divide-white/10">

                    {{-- COLUMN 1: ROW LABELS (Hidden on very small screens) --}}
                    <div class="hidden md:flex flex-col justify-end p-6 bg-black/20">
                        <h3 class="text-xl font-bold text-white mb-6">Specifications</h3>
                    </div>

                    {{-- COLUMNS 2+: CAR HEADERS (Sticky) --}}
                    @foreach ($cars as $car)
                        <div
                            class="p-6 flex flex-col items-center text-center sticky top-0 bg-[#0f0f11]/90 backdrop-blur-xl z-10 border-b border-white/10">

                            {{-- Added 'relative' and 'group' to the image wrapper for the absolute button --}}
                            <div
                                class="w-full aspect-[4/3] rounded-xl overflow-hidden mb-4 border border-white/10 shadow-lg shadow-black/50 relative group">

                                {{-- Wishlist Star Icon Overlay --}}
                                @auth
                                    {{-- ADDED x-data HERE TO INITIALIZE ALPINE REACTIVITY --}}
                                    <button x-data @click.prevent="$store.wishlist.toggle({{ $car->id }})"
                                        class="absolute top-3 left-3 z-20 p-2 rounded-lg backdrop-blur-sm transition duration-300 shadow-lg border"
                                        :class="$store.wishlist.items.includes({{ $car->id }}) ?
                                            'bg-[#dc2626]/20 border-[#dc2626] text-[#dc2626]' :
                                            'bg-[#0f0f11]/80 border-white/10 text-zinc-400 hover:border-white/30 hover:text-white'">

                                        <svg class="w-4 h-4"
                                            :fill="$store.wishlist.items.includes({{ $car->id }}) ? 'currentColor' :
                                                'none'"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </button>
                                @endauth

                                <img src="{{ $car->getFirstMediaUrl('car_gallery') ?: 'https://placehold.co/600x400/09090b/27272a?text=Vehicle' }}"
                                    alt="{{ $car->model_name }}" class="w-full h-full object-cover">
                            </div>

                            <h2 class="text-lg font-bold text-white leading-tight">
                                {{ $car->brand->brand_name }} <br>
                                <span class="text-[#dc2626]">{{ $car->model_name }}</span>
                            </h2>
                            <p class="text-xl font-bold text-white mt-2 mb-4">₱{{ number_format($car->price, 2) }}</p>

                            <a href="{{ route('catalog.show', $car->id) }}"
                                class="w-full py-2 bg-white/10 hover:bg-white/20 border border-white/10 text-white font-semibold rounded-lg transition text-sm">
                                View Full Details
                            </a>
                        </div>
                    @endforeach

                    {{-- DATA ROWS: We wrap everything in a full-width container to maintain row alignment --}}
                    <div class="col-span-full border-t border-white/10"></div>

                    {{-- Row 1: Mileage --}}
                    <div
                        class="hidden md:flex items-center p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20">
                        Mileage</div>
                    @foreach ($cars as $car)
                        <div
                            class="p-4 text-center text-zinc-200 border-t border-white/10 md:border-t-0 flex flex-col md:block justify-center">
                            <span class="md:hidden text-xs text-zinc-500 uppercase block mb-1">Mileage</span>
                            {{ number_format($car->mileage) }} km
                        </div>
                    @endforeach

                    {{-- Row 2: Transmission --}}
                    <div
                        class="hidden md:flex items-center p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20 border-t border-white/10">
                        Transmission</div>
                    @foreach ($cars as $car)
                        <div
                            class="p-4 text-center text-zinc-200 border-t border-white/10 flex flex-col md:block justify-center">
                            <span class="md:hidden text-xs text-zinc-500 uppercase block mb-1">Transmission</span>
                            {{ $car->transmission }}
                        </div>
                    @endforeach

                    {{-- Row 3: Engine Type --}}
                    <div
                        class="hidden md:flex items-center p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20 border-t border-white/10">
                        Engine Type</div>
                    @foreach ($cars as $car)
                        <div
                            class="p-4 text-center text-zinc-200 border-t border-white/10 flex flex-col md:block justify-center">
                            <span class="md:hidden text-xs text-zinc-500 uppercase block mb-1">Engine</span>
                            {{ $car->carSpecification->engine_type ?? 'N/A' }}
                        </div>
                    @endforeach

                    {{-- Row 4: JSON Features (Premium) --}}
                    <div
                        class="hidden md:flex items-start p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20 border-t border-white/10">
                        Features</div>
                    @foreach ($cars as $car)
                        <div class="p-4 text-left border-t border-white/10">
                            <span class="md:hidden text-xs text-zinc-500 uppercase block mb-2 text-center">Features</span>
                            @if (!empty($car->features))
                                <ul class="space-y-2">
                                    @foreach ($car->features as $feature)
                                        <li class="flex items-start text-sm text-zinc-300">
                                            <svg class="w-4 h-4 text-[#dc2626] mr-2 mt-0.5 shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-zinc-500 italic text-center">Standard specs only</p>
                            @endif
                        </div>
                    @endforeach

                    {{-- Final Row: Call to Action --}}
                    <div class="col-span-full border-t border-white/10"></div>
                    <div class="hidden md:block p-6 bg-black/20"></div>
                    @foreach ($cars as $car)
                        <div class="p-6 bg-white/5">
                            <a href="{{ route('catalog.show', $car->id) }}#inquiry-form"
                                class="block w-full py-3 bg-[#dc2626] hover:bg-red-700 text-white font-bold text-center rounded-xl transition shadow-lg shadow-red-900/20">
                                Inquire Now
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
@endsection
