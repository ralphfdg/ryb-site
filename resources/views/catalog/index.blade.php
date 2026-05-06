@extends('layouts.app')

@section('content')
    {{-- ===== PAGE HEADER ===== --}}
    <div class="bg-[#0f0f11] border-b border-white/10 pt-32 pb-12 shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
                Excellence in <span class="text-[#dc2626]">Motion</span>
            </h1>
            <p class="text-zinc-400 mt-4 text-lg">Premium vehicles, transparent pricing, and a seamless buying experience.
            </p>
        </div>
    </div>

    {{-- Main Alpine.js Scope with injected route to handle XAMPP subfolder pathing securely --}}
    <div x-data="catalogFilter('{{ route('catalog.compare') }}')" class="bg-[#0f0f11] min-h-screen relative pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8">

            {{-- Call the new Component --}}
            <x-filter-sidebar :action-route="route('catalog.index')" :brands="$brands" :car-types="$carTypes" :filter-options="$filterOptions" />

            {{-- ===== MAIN CONTENT AREA ===== --}}
            <main class="w-full md:w-3/4 flex flex-col gap-6">

                {{-- Visual Shape Filter Bar (Synchronized with Alpine Form) --}}
                <div
                    class="p-4 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-x-auto hide-scrollbar z-10 shadow-lg shadow-black/40">

                    @php
                        // SVG Icon Library mapped directly to CarTypeSeeder entries
                        $carIcons = [
                            'Sedan' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h8l3 4v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4l3-4z M5 15h14 M7 15v2 M17 15v2" />',
                            'SUV' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 10h14l-1.5-4H6.5L5 10z M4 10v6a1 1 0 001 1h14a1 1 0 001-1v-6 M7 17v1.5 M17 17v1.5" />',
                            'Pickup' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 9h6v6h-6V9z M4 11h10v4H4v-4z M4 11l2-4h5l2 4 M6 15v2 M17 15v2" />',
                            'Coupe' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h8l3 3v3a2 2 0 01-2 2H8a2 2 0 01-2-2v-3l1-3z M5 14h14" />',
                            'Hatchback' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 9h9l3 3v4H5V9z M5 9l2-3h5l2 3 M7 16v1.5 M15 16v1.5" />',
                            // Generic fallback icon for Wagon, Van/MPV, Convertible
                            'default' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1z M13 8h6a1 1 0 011 1v7a1 1 0 01-1 1h-6" />',
                        ];
                    @endphp

                    <div class="flex gap-4 min-w-max">
                        {{-- "All Types" Button --}}
                        <label class="cursor-pointer group">
                            <input type="radio" name="filter[car_type_id]" value="" class="hidden" form="filterForm"
                                @change="submitForm()" {{ !request('filter.car_type_id') ? 'checked' : '' }}>
                            <div
                                class="px-6 py-4 rounded-xl border transition-all duration-300 flex flex-col items-center justify-center min-w-[110px] gap-2
                            {{ !request('filter.car_type_id') ? 'bg-[#dc2626]/20 border-[#dc2626] text-[#dc2626] shadow-[0_0_15px_rgba(220,38,38,0.3)]' : 'bg-black/40 border-white/10 text-zinc-400 hover:border-white/30 hover:text-white' }}">
                                <svg class="w-8 h-8 opacity-80 group-hover:opacity-100 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span class="font-bold text-xs tracking-wider uppercase">All</span>
                            </div>
                        </label>

                        {{-- Dynamic Type Buttons mapped to DB Types --}}
                        @foreach ($carTypes as $type)
                            <label class="cursor-pointer group">
                                <input type="radio" name="filter[car_type_id]" value="{{ $type->id }}" class="hidden"
                                    form="filterForm" @change="submitForm()"
                                    {{ request('filter.car_type_id') == $type->id ? 'checked' : '' }}>
                                <div
                                    class="px-6 py-4 rounded-xl border transition-all duration-300 flex flex-col items-center justify-center min-w-[110px] gap-2
                                {{ request('filter.car_type_id') == $type->id ? 'bg-[#dc2626]/20 border-[#dc2626] text-[#dc2626] shadow-[0_0_15px_rgba(220,38,38,0.3)]' : 'bg-black/40 border-white/10 text-zinc-400 hover:border-white/30 hover:text-white' }}">
                                    <svg class="w-8 h-8 opacity-80 group-hover:opacity-100 transition" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $carIcons[$type->name] ?? $carIcons['default'] !!}
                                    </svg>
                                    <span class="font-bold text-xs tracking-wider uppercase">{{ $type->name }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Grid Container (Targeted by AJAX parsing) --}}
                <div id="catalog-main-content">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-white/10">
                        <p class="text-zinc-400">
                            Showing <strong class="text-white">{{ $cars->total() }}</strong> available vehicles
                        </p>

                        <div x-show="isSearching" style="display: none;"
                            class="text-[#dc2626] text-sm animate-pulse flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Updating...
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($cars as $car)
                            <div
                                class="relative group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-[#dc2626]/50 hover:shadow-[0_0_20px_rgba(220,38,38,0.15)] transition duration-300 shadow-xl flex flex-col">
                                @auth
                                    {{-- Wishlist Star Icon Overlay --}}
                                    <button @click.prevent="$store.wishlist.toggle({{ $car->id }})"
                                        class="absolute top-4 left-4 z-20 p-2 rounded-lg backdrop-blur-sm transition duration-300 shadow-lg border"
                                        :class="$store.wishlist.items.includes({{ $car->id }}) ?
                                            'bg-[#dc2626]/20 border-[#dc2626] text-[#dc2626]' :
                                            'bg-[#0f0f11]/80 border-white/10 text-zinc-400 hover:border-white/30 hover:text-white'">

                                        {{-- Star SVG --}}
                                        <svg class="w-4 h-4"
                                            :fill="$store.wishlist.items.includes({{ $car->id }}) ? 'currentColor' :
                                                'none'"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </button>
                                @endauth
                                {{-- Compare Checkbox Overlay --}}
                                <label
                                    class="absolute top-4 right-4 z-20 cursor-pointer bg-[#0f0f11]/80 p-2 rounded-lg backdrop-blur-sm border transition duration-300 shadow-lg"
                                    :class="compareList.includes({{ $car->id }}) ? 'border-[#dc2626] bg-[#dc2626]/10' :
                                        'border-white/10 hover:border-white/30'">
                                    <input type="checkbox" :value="{{ $car->id }}"
                                        @change="toggleCompare({{ $car->id }})"
                                        :checked="compareList.includes({{ $car->id }})" class="hidden">
                                    <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2"
                                        :class="compareList.includes({{ $car->id }}) ? 'text-[#dc2626]' : 'text-zinc-400'">
                                        <svg x-show="compareList.includes({{ $car->id }})" class="w-3 h-3"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            x-text="compareList.includes({{ $car->id }}) ? 'Selected' : 'Compare'"></span>
                                    </span>
                                </label>

                                {{-- Image Container (Spatie MediaLibrary) --}}
                                <div class="relative aspect-[4/3] overflow-hidden bg-black/50 border-b border-white/10">
                                    <img src="{{ $car->getFirstMediaUrl('car_gallery') ?: 'https://placehold.co/600x400/09090b/27272a?text=Vehicle' }}"
                                        alt="{{ $car->brand->brand_name ?? 'Car' }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100">
                                </div>

                                {{-- Card Body --}}
                                <div class="p-5 flex-grow flex flex-col justify-between">
                                    <div>
                                        <p class="text-xs text-zinc-500 mb-2 font-mono uppercase tracking-wider">
                                            {{ $car->year }} • {{ $car->carType->name ?? 'Vehicle' }}
                                        </p>

                                        <h3 class="text-lg font-bold text-white mb-1">
                                            {{ $car->brand->brand_name ?? 'Unknown Brand' }}
                                            <span class="text-[#dc2626] font-medium">{{ $car->model_name }}</span>
                                        </h3>

                                        <p class="text-2xl font-bold text-white mb-4 tracking-tight">
                                            ₱{{ number_format($car->price, 2) }}</p>
                                    </div>

                                    <a href="{{ route('catalog.show', $car->id) }}"
                                        class="w-full block text-center py-2.5 bg-[#dc2626] hover:bg-red-700
                                            text-white font-bold rounded-xl transition duration-300 shadow-md">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div
                                class="col-span-full py-20 px-6 bg-white/5 border border-dashed border-white/20 backdrop-blur-md rounded-2xl text-center shadow-inner">
                                <h3 class="text-xl font-bold text-white mb-2">No vehicles found</h3>
                                <p class="text-zinc-400">Try adjusting your filters or clear your search criteria.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-12 flex justify-center">
                        {{ $cars->withQueryString()->links() }}
                    </div>
                </div>
            </main>
        </div>

        {{-- ===== FLOATING COMPARISON BAR ===== --}}
        <div x-show="compareList.length > 0" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-full opacity-0" style="display: none;"
            class="fixed bottom-0 left-0 w-full z-50 p-4 pb-6 bg-[#0f0f11]/95 backdrop-blur-xl border-t border-white/10 shadow-[0_-10px_40px_rgba(0,0,0,0.8)]">
            <div
                class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 px-4 sm:px-6 lg:px-8">
                <div class="text-white font-medium flex items-center gap-3">
                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-[#dc2626]/20 border border-[#dc2626] text-[#dc2626] font-bold text-xl">
                        <span x-text="compareList.length"></span>
                    </div>
                    <span class="text-zinc-400">Vehicles selected for comparison</span>
                </div>
                <div class="flex gap-4 w-full sm:w-auto">
                    <button @click="compareList = []"
                        class="px-6 py-3 text-zinc-400 hover:text-white transition font-medium text-sm">Clear All</button>
                    <button @click="goToCompare()"
                        class="flex-1 sm:flex-none px-8 py-3 bg-[#dc2626] hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg shadow-red-900/20 disabled:opacity-50 disabled:cursor-not-allowed"
                        x-bind:disabled="compareList.length < 2">
                        Compare Specs
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
