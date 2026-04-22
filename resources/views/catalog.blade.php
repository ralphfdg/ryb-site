@extends('layouts.app')

@section('content')
@php
    // Dummy Data - Backend will replace this using Spatie Query Builder
    $cars = [
        ['id' => 1, 'brand' => 'Tesla', 'model' => 'Model 3', 'year' => 2024, 'price' => 45990, 'mileage' => 12450, 'status' => 'Available', 'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=Tesla+Model+3'],
        ['id' => 2, 'brand' => 'Toyota', 'model' => 'Camry TRD', 'year' => 2023, 'price' => 34000, 'mileage' => 8200, 'status' => 'Available', 'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=Toyota+Camry'],
        ['id' => 3, 'brand' => 'Honda', 'model' => 'Accord EX-L', 'year' => 2024, 'price' => 32500, 'mileage' => 4100, 'status' => 'Pending', 'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=Honda+Accord'],
        ['id' => 4, 'brand' => 'BMW', 'model' => 'M4', 'year' => 2024, 'price' => 85000, 'mileage' => 1500, 'status' => 'Available', 'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=BMW+M4'],
        ['id' => 5, 'brand' => 'Ford', 'model' => 'Mustang GT', 'year' => 2022, 'price' => 42000, 'mileage' => 22000, 'status' => 'Available', 'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=Ford+Mustang'],
        ['id' => 6, 'brand' => 'Mercedes', 'model' => 'C-Class', 'year' => 2023, 'price' => 54000, 'mileage' => 11000, 'status' => 'Available', 'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=Mercedes+C-Class'],
    ];
@endphp

<div class="bg-ryb-black border-b border-ryb-dark pt-32 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-ryb-light tracking-tight">Vehicle <span class="text-ryb-red">Catalog</span></h1>
        <p class="text-ryb-light/60 mt-4 text-lg">Browse our premium selection of highly vetted vehicles.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8">
    
    <aside class="w-full md:w-1/4 shrink-0">
        <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-6 sticky top-28">
            <h2 class="text-xl font-bold text-ryb-light mb-6 uppercase tracking-wider text-sm border-b border-ryb-dark pb-4">Search & Filters</h2>
            
            <form action="#" method="GET" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-ryb-light/70 mb-2">Search Make/Model</label>
                    <input type="text" name="search" placeholder="e.g. Camry..." class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2 placeholder-ryb-light/30">
                </div>

                <div>
                    <label class="block text-sm font-medium text-ryb-light/70 mb-2">Price Range</label>
                    <select name="price" class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2">
                        <option value="">Any Price</option>
                        <option value="under_30k">Under $30,000</option>
                        <option value="30k_to_60k">$30,000 - $60,000</option>
                        <option value="over_60k">Over $60,000</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-ryb-light/70 mb-2">Year</label>
                    <select name="year" class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2">
                        <option value="">Any Year</option>
                        <option value="2024">2024 & Newer</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022 & Older</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-ryb-light/70 mb-2">Availability Status</label>
                    <select name="status" class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-2">
                        <option value="Available">Available Only</option>
                        <option value="All">All Vehicles</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-ryb-red text-white font-semibold py-3 rounded-lg hover:bg-red-700 transition shadow-lg mt-4">Apply Filters</button>
            </form>
        </div>
    </aside>

    <main class="w-full md:w-3/4">
        
        <div class="flex justify-between items-center mb-6">
            <p class="text-ryb-light/60">Showing <strong class="text-ryb-light">{{ count($cars) }}</strong> vehicles</p>
            
            <div class="flex items-center gap-3">
                <label class="text-sm text-ryb-light/60">Sort By:</label>
                <select class="bg-ryb-black border border-ryb-dark text-ryb-light text-sm rounded-lg focus:ring-ryb-red focus:border-ryb-red px-3 py-1">
                    <option>Price (Low to High)</option>
                    <option>Price (High to Low)</option>
                    <option>Newest Arrivals</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $car)
                <div class="group bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl overflow-hidden hover:bg-ryb-dark/50 transition duration-300 shadow-xl flex flex-col">
                    
                    <div class="relative aspect-[4/3] overflow-hidden bg-ryb-black">
                        <img src="{{ $car['image'] }}" alt="{{ $car['brand'] }} {{ $car['model'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100">
                        
                        @if($car['status'] === 'Available')
                            <span class="absolute top-3 left-3 px-3 py-1 bg-green-500/20 text-green-400 border border-green-500/30 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md">Available</span>
                        @else
                            <span class="absolute top-3 left-3 px-3 py-1 bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md">{{ $car['status'] }}</span>
                        @endif
                    </div>
                    
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            <p class="text-xs text-ryb-light/50 mb-1 font-mono">{{ $car['year'] }} • {{ number_format($car['mileage']) }} mi</p>
                            <h3 class="text-lg font-bold text-ryb-light mb-1">{{ $car['brand'] }} <span class="text-ryb-light/80 font-medium">{{ $car['model'] }}</span></h3>
                            <p class="text-xl font-bold text-ryb-red mb-4">${{ number_format($car['price']) }}</p>
                        </div>
                        
                        <a href="/catalog/{{ $car['id'] }}" class="w-full block text-center py-2.5 bg-ryb-dark hover:bg-ryb-red text-ryb-light hover:text-white border border-transparent rounded-lg font-medium transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-12 flex justify-center">
            <div class="flex gap-2">
                <button class="px-4 py-2 border border-ryb-dark text-ryb-light/50 rounded-lg cursor-not-allowed">Previous</button>
                <button class="px-4 py-2 bg-ryb-red text-white rounded-lg font-medium shadow-lg">1</button>
                <button class="px-4 py-2 border border-ryb-dark hover:bg-ryb-dark text-ryb-light rounded-lg transition">2</button>
                <button class="px-4 py-2 border border-ryb-dark hover:bg-ryb-dark text-ryb-light rounded-lg transition">Next</button>
            </div>
        </div>

    </main>
</div>
@endsection