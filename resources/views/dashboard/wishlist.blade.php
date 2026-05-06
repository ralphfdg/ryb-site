@extends('layouts.app')

@section('content')
<div x-data="catalogFilter('')" class="bg-ryb-darker min-h-screen pt-24 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-6 border-b border-white/10">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight">
                    My <span class="text-ryb-red">Wishlist</span>
                </h1>
                <p class="text-zinc-400 mt-2 text-sm">Filter and manage your saved vehicles.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('catalog.index') }}" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 text-white font-medium rounded-xl transition text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Browse Catalog
                </a>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <x-filter-sidebar 
                :action-route="route('dashboard.wishlist.index')" 
                :brands="$brands" 
                :car-types="$carTypes" 
                :filter-options="$filterOptions" 
            />

            {{-- Main Wishlist Inventory --}}
            <main class="w-full flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($wishlistCars as $car)
                        {{-- 
                            Alpine.js local state 'removed' provides instant UI feedback 
                            while the global store handles the MySQL database sync.
                        --}}
                        <div x-data="{ removed: false }" 
                             x-show="!removed" 
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="relative group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden flex flex-col shadow-xl hover:border-ryb-red/30 transition-all duration-300">
                            
                            {{-- Remove Button Overlay --}}
                            <button @click.prevent="$store.wishlist.toggle({{ $car->id }}); removed = true;" 
                                    class="absolute top-3 right-3 z-20 p-2 bg-black/60 hover:bg-ryb-red text-zinc-300 hover:text-white backdrop-blur-md rounded-lg transition border border-white/10 shadow-lg group/btn"
                                    title="Remove from wishlist">
                                <svg class="w-4 h-4 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>

                            {{-- Vehicle Image --}}
                            <div class="relative aspect-[4/3] overflow-hidden bg-black/50 border-b border-white/10">
                                <img src="{{ $car->getFirstMediaUrl('car_gallery') ?: 'https://placehold.co/600x400/09090b/27272a?text=Vehicle' }}" 
                                     alt="{{ $car->model_name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100">
                                
                                <div class="absolute bottom-3 left-3">
                                    <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded-md backdrop-blur-md border 
                                        {{ $car->status === 'Available' ? 'bg-green-500/20 text-green-400 border-green-500/30' : 'bg-red-500/20 text-red-400 border-red-500/30' }}">
                                        {{ $car->status }}
                                    </span>
                                </div>
                            </div>

                            {{-- Card Content --}}
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <p class="text-xs text-zinc-500 mb-1 font-mono uppercase tracking-wider">
                                        {{ $car->year }} • {{ number_format($car->mileage) }} km
                                    </p>
                                    
                                    <h3 class="text-lg font-bold text-white mb-1 truncate">
                                        {{ $car->brand->brand_name ?? 'Unknown' }} 
                                        <span class="text-ryb-red font-medium">{{ $car->model_name }}</span>
                                    </h3>
                                    
                                    <p class="text-xl font-bold text-white mb-4 tracking-tight">₱{{ number_format($car->price, 2) }}</p>
                                </div>

                                <a href="{{ route('catalog.show', $car->id) }}"
                                   class="w-full block text-center py-2.5 bg-white/5 hover:bg-ryb-red border border-white/10 hover:border-ryb-red text-white font-bold text-sm rounded-xl transition duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @empty
                        {{-- Empty State --}}
                        <div class="col-span-full py-24 bg-white/5 border border-dashed border-white/20 rounded-3xl text-center flex flex-col items-center">
                            <div class="w-16 h-16 bg-ryb-red/10 rounded-full flex items-center justify-center mb-4 border border-ryb-red/20">
                                <svg class="w-8 h-8 text-ryb-red opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No matching vehicles found</h3>
                            <p class="text-zinc-500 text-sm">Try adjusting your filters or clearing your search.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination with Query Strings preserved --}}
                @if($wishlistCars->hasPages())
                    <div class="mt-12 flex justify-center border-t border-white/10 pt-8">
                        {{ $wishlistCars->withQueryString()->links() }}
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection