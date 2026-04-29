@extends('layouts.app')

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="bg-ryb-darker border-b border-ryb-muted pt-32 pb-12 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            Vehicle <span class="text-ryb-red">Catalog</span>
        </h1>
        <p class="text-ryb-light/60 mt-4 text-lg">Browse our premium selection of highly vetted vehicles.</p>
    </div>
</div>

<div class="bg-ryb-darker min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8">

        {{-- ===== SIDEBAR FILTERS ===== --}}
        <aside class="w-full md:w-1/4 shrink-0">
            <div class="bg-ryb-dark border border-ryb-muted rounded-2xl p-6 sticky top-28 shadow-xl shadow-black/80">
                <h2 class="text-sm font-bold text-white mb-6 uppercase tracking-wider border-b border-ryb-muted pb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Search & Filters
                </h2>

                <form action="{{ route('catalog.index') }}" method="GET" class="space-y-6">
                    
                    {{-- Make / Brand --}}
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Make / Brand</label>
                        <select name="filter[brand_id]" class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2 cursor-pointer transition outline-none">
                            <option value="">All Brands</option>
                            <option value="1" {{ request()->input('filter.brand_id') == '1' ? 'selected' : '' }}>Toyota</option>
                            <option value="2" {{ request()->input('filter.brand_id') == '2' ? 'selected' : '' }}>Tesla</option>
                        </select>
                    </div>

                    {{-- Price Range --}}
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Max Price</label>
                        <select name="filter[price]" class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2 cursor-pointer transition outline-none">
                            <option value="">Any Price</option>
                            <option value="30000" {{ request()->input('filter.price') == '30000' ? 'selected' : '' }}>Under $30,000</option>
                            <option value="50000" {{ request()->input('filter.price') == '50000' ? 'selected' : '' }}>Under $50,000</option>
                            <option value="80000" {{ request()->input('filter.price') == '80000' ? 'selected' : '' }}>Under $80,000</option>
                        </select>
                    </div>

                    {{-- Availability Status --}}
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Availability</label>
                        <select name="filter[status]" class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2 cursor-pointer transition outline-none">
                            <option value="Available" {{ request()->input('filter.status') == 'Available' ? 'selected' : '' }}>Available Only</option>
                            <option value="" {{ request()->input('filter.status') == '' ? 'selected' : '' }}>All Vehicles</option>
                        </select>
                    </div>

                    {{-- Sort Order (Moved inside form so it applies on submit) --}}
                    <div class="pt-2 border-t border-ryb-muted">
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Sort By</label>
                        <select name="sort" class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2 cursor-pointer transition outline-none">
                            <option value="-created_at" {{ request('sort') == '-created_at' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>Price (High to Low)</option>
                        </select>
                    </div>

                    {{-- PRIMARY action button: Red --}}
                    <button type="submit"
                        class="w-full bg-ryb-red text-white font-bold py-3 rounded-lg hover:bg-ryb-red-dark transition border border-ryb-red-dark shadow-md mt-4">
                        Apply Filters
                    </button>
                    
                    @if(request()->has('filter') || request()->has('sort'))
                        <a href="{{ route('catalog.index') }}" class="block text-center mt-3 text-sm text-ryb-light/50 hover:text-white transition">
                            Clear All Filters
                        </a>
                    @endif
                </form>
            </div>
        </aside>

        {{-- ===== MAIN GRID ===== --}}
        <main class="w-full md:w-3/4">

            {{-- Toolbar --}}
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-ryb-muted/50">
                <p class="text-ryb-light/60">
                    Showing <strong class="text-white">{{ $cars->total() }}</strong> vehicles
                </p>
                {{-- Note: Sorting is now handled in the main sidebar form to ensure it combines with filters seamlessly --}}
            </div>

            {{-- Car Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($cars as $car)
                    <div class="group bg-ryb-dark border border-ryb-muted rounded-2xl overflow-hidden hover:border-ryb-red/50 transition duration-300 shadow-xl shadow-black/40 flex flex-col">

                        {{-- Image + Status Badge --}}
                        <div class="relative aspect-[4/3] overflow-hidden bg-ryb-darker border-b border-ryb-muted/50">
                            <img src="{{ $car->getFirstMediaUrl('images') ?: 'https://placehold.co/600x400/09090b/27272a?text=Vehicle' }}" alt="{{ $car->brand->brand_name ?? 'Car' }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100">

                            @if($car->status === 'Available')
                                <span class="absolute top-3 left-3 px-3 py-1 bg-green-500/10 text-green-400
                                            border border-green-500/20 rounded-full text-xs font-bold uppercase
                                            tracking-wider backdrop-blur-md">Available</span>
                            @else
                                <span class="absolute top-3 left-3 px-3 py-1 bg-ryb-muted text-ryb-light
                                            border border-white/10 rounded-full text-xs font-bold uppercase
                                            tracking-wider backdrop-blur-md">{{ $car->status }}</span>
                            @endif
                        </div>

                        {{-- Card Body --}}
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                {{-- Monospace details using real backend data (VIN) --}}
                                <p class="text-xs text-ryb-light/50 mb-2 font-mono">
                                    VIN: {{ $car->specification->vin_number ?? 'N/A' }}
                                </p>
                                
                                <h3 class="text-lg font-bold text-white mb-1">
                                    {{ $car->brand->brand_name ?? 'Unknown Brand' }} 
                                    {{-- Adjusted this block to output the database column 'model_name' directly --}}
                                    <span class="text-ryb-light/70 font-medium">{{ $car->model_name }}</span>
                                </h3>
                                
                                <p class="text-2xl font-bold text-ryb-red mb-4">${{ number_format($car->price, 2) }}</p>
                            </div>

                            {{-- CTA: Outline dark, changes to Red on hover --}}
                            <a href="{{ route('catalog.show', $car->id) }}"
                                class="w-full block text-center py-2.5 bg-ryb-darker hover:bg-ryb-red
                                        text-ryb-light hover:text-white border border-ryb-muted hover:border-ryb-red
                                        rounded-lg font-bold transition duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 px-6 bg-ryb-dark border border-dashed border-ryb-muted rounded-2xl text-center shadow-inner">
                        <h3 class="text-xl font-bold text-white mb-2">No vehicles found</h3>
                        <p class="text-ryb-light/60">Try adjusting your filters or clear your search criteria.</p>
                        <a href="{{ route('catalog.index') }}" class="inline-block mt-4 text-ryb-red hover:text-white transition font-semibold">Clear All Filters</a>
                    </div>
                @endforelse
            </div>

            {{-- Laravel Pagination --}}
            <div class="mt-12 flex justify-center">
                {{-- Ensures the pagination uses your Tailwind layout properly --}}
                {{ $cars->withQueryString()->links() }}