@extends('layouts.app')

@section('content')
    <div class="bg-[#0f0f11] min-h-screen pt-28 pb-16 text-zinc-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl p-4 flex items-center gap-3 text-emerald-400 backdrop-blur-md transition-all shadow-lg shadow-emerald-900/10">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="font-bold tracking-wide">{{ session('success') }}</p>
                </div>
            @endif

            {{-- ===== NAVIGATION ===== --}}
            <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-zinc-500 hover:text-white transition-colors duration-300 mb-6 font-medium group text-sm uppercase tracking-wider">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Inventory
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

                {{-- ===== LEFT COLUMN: MEDIA GALLERY ===== --}}
                <div class="space-y-4">
                    <div class="swiper mySwiper2 rounded-3xl overflow-hidden border border-white/10 shadow-2xl shadow-black/80 aspect-[4/3] bg-[#09090b] backdrop-blur-md relative group">
                        <div class="swiper-wrapper">
                            @forelse($car->getMedia('car_gallery') as $image)
                                <div class="swiper-slide flex justify-center items-center">
                                    <img src="{{ $image->getUrl() }}" onerror="this.src='https://placehold.co/800x600/09090b/27272a?text=Vehicle+Image'" alt="{{ $car->model_name }}" class="w-full h-full object-cover object-center" />
                                </div>
                            @empty
                                <div class="swiper-slide flex flex-col items-center justify-center text-zinc-600 bg-[#09090b]">
                                    <svg class="w-16 h-16 mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="font-medium tracking-wide">No Images Available</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-button-next !text-[#dc2626] drop-shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 after:!text-2xl"></div>
                        <div class="swiper-button-prev !text-[#dc2626] drop-shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 after:!text-2xl"></div>
                    </div>

                    {{-- Thumbnail Swiper --}}
                    <div class="swiper mySwiper h-24">
                        <div class="swiper-wrapper">
                            @foreach ($car->getMedia('car_gallery') as $image)
                                <div class="swiper-slide rounded-xl overflow-hidden border border-white/5 cursor-pointer opacity-40 hover:opacity-100 transition-all duration-300 [&.swiper-slide-thumb-active]:opacity-100 [&.swiper-slide-thumb-active]:border-[#dc2626]">
                                    {{-- Safely using getUrl() instead of getUrl('thumb') to prevent 404 broken image icons --}}
                                    <img src="{{ $image->getUrl() }}" onerror="this.src='https://placehold.co/150x150/09090b/27272a?text=Thumb'" class="w-full h-full object-cover object-center" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ===== RIGHT COLUMN: VEHICLE INFO ===== --}}
                <div class="flex flex-col">
                    <div class="border-b border-white/10 pb-6 mb-6">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-3">
                            <h1 class="text-3xl md:text-5xl font-bold text-white tracking-tight">
                                {{ $car->brand->brand_name }}
                                <span class="text-[#dc2626] font-medium uppercase block sm:inline mt-1 sm:mt-0">{{ $car->model_name }}</span>
                            </h1>
                            <span class="inline-flex self-start px-4 py-1.5 {{ $car->status === 'Available' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-[#dc2626]/10 text-[#dc2626] border-[#dc2626]/20' }} border rounded-full text-xs font-bold uppercase tracking-widest backdrop-blur-md shadow-inner">
                                {{ $car->status }}
                            </span>
                        </div>

                        <p class="text-sm text-zinc-500 font-mono uppercase tracking-wider flex flex-wrap gap-3 items-center">
                            <span>Year: <strong class="text-zinc-300">{{ $car->year }}</strong></span>
                            <span class="w-1.5 h-1.5 bg-white/20 rounded-full"></span>
                            <span>VIN: <strong class="text-zinc-300">{{ $car->carSpecification->vin_number ?? 'N/A' }}</strong></span>
                        </p>

                        <div class="mt-6">
                            <p class="text-5xl font-extrabold text-white tracking-tighter">
                                <span class="text-zinc-500 font-medium text-3xl mr-1">₱</span>{{ number_format($car->price, 2) }}
                            </p>
                        </div>
                    </div>

                    {{-- Specs Data Dictionary Implementation --}}
                    <div class="flex-grow">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-3 uppercase tracking-widest">
                            <svg class="w-5 h-5 text-[#dc2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Vehicle Specs
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-6">
                            <div class="bg-white/5 backdrop-blur-sm border border-white/5 rounded-2xl p-4 transition duration-300 hover:bg-white/10 hover:border-white/10">
                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5 font-bold">Mileage</p>
                                <p class="font-bold text-white">{{ number_format($car->mileage) }} km</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-white/5 rounded-2xl p-4 transition duration-300 hover:bg-white/10 hover:border-white/10">
                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5 font-bold">Transmission</p>
                                <p class="font-bold text-white">{{ $car->transmission }}</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-white/5 rounded-2xl p-4 transition duration-300 hover:bg-white/10 hover:border-white/10">
                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5 font-bold">Fuel Type</p>
                                <p class="font-bold text-white">{{ $car->fuel_type }}</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-white/5 rounded-2xl p-4 transition duration-300 hover:bg-white/10 hover:border-white/10">
                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5 font-bold">Color</p>
                                <p class="font-bold text-white">{{ $car->carSpecification->color_exterior ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-white/5 rounded-2xl p-4 transition duration-300 hover:bg-white/10 hover:border-white/10">
                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5 font-bold">Body Type</p>
                                <p class="font-bold text-white">{{ $car->carType->name ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-white/5 rounded-2xl p-4 transition duration-300 hover:bg-white/10 hover:border-white/10">
                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5 font-bold">Engine</p>
                                <p class="font-bold text-white text-sm line-clamp-1" title="{{ $car->carSpecification->engine_type ?? 'N/A' }}">
                                    {{ $car->carSpecification->engine_type ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        @if (!empty($car->features))
                            <h4 class="text-xs font-bold text-zinc-500 mb-3 uppercase tracking-widest border-t border-white/10 pt-5">Premium Features</h4>
                            <div class="flex flex-wrap gap-2.5">
                                @foreach ($car->features as $feature)
                                    <span class="px-4 py-2 bg-[#18181b] border border-white/5 text-zinc-300 rounded-xl text-xs font-medium backdrop-blur-md flex items-center gap-2 hover:border-[#dc2626]/50 transition-colors">
                                        <div class="w-1.5 h-1.5 rounded-full bg-[#dc2626] shadow-[0_0_8px_#dc2626]"></div>
                                        {{ $feature }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ===== CTA AREA ===== --}}
                    <div class="mt-8">
                        <div class="bg-[#18181b] border border-white/5 rounded-3xl p-6 shadow-xl text-center md:text-left flex flex-col xl:flex-row items-center justify-between gap-6 border-l-4 border-l-[#dc2626]">
                            <div>
                                <h3 class="text-lg font-bold text-white mb-1 tracking-wide">Interested in this vehicle?</h3>
                                <p class="text-zinc-500 text-sm">
                                    @auth Choose an action below to proceed.
                                    @else Log in to inquire or book an inspection. @endauth
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row w-full xl:w-auto gap-4">
                                @auth
                                    <div class="flex gap-3 w-full">
                                        <button onclick="document.getElementById('interaction-hub').scrollIntoView({behavior: 'smooth'})"
                                            class="flex-1 sm:flex-none px-6 py-3 bg-[#dc2626] text-white font-bold rounded-xl hover:bg-red-700 transition duration-300 shadow-lg shadow-red-900/20 whitespace-nowrap tracking-wide">
                                            Interact with Dealer
                                        </button>

                                        {{-- Save to Wishlist Button --}}
                                        <button x-data @click.prevent="$store.wishlist.toggle({{ $car->id }})"
                                            class="px-5 py-3 border font-bold rounded-xl transition-all duration-300 flex items-center justify-center gap-2"
                                            :class="$store.wishlist.items.includes({{ $car->id }}) ?
                                                'border-[#dc2626] text-[#dc2626] bg-[#dc2626]/10' :
                                                'border-white/10 text-zinc-400 hover:text-white hover:border-white/30 bg-[#09090b]'">
                                            <svg class="w-5 h-5 transition-transform duration-300" :class="$store.wishlist.items.includes({{ $car->id }}) ? 'scale-110' : ''"
                                                :fill="$store.wishlist.items.includes({{ $car->id }}) ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <span x-text="$store.wishlist.items.includes({{ $car->id }}) ? 'Saved' : 'Save'"></span>
                                        </button>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-3 border border-[#dc2626] text-[#dc2626] font-bold rounded-xl hover:bg-[#dc2626] hover:text-white transition duration-300 text-center tracking-wide shadow-[0_0_15px_rgba(220,38,38,0.1)]">
                                        Log In Required
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== INTERACTION HUB (AUTHENTICATED ONLY) ===== --}}
            @auth
                <div id="interaction-hub" class="mt-16 max-w-5xl mx-auto" x-data='appointmentScheduler(@json($bookedSlots))'>
                    
                    {{-- Tab Segmented Control --}}
                    <div class="flex space-x-2 bg-[#18181b] p-1.5 rounded-2xl mb-6 border border-white/5 shadow-inner">
                        <button @click="activeTab = 'appointment'"
                            :class="activeTab === 'appointment' ? 'bg-[#dc2626] text-white shadow-lg' : 'text-zinc-500 hover:text-zinc-300 hover:bg-white/5'"
                            class="flex-1 py-3 px-4 rounded-xl font-bold text-sm tracking-wide transition-all duration-300 uppercase">
                            Schedule Viewing
                        </button>
                        <button @click="activeTab = 'inquiry'"
                            :class="activeTab === 'inquiry' ? 'bg-[#dc2626] text-white shadow-lg' : 'text-zinc-500 hover:text-zinc-300 hover:bg-white/5'"
                            class="flex-1 py-3 px-4 rounded-xl font-bold text-sm tracking-wide transition-all duration-300 uppercase">
                            General Inquiry
                        </button>
                    </div>

                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-10 shadow-2xl relative overflow-hidden">

                        {{-- APPOINTMENT FORM --}}
                        <div x-show="activeTab === 'appointment'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <h2 class="text-3xl font-bold text-white mb-2 text-center tracking-tight">Book an <span class="text-[#dc2626]">Inspection</span></h2>
                            <p class="text-zinc-400 text-center mb-8">Select an available date and time slot to view the vehicle in person.</p>

                            {{-- Global Limit Warning --}}
                            @error('limit')
                                <div class="mb-6 bg-[#dc2626]/10 border border-[#dc2626]/30 p-5 rounded-2xl flex items-start gap-4 text-[#dc2626] backdrop-blur-md shadow-lg">
                                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-sm tracking-widest uppercase">Request Limit Reached</h4>
                                        <p class="text-sm mt-1 text-[#dc2626]/80 font-medium">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror

                            {{-- Vehicle Specific Warning --}}
                            @error('car_id')
                                <div class="mb-6 bg-amber-500/10 border border-amber-500/30 p-5 rounded-2xl flex items-start gap-4 text-amber-500 backdrop-blur-md shadow-lg">
                                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-sm tracking-widest uppercase">Duplicate Request</h4>
                                        <p class="text-sm mt-1 text-amber-500/80 font-medium">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror

                            <form action="{{ route('dashboard.appointments.store') }}" method="POST" class="space-y-8" @submit="validateForm($event)">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <input type="hidden" name="scheduled_at" :value="formattedDateTime">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    {{-- Date Selection --}}
                                    <div>
                                        <label class="block text-xs font-bold text-zinc-400 mb-4 uppercase tracking-widest border-b border-white/10 pb-2">
                                            1. Select Date
                                        </label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <template x-for="date in availableDates" :key="date.value">
                                                <div @click="selectedDate = date.value"
                                                    :class="selectedDate === date.value ?
                                                        'bg-[#dc2626]/10 border-[#dc2626] text-[#dc2626] shadow-[0_0_15px_rgba(220,38,38,0.2)]' :
                                                        'bg-black/40 border-white/5 text-zinc-400 hover:border-white/20 hover:bg-[#18181b] hover:text-white'"
                                                    class="border rounded-2xl p-4 text-center cursor-pointer transition-all duration-300 select-none">
                                                    <p class="text-[10px] uppercase tracking-widest font-bold opacity-70 mb-1" x-text="date.dayName"></p>
                                                    <p class="text-xl font-bold" x-text="date.display"></p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    {{-- Time Selection --}}
                                    <div>
                                        <label class="block text-xs font-bold text-zinc-400 mb-4 uppercase tracking-widest border-b border-white/10 pb-2">
                                            2. Select Time
                                        </label>
                                        <div x-show="!selectedDate" class="flex flex-col items-center justify-center h-32 border border-dashed border-white/10 bg-black/20 rounded-2xl text-zinc-600 text-sm">
                                            <svg class="w-6 h-6 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Awaiting Date Selection
                                        </div>
                                        <div x-show="selectedDate" class="grid grid-cols-2 gap-3" style="display: none;">
                                            <template x-for="time in processedTimeSlots" :key="time.value">
                                                <button type="button" @click="if(!time.isBooked) selectedTime = time.value"
                                                    :disabled="time.isBooked"
                                                    :class="{
                                                        'bg-[#dc2626] border-[#dc2626] text-white shadow-lg shadow-red-900/20': selectedTime === time.value,
                                                        'bg-black/40 border-white/5 text-zinc-400 hover:border-white/20 hover:text-white': selectedTime !== time.value && !time.isBooked,
                                                        'bg-[#09090b] border-white/5 text-zinc-700 cursor-not-allowed opacity-60': time.isBooked
                                                    }"
                                                    class="border rounded-xl py-3.5 px-2 text-sm font-bold transition-all duration-300 relative overflow-hidden group">
                                                    
                                                    <span x-text="time.display"></span>

                                                    <template x-if="time.isBooked">
                                                        <span class="absolute inset-0 flex items-center justify-center bg-[#09090b]/80 backdrop-blur-[2px] text-[10px] text-zinc-500 font-black uppercase tracking-widest">Unavailable</span>
                                                    </template>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                @error('scheduled_at')
                                    <div class="bg-[#dc2626]/10 border border-[#dc2626]/50 text-[#dc2626] p-4 rounded-xl text-sm text-center font-medium">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <button type="submit" :disabled="!selectedDate || !selectedTime"
                                    :class="(!selectedDate || !selectedTime) ? 'opacity-50 grayscale cursor-not-allowed bg-zinc-800' : 'bg-[#dc2626] hover:bg-red-700 shadow-lg shadow-red-900/20'"
                                    class="w-full text-white font-bold py-4 rounded-xl transition-all duration-300 text-lg mt-6 flex justify-center items-center gap-3 tracking-wide">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Confirm Appointment Request
                                </button>
                            </form>
                        </div>

                        {{-- INQUIRY FORM --}}
                        <div x-show="activeTab === 'inquiry'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <h2 class="text-3xl font-bold text-white mb-2 text-center tracking-tight">Send an <span class="text-[#dc2626]">Inquiry</span></h2>
                            <p class="text-zinc-400 text-center mb-8">Ref: <strong class="text-white">{{ $car->brand->brand_name }} {{ $car->model_name }}</strong></p>

                            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 opacity-70">
                                    <div>
                                        <label class="block text-[10px] font-bold text-zinc-500 mb-2 font-mono uppercase tracking-widest">Customer Name</label>
                                        <input type="text" value="{{ auth()->user()->name }}" readonly class="w-full bg-black/40 border border-white/5 text-zinc-300 rounded-xl px-4 py-3.5 outline-none cursor-not-allowed shadow-inner">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-zinc-500 mb-2 font-mono uppercase tracking-widest">Contact Email</label>
                                        <input type="email" value="{{ auth()->user()->email }}" readonly class="w-full bg-black/40 border border-white/5 text-zinc-300 rounded-xl px-4 py-3.5 outline-none cursor-not-allowed shadow-inner">
                                    </div>
                                </div>

                                <div class="pt-2">
                                    <label class="block text-xs font-bold text-zinc-400 mb-3 uppercase tracking-widest">Your Message</label>
                                    <textarea name="message" rows="5" required
                                        class="w-full bg-black/40 border border-white/10 text-white rounded-xl focus:border-[#dc2626] focus:ring-1 focus:ring-[#dc2626] px-5 py-4 outline-none transition-all duration-300 resize-none shadow-inner">I'm interested in the {{ $car->brand->brand_name }} {{ $car->model_name }}. Please send more details regarding availability and specifications.</textarea>
                                    @error('message')
                                        <span class="text-[#dc2626] text-xs mt-2 block font-medium">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="w-full border-2 border-[#dc2626] text-[#dc2626] hover:bg-[#dc2626] hover:text-white font-bold py-4 rounded-xl transition-all duration-300 text-lg tracking-wide shadow-md flex justify-center items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Submit Inquiry
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
@endsection