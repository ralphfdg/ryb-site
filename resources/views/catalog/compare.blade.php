@extends('layouts.app')

@section('content')
<div class="bg-[#0f0f11] min-h-screen pt-24 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header & Navigation --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-zinc-400 hover:text-white transition font-medium mb-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
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
                @foreach($cars as $car)
                    <div class="p-6 flex flex-col items-center text-center sticky top-0 bg-[#0f0f11]/90 backdrop-blur-xl z-10 border-b border-white/10">
                        <div class="w-full aspect-[4/3] rounded-xl overflow-hidden mb-4 border border-white/10 shadow-lg shadow-black/50">
                            <img src="{{ $car->getFirstMediaUrl('car_gallery') ?: 'https://placehold.co/600x400/09090b/27272a?text=Vehicle' }}" 
                                 alt="{{ $car->model_name }}" class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-lg font-bold text-white leading-tight">
                            {{ $car->brand->brand_name }} <br>
                            <span class="text-[#dc2626]">{{ $car->model_name }}</span>
                        </h2>
                        <p class="text-xl font-bold text-white mt-2 mb-4">₱{{ number_format($car->price, 2) }}</p>
                        
                        <a href="{{ route('catalog.show', $car->id) }}" class="w-full py-2 bg-white/10 hover:bg-white/20 border border-white/10 text-white font-semibold rounded-lg transition text-sm">
                            View Full Details
                        </a>
                    </div>
                @endforeach

                {{-- DATA ROWS: We wrap everything in a full-width container to maintain row alignment --}}
                <div class="col-span-full border-t border-white/10"></div>

                {{-- Row 1: Mileage --}}
                <div class="hidden md:flex items-center p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20">Mileage</div>
                @foreach($cars as $car)
                    <div class="p-4 text-center text-zinc-200 border-t border-white/10 md:border-t-0 flex flex-col md:block justify-center">
                        <span class="md:hidden text-xs text-zinc-500 uppercase block mb-1">Mileage</span>
                        {{ number_format($car->mileage) }} km
                    </div>
                @endforeach

                {{-- Row 2: Transmission --}}
                <div class="hidden md:flex items-center p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20 border-t border-white/10">Transmission</div>
                @foreach($cars as $car)
                    <div class="p-4 text-center text-zinc-200 border-t border-white/10 flex flex-col md:block justify-center">
                        <span class="md:hidden text-xs text-zinc-500 uppercase block mb-1">Transmission</span>
                        {{ $car->transmission }}
                    </div>
                @endforeach

                {{-- Row 3: Engine Type --}}
                <div class="hidden md:flex items-center p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20 border-t border-white/10">Engine Type</div>
                @foreach($cars as $car)
                    <div class="p-4 text-center text-zinc-200 border-t border-white/10 flex flex-col md:block justify-center">
                        <span class="md:hidden text-xs text-zinc-500 uppercase block mb-1">Engine</span>
                        {{ $car->carSpecification->engine_type ?? 'N/A' }}
                    </div>
                @endforeach

                {{-- Row 4: JSON Features (Premium) --}}
                <div class="hidden md:flex items-start p-4 text-sm font-semibold text-zinc-400 uppercase tracking-wider bg-black/20 border-t border-white/10">Features</div>
                @foreach($cars as $car)
                    <div class="p-4 text-left border-t border-white/10">
                        <span class="md:hidden text-xs text-zinc-500 uppercase block mb-2 text-center">Features</span>
                        @if(!empty($car->features))
                            <ul class="space-y-2">
                                @foreach($car->features as $feature)
                                    <li class="flex items-start text-sm text-zinc-300">
                                        <svg class="w-4 h-4 text-[#dc2626] mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
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
                @foreach($cars as $car)
                    <div class="p-6 bg-white/5">
                        <a href="{{ route('catalog.show', $car->id) }}#inquiry-form" class="block w-full py-3 bg-[#dc2626] hover:bg-red-700 text-white font-bold text-center rounded-xl transition shadow-lg shadow-red-900/20">
                            Inquire Now
                        </a>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection