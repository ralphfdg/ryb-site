@extends('layouts.app')

@section('content')
<div class="bg-[#0f0f11] min-h-screen pt-24 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- ===== BREADCRUMB / BACK BUTTON ===== --}}
        <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-zinc-400 hover:text-white transition mb-8 font-medium group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Inventory
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            {{-- ===== LEFT COLUMN: IMAGE GALLERY (Swiper.js) ===== --}}
            <div class="space-y-4">
                {{-- Main Active Image --}}
                <div class="swiper mySwiper2 rounded-2xl overflow-hidden border border-white/10 shadow-2xl shadow-black/80 aspect-[4/3] bg-black/50 backdrop-blur-md relative">
                    <div class="swiper-wrapper">
                        {{-- Spatie MediaLibrary Integration --}}
                        @forelse($car->getMedia('car_gallery') as $image)
                            <div class="swiper-slide flex justify-center items-center">
                                <img src="{{ $image->getUrl() }}" alt="{{ $car->model_name }}" class="w-full h-full object-cover" />
                            </div>
                        @empty
                            <div class="swiper-slide flex flex-col items-center justify-center text-zinc-600">
                                <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p>No Images Available</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-button-next !text-[#dc2626] drop-shadow-md"></div>
                    <div class="swiper-button-prev !text-[#dc2626] drop-shadow-md"></div>
                </div>

                {{-- Interactive Thumbnails --}}
                <div class="swiper mySwiper h-24">
                    <div class="swiper-wrapper">
                        @foreach($car->getMedia('car_gallery') as $image)
                            <div class="swiper-slide rounded-lg overflow-hidden border border-white/10 cursor-pointer opacity-50 hover:opacity-100 transition [&.swiper-slide-thumb-active]:opacity-100 [&.swiper-slide-thumb-active]:border-[#dc2626]">
                                <img src="{{ $image->getUrl('thumb') ?? $image->getUrl() }}" class="w-full h-full object-cover" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ===== RIGHT COLUMN: VEHICLE DETAILS ===== --}}
            <div class="flex flex-col">
                {{-- Header Info --}}
                <div class="border-b border-white/10 pb-6 mb-6">
                    <div class="flex justify-between items-start mb-2">
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            {{ $car->brand->brand_name ?? 'Unknown Brand' }} 
                            <span class="text-[#dc2626] font-medium text-2xl">{{ $car->model_name }}</span>
                        </h1>
                        @if($car->status === 'Available')
                            <span class="px-3 py-1 bg-green-500/10 text-green-400 border border-green-500/20 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md shadow-[0_0_10px_rgba(34,197,94,0.2)]">Available</span>
                        @else
                            <span class="px-3 py-1 bg-white/5 text-zinc-400 border border-white/10 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md">{{ $car->status }}</span>
                        @endif
                    </div>
                    
                    <p class="text-sm text-zinc-500 font-mono uppercase tracking-wider flex gap-3 items-center">
                        <span>Year: {{ $car->year }}</span> 
                        <span class="w-1 h-1 bg-zinc-600 rounded-full"></span>
                        <span>VIN: {{ $car->carSpecification->vin_number ?? 'N/A' }}</span>
                    </p>
                    
                    <div class="mt-6">
                        <p class="text-4xl font-bold text-white tracking-tight">₱{{ number_format($car->price, 2) }}</p>
                    </div>
                </div>

                {{-- Specs Data --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2 border-b border-white/10 pb-2">
                        <svg class="w-5 h-5 text-[#dc2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Base Details
                    </h3>
                    
                    {{-- Core Specs Grid --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Mileage</p>
                            <p class="font-bold text-zinc-200">{{ number_format($car->mileage) }} km</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Transmission</p>
                            <p class="font-bold text-zinc-200">{{ $car->transmission }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Fuel Type</p>
                            <p class="font-bold text-zinc-200">{{ $car->fuel_type }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Plate Ending</p>
                            <p class="font-bold text-zinc-200">{{ $car->plate_ending }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Body Type</p>
                            <p class="font-bold text-zinc-200">{{ $car->carType->name ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Previous Owners</p>
                            <p class="font-bold text-zinc-200">{{ $car->previous_owners }}</p>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2 border-b border-white/10 pb-2 mt-8">
                        <svg class="w-5 h-5 text-[#dc2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Extended Specifications
                    </h3>

                    {{-- Extended Specs Grid (1:1 Relationship) --}}
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Engine Type</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->engine_type ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Fuel Capacity</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->fuel_capacity ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Exterior Color</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->color_exterior ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Interior Color</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->color_interior ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- JSON Array Mapping --}}
                    @if(!empty($car->features))
                        <h4 class="text-sm font-bold text-zinc-400 mt-8 mb-4 uppercase tracking-wider">Premium Features</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($car->features as $feature)
                                <span class="px-4 py-1.5 bg-black/40 border border-white/10 text-zinc-300 rounded-full text-sm backdrop-blur-sm flex items-center gap-2">
                                    <svg class="w-3 h-3 text-[#dc2626]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    {{ $feature }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Auto-Scroll CTA --}}
                <div class="mt-10">
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 shadow-lg shadow-black/50 text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1">Ready to take the next step?</h3>
                            <p class="text-zinc-400 text-sm">Our specialists are ready to answer your questions.</p>
                        </div>
                        <button onclick="document.getElementById('inquiry-form').scrollIntoView({behavior: 'smooth'})" 
                                class="w-full md:w-auto px-8 py-3 bg-[#dc2626] text-white font-bold rounded-xl hover:bg-red-700 transition shadow-[0_0_20px_rgba(220,38,38,0.4)] whitespace-nowrap">
                            Inquire Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== GUEST-FIRST INQUIRY FORM ===== --}}
        <div id="inquiry-form" class="mt-24 max-w-3xl mx-auto bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 md:p-12 shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-2 text-center">Send an Inquiry</h2>
            <p class="text-zinc-400 text-center mb-8">Ref: {{ $car->brand->brand_name }} {{ $car->model_name }} (VIN: {{ $car->carSpecification->vin_number ?? 'N/A' }})</p>

            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Full Name</label>
                        {{-- auth()->check() prevents guests from triggering an error while attempting to grab user data --}}
                        <input type="text" name="name" required 
                            value="{{ auth()->check() ? auth()->user()->name : old('name') }}" 
                            {{ auth()->check() ? 'readonly' : '' }}
                            class="w-full bg-black/40 border border-white/10 text-white rounded-lg px-4 py-3 outline-none focus:border-[#dc2626] transition {{ auth()->check() ? 'text-zinc-500 cursor-not-allowed opacity-70' : '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Email Address</label>
                        <input type="email" name="email" required 
                            value="{{ auth()->check() ? auth()->user()->email : old('email') }}" 
                            {{ auth()->check() ? 'readonly' : '' }}
                            class="w-full bg-black/40 border border-white/10 text-white rounded-lg px-4 py-3 outline-none focus:border-[#dc2626] transition {{ auth()->check() ? 'text-zinc-500 cursor-not-allowed opacity-70' : '' }}">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-400 mb-2">Message</label>
                    <textarea name="message" rows="4" required
                        class="w-full bg-black/40 border border-white/10 text-white rounded-lg focus:ring-[#dc2626] focus:border-[#dc2626] px-4 py-3 outline-none transition resize-none backdrop-blur-sm">I am interested in the {{ $car->brand->brand_name }} {{ $car->model_name }} listed for ₱{{ number_format($car->price) }}. Please provide me with more details or let me know when I can schedule a viewing.</textarea>
                </div>

                <button type="submit" class="w-full bg-[#dc2626] text-white font-bold py-4 rounded-xl hover:bg-red-700 transition shadow-[0_0_20px_rgba(220,38,38,0.4)] text-lg mt-4">
                    Submit Inquiry
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
    // We wrap this inside DOMContentLoaded to prevent Swiper from initializing before the DOM is fully rendered in XAMPP.
    document.addEventListener('DOMContentLoaded', function () {
        var swiperThumbnails = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        
        var swiperMain = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiperThumbnails,
            },
        });
    });
</script>
@endpush
@endsection