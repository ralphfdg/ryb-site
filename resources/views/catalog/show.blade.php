@extends('layouts.app')

@section('content')
<div class="bg-ryb-darker min-h-screen pt-24 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Back Button --}}
        <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-ryb-light/60 hover:text-white transition mb-8">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Inventory
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            {{-- ===== LEFT: IMAGE GALLERY (Swiper.js) ===== --}}
            <div class="space-y-4">
                {{-- Main Image --}}
                <div class="swiper mySwiper2 rounded-2xl overflow-hidden border border-ryb-muted shadow-2xl shadow-black/80 aspect-[4/3] bg-ryb-dark">
                    <div class="swiper-wrapper">
                        @forelse($car->getMedia('car_gallery') as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image->getUrl() }}" class="w-full h-full object-cover" />
                            </div>
                        @empty
                            <div class="swiper-slide flex items-center justify-center">
                                <img src="https://placehold.co/800x600/09090b/27272a?text=No+Images+Available" class="w-full h-full object-cover" />
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-button-next !text-ryb-red drop-shadow-md"></div>
                    <div class="swiper-button-prev !text-ryb-red drop-shadow-md"></div>
                </div>

                {{-- Thumbnails --}}
                <div class="swiper mySwiper h-24">
                    <div class="swiper-wrapper">
                        @foreach($car->getMedia('car_gallery') as $image)
                            <div class="swiper-slide rounded-lg overflow-hidden border border-ryb-muted cursor-pointer opacity-60 hover:opacity-100 transition">
                                <img src="{{ $image->getUrl('thumb') ?? $image->getUrl() }}" class="w-full h-full object-cover" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ===== RIGHT: VEHICLE DETAILS ===== --}}
            <div class="flex flex-col">
                <div class="border-b border-ryb-muted pb-6 mb-6">
                    <div class="flex justify-between items-start mb-2">
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            {{ $car->brand->brand_name ?? 'Premium Vehicle' }} 
                            <span class="text-ryb-light/70 font-medium text-2xl">{{ $car->model_name }}</span>
                        </h1>
                        @if($car->status === 'Available')
                            <span class="px-3 py-1 bg-green-500/10 text-green-400 border border-green-500/20 rounded-full text-xs font-bold uppercase tracking-wider">Available</span>
                        @else
                            <span class="px-3 py-1 bg-ryb-muted text-ryb-light border border-white/10 rounded-full text-xs font-bold uppercase tracking-wider">{{ $car->status }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-ryb-light/50 font-mono">VIN: {{ $car->specification->vin_number ?? 'N/A' }}</p>
                    
                    <div class="mt-6">
                        <p class="text-4xl font-bold text-ryb-red">${{ number_format($car->price, 2) }}</p>
                    </div>
                </div>

                {{-- Features & Specifications --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-bold text-white mb-4">Specifications</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-ryb-dark border border-ryb-muted rounded-xl p-4">
                            <p class="text-xs text-ryb-light/50 uppercase tracking-wider mb-1">Make</p>
                            <p class="font-bold text-ryb-light">{{ $car->brand->brand_name ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-ryb-dark border border-ryb-muted rounded-xl p-4">
                            <p class="text-xs text-ryb-light/50 uppercase tracking-wider mb-1">Status</p>
                            <p class="font-bold text-ryb-light">{{ $car->status }}</p>
                        </div>
                        
                        {{-- Loop through JSON features dynamically if they exist --}}
                        @if(!empty($car->features))
                            @foreach($car->features as $key => $value)
                                @if($key !== 'model') {{-- Skip model as it's in the title --}}
                                    <div class="bg-ryb-dark border border-ryb-muted rounded-xl p-4">
                                        <p class="text-xs text-ryb-light/50 uppercase tracking-wider mb-1">{{ str_replace('_', ' ', $key) }}</p>
                                        <p class="font-bold text-ryb-light">{{ is_array($value) ? implode(', ', $value) : $value }}</p>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Inquiry Action --}}
                <div class="mt-10 bg-ryb-dark border border-ryb-muted rounded-2xl p-6 shadow-lg shadow-black/50">
                    <h3 class="text-lg font-bold text-white mb-2">Interested in this vehicle?</h3>
                    <p class="text-ryb-light/60 text-sm mb-6">Our specialists are ready to answer your questions and arrange a viewing.</p>
                    
                    <button @click="document.getElementById('inquiry-form').scrollIntoView({behavior: 'smooth'})" 
                            class="w-full bg-ryb-red text-white font-bold py-4 rounded-xl hover:bg-ryb-red-dark transition shadow-md border border-ryb-red-dark text-lg">
                        Inquire Now
                    </button>
                </div>
            </div>
        </div>

        {{-- ===== INQUIRY FORM SECTION (Guest-First) ===== --}}
        <div id="inquiry-form" class="mt-20 max-w-3xl mx-auto bg-ryb-dark border border-ryb-muted rounded-3xl p-8 md:p-12 shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-2 text-center">Send an Inquiry</h2>
            <p class="text-ryb-light/60 text-center mb-8">Ref: {{ $car->brand->brand_name }} {{ $car->model_name }} (VIN: {{ $car->specification->vin_number ?? 'N/A' }})</p>

            <form action="#" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Full Name</label>
                        <input type="text" name="name" required value="{{ auth()->check() ? auth()->user()->name : '' }}"
                            class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Email Address</label>
                        <input type="email" name="email" required value="{{ auth()->check() ? auth()->user()->email : '' }}"
                            class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-ryb-light/70 mb-2">Message</label>
                    <textarea name="message" rows="4" required
                        class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition resize-none">I am interested in the {{ $car->brand->brand_name }} {{ $car->model_name }} listed for ${{ number_format($car->price) }}. Please provide me with more details.</textarea>
                </div>

                <button type="submit" class="w-full bg-white text-black font-bold py-4 rounded-xl hover:bg-gray-200 transition shadow-md text-lg">
                    Send Message
                </button>
            </form>
        </div>

    </div>
</div>
@endsection