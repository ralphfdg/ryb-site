@extends('layouts.app')

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="bg-[#0f0f11] border-b border-white/10 pt-32 pb-12 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            Excellence in <span class="text-[#E52B2B]">Motion</span>
        </h1>
        <p class="text-zinc-400 mt-4 text-lg">Premium vehicles, transparent pricing, and a seamless buying experience.</p>
    </div>
</div>

<div x-data="catalogFilter" class="bg-[#0f0f11] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8">

        {{-- ===== SIDEBAR FILTERS ===== --}}
        <aside class="w-full md:w-1/4 shrink-0">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 sticky top-28 shadow-xl shadow-black/80">
                <h2 class="text-sm font-bold text-white mb-6 uppercase tracking-wider border-b border-white/10 pb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#E52B2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Search & Filters
                </h2>

                {{-- @submit.prevent stops the enter key from hard-reloading the page --}}
                <form x-ref="filterForm" @submit.prevent="submitForm()" action="{{ route('catalog.index') }}" method="GET" class="space-y-6">
                    
                    {{-- Keystroke Search --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Search Model</label>
                        <input type="text" name="filter[model_name]" value="{{ request()->input('filter.model_name') }}"
                            placeholder="e.g. Mustang"
                            autocomplete="off"
                            @input.debounce.500ms="submitForm()"
                            class="w-full bg-black/40 border border-white/10 text-white placeholder-zinc-600 rounded-lg focus:ring-[#E52B2B] focus:border-[#E52B2B] px-4 py-2 outline-none transition backdrop-blur-sm">
                    </div>

                    {{-- Dynamic Brand Dropdown --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Make / Brand</label>
                        <select name="filter[brand_id]" @change="submitForm()" class="w-full bg-black/40 border border-white/10 text-white rounded-lg focus:ring-[#E52B2B] focus:border-[#E52B2B] px-4 py-2 cursor-pointer transition outline-none backdrop-blur-sm">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request()->input('filter.brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Year Filter --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Year</label>
                        <select name="filter[year]" @change="submitForm()" class="w-full bg-black/40 border border-white/10 text-white rounded-lg focus:ring-[#E52B2B] focus:border-[#E52B2B] px-4 py-2 cursor-pointer transition outline-none backdrop-blur-sm">
                            <option value="">Any Year</option>
                            @for($i = date('Y'); $i >= 2000; $i--)
                                <option value="{{ $i }}" {{ request()->input('filter.year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Sort Order --}}
                    <div class="pt-2 border-t border-white/10">
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Sort By</label>
                        <select name="sort" @change="submitForm()" class="w-full bg-black/40 border border-white/10 text-white rounded-lg focus:ring-[#E52B2B] focus:border-[#E52B2B] px-4 py-2 cursor-pointer transition outline-none backdrop-blur-sm">
                            <option value="-created_at" {{ request('sort') == '-created_at' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>Price (High to Low)</option>
                        </select>
                    </div>
                    
                    @if(request()->has('filter') || request()->has('sort'))
                        <a href="{{ route('catalog.index') }}" class="block text-center mt-4 text-sm text-[#E52B2B] hover:text-white transition font-semibold">
                            Clear All Filters
                        </a>
                    @endif
                </form>
            </div>
        </aside>

        {{-- ===== MAIN GRID ===== --}}
        {{-- The ID here is crucial. Our JS targets this to replace the content seamlessly --}}
        <main id="catalog-main-content" class="w-full md:w-3/4">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-white/10">
                <p class="text-zinc-400">
                    Showing <strong class="text-white">{{ $cars->total() }}</strong> available vehicles
                </p>
                
                {{-- Optional Alpine Loading Indicator --}}
                <div x-show="isSearching" style="display: none;" class="text-[#E52B2B] text-sm animate-pulse flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Updating...
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($cars as $car)
                    <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-[#E52B2B]/50 hover:shadow-[#E52B2B]/10 transition duration-300 shadow-xl flex flex-col">

                        {{-- Image Container --}}
                        <div class="relative aspect-[4/3] overflow-hidden bg-black/50 border-b border-white/10">
                            <img src="{{ $car->getFirstMediaUrl('car_gallery') ?: 'https://placehold.co/600x400/09090b/27272a?text=Vehicle' }}" alt="{{ $car->brand->brand_name ?? 'Car' }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100">
                        </div>

                        {{-- Card Body --}}
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <p class="text-xs text-zinc-500 mb-2 font-mono uppercase tracking-wider">
                                    {{ $car->year }} • VIN: {{ $car->carSpecification->vin_number ?? 'N/A' }}
                                </p>
                                
                                <h3 class="text-lg font-bold text-white mb-1">
                                    {{ $car->brand->brand_name ?? 'Unknown Brand' }} 
                                    <span class="text-[#E52B2B] font-medium">{{ $car->model_name }}</span>
                                </h3>
                                
                                {{-- Currency changed to Philippine Peso (₱) --}}
                                <p class="text-2xl font-bold text-white mb-4">₱{{ number_format($car->price, 2) }}</p>
                            </div>

                            <a href="{{ route('catalog.show', $car->id) }}"
                                class="w-full block text-center py-2.5 bg-[#E52B2B] hover:bg-red-700
                                        text-white font-bold rounded-lg transition duration-300 shadow-md">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 px-6 bg-white/5 border border-dashed border-white/20 backdrop-blur-md rounded-2xl text-center shadow-inner">
                        <h3 class="text-xl font-bold text-white mb-2">No vehicles found</h3>
                        <p class="text-zinc-400">Try adjusting your filters or clear your search criteria.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {{ $cars->withQueryString()->links() }}
            </div>
        </main>
    </div>
</div>
@endsection