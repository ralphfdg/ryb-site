@extends('layouts.app')

@section('content')
<div class="bg-[#0f0f11] min-h-screen pt-24 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Back Button --}}
        <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-zinc-400 hover:text-white transition mb-8 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Inventory
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            {{-- ===== LEFT: IMAGE GALLERY (Swiper.js) ===== --}}
            <div class="space-y-4">
                {{-- Main Image --}}
                <div class="swiper mySwiper2 rounded-2xl overflow-hidden border border-white/10 shadow-2xl shadow-black/80 aspect-[4/3] bg-black/50 backdrop-blur-md relative">
                    <div class="swiper-wrapper">
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
                    <div class="swiper-button-next !text-[#E52B2B] drop-shadow-md"></div>
                    <div class="swiper-button-prev !text-[#E52B2B] drop-shadow-md"></div>
                </div>

                {{-- Thumbnails --}}
                <div class="swiper mySwiper h-24">
                    <div class="swiper-wrapper">
                        @foreach($car->getMedia('car_gallery') as $image)
                            <div class="swiper-slide rounded-lg overflow-hidden border border-white/10 cursor-pointer opacity-50 hover:opacity-100 transition [&.swiper-slide-thumb-active]:opacity-100 [&.swiper-slide-thumb-active]:border-[#E52B2B]">
                                <img src="{{ $image->getUrl('thumb') ?? $image->getUrl() }}" class="w-full h-full object-cover" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ===== RIGHT: VEHICLE DETAILS ===== --}}
            <div class="flex flex-col">
                <div class="border-b border-white/10 pb-6 mb-6">
                    <div class="flex justify-between items-start mb-2">
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            {{ $car->brand->brand_name ?? 'Unknown Brand' }} 
                            <span class="text-[#E52B2B] font-medium text-2xl">{{ $car->model_name }}</span>
                        </h1>
                        @if($car->status === 'Available')
                            <span class="px-3 py-1 bg-green-500/10 text-green-400 border border-green-500/20 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md">Available</span>
                        @else
                            <span class="px-3 py-1 bg-white/5 text-zinc-400 border border-white/10 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md">{{ $car->status }}</span>
                        @endif
                    </div>
                    
                    <p class="text-sm text-zinc-500 font-mono uppercase tracking-wider">Year: {{ $car->year }} | VIN: {{ $car->carSpecification->vin_number ?? 'N/A' }}</p>
                    
                    <div class="mt-6">
                        <p class="text-4xl font-bold text-white">₱{{ number_format($car->price, 2) }}</p>
                    </div>
                </div>

                <div class="flex-grow">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2 border-b border-white/10 pb-2">
                        <svg class="w-5 h-5 text-[#E52B2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Base Details
                    </h3>
                    
                    {{-- Base Cars Table Data --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Mileage</p>
                            <p class="font-bold text-zinc-200">{{ number_format($car->mileage) }} km</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Transmission</p>
                            <p class="font-bold text-zinc-200">{{ $car->transmission }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Fuel Type</p>
                            <p class="font-bold text-zinc-200">{{ $car->fuel_type }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Plate Ending</p>
                            <p class="font-bold text-zinc-200">{{ $car->plate_ending }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Previous Owners</p>
                            <p class="font-bold text-zinc-200">{{ $car->previous_owners }}</p>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2 border-b border-white/10 pb-2">
                        <svg class="w-5 h-5 text-[#E52B2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Extended Specifications
                    </h3>

                    {{-- Extended Car Specifications Table Data --}}
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Engine Type</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->engine_type ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Fuel Capacity</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->fuel_capacity ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Exterior Color</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->color_exterior ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Interior Color</p>
                            <p class="font-bold text-zinc-200">{{ $car->carSpecification->color_interior ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- Highlighted JSON Features --}}
                    @if(!empty($car->features))
                        <h4 class="text-sm font-bold text-zinc-400 mt-6 mb-3 uppercase tracking-wider">Premium Features</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($car->features as $feature)
                                <span class="px-3 py-1 bg-black/40 border border-white/10 text-zinc-300 rounded-full text-sm backdrop-blur-sm">
                                    {{ $feature }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Inquiry Action Gating --}}
                <div class="mt-10">
                    @auth
                        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 shadow-lg shadow-black/50">
                            <h3 class="text-lg font-bold text-white mb-2">Interested in this vehicle?</h3>
                            <p class="text-zinc-400 text-sm mb-6">Our specialists are ready to answer your questions and arrange a viewing.</p>
                            
                            <button onclick="document.getElementById('inquiry-form').scrollIntoView({behavior: 'smooth'})" 
                                    class="w-full bg-[#E52B2B] text-white font-bold py-4 rounded-xl hover:bg-red-700 transition shadow-md shadow-red-900/20 text-lg">
                                Book Appointment / Inquire
                            </button>
                        </div>
                    @endauth

                    @guest
                        <div class="bg-black/40 backdrop-blur-md border border-white/10 rounded-2xl p-6 text-center shadow-lg shadow-black/50">
                            <svg class="w-12 h-12 text-zinc-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <h3 class="text-lg font-bold text-white mb-2">Login Required</h3>
                            <p class="text-zinc-400 text-sm mb-6">You must have a registered account to inquire or book an appointment for this vehicle.</p>
                            
                            <div class="flex gap-4 justify-center">
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-[#E52B2B] text-white font-bold rounded-xl hover:bg-red-700 transition shadow-md">Log In</a>
                                <a href="{{ route('register') }}" class="px-8 py-3 bg-white/10 text-white font-bold rounded-xl hover:bg-white/20 border border-white/10 transition shadow-md">Register</a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        {{-- ===== INQUIRY FORM SECTION (Secured via @auth) ===== --}}
        @auth
            <div id="inquiry-form" class="mt-20 max-w-3xl mx-auto bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 md:p-12 shadow-2xl">
                <h2 class="text-2xl font-bold text-white mb-2 text-center">Send an Inquiry</h2>
                <p class="text-zinc-400 text-center mb-8">Ref: {{ $car->brand->brand_name }} {{ $car->model_name }} (VIN: {{ $car->carSpecification->vin_number ?? 'N/A' }})</p>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-zinc-400 mb-2">Full Name</label>
                            <input type="text" name="name" required value="{{ auth()->user()->name }}" readonly
                                class="w-full bg-black/40 border border-white/10 text-zinc-500 rounded-lg px-4 py-3 outline-none cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-400 mb-2">Email Address</label>
                            <input type="email" name="email" required value="{{ auth()->user()->email }}" readonly
                                class="w-full bg-black/40 border border-white/10 text-zinc-500 rounded-lg px-4 py-3 outline-none cursor-not-allowed">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Message</label>
                        <textarea name="message" rows="4" required
                            class="w-full bg-black/40 border border-white/10 text-white rounded-lg focus:ring-[#E52B2B] focus:border-[#E52B2B] px-4 py-3 outline-none transition resize-none backdrop-blur-sm">I am interested in the {{ $car->brand->brand_name }} {{ $car->model_name }} listed for ₱{{ number_format($car->price) }}. Please provide me with more details or let me know when I can schedule a viewing.</textarea>
                    </div>

                    <button type="submit" class="w-full bg-white text-black font-bold py-4 rounded-xl hover:bg-zinc-200 transition shadow-md text-lg">
                        Submit Inquiry
                    </button>
                </form>
            </div>
        @endauth

    </div>
</div>

@push('scripts')
<script type="module">
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
</script>
@endpush
@endsection