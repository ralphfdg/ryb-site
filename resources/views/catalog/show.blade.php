@extends('layouts.app')

@section('content')
    <div class="bg-ryb-darker min-h-screen pt-24 pb-20 text-ryb-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="mb-8 bg-green-500/10 border border-green-500/20 rounded-xl p-4 flex items-center gap-3 text-green-400 backdrop-blur-md transition-all">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- ===== NAVIGATION ===== --}}
            <a href="{{ route('catalog.index') }}"
                class="inline-flex items-center text-zinc-500 hover:text-white transition mb-8 font-medium group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Inventory
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- ===== LEFT COLUMN: MEDIA GALLERY ===== --}}
                <div class="space-y-4">
                    <div
                        class="swiper mySwiper2 rounded-2xl overflow-hidden border border-ryb-muted shadow-2xl shadow-black/80 aspect-[4/3] bg-ryb-dark backdrop-blur-md relative">
                        <div class="swiper-wrapper">
                            @forelse($car->getMedia('car_gallery') as $image)
                                <div class="swiper-slide flex justify-center items-center">
                                    <img src="{{ $image->getUrl() }}" alt="{{ $car->model_name }}"
                                        class="w-full h-full object-cover" />
                                </div>
                            @empty
                                <div
                                    class="swiper-slide flex flex-col items-center justify-center text-zinc-600 bg-ryb-dark">
                                    <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p>No Images Available</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-button-next !text-ryb-red drop-shadow-md"></div>
                        <div class="swiper-button-prev !text-ryb-red drop-shadow-md"></div>
                    </div>

                    <div class="swiper mySwiper h-24">
                        <div class="swiper-wrapper">
                            @foreach ($car->getMedia('car_gallery') as $image)
                                <div
                                    class="swiper-slide rounded-lg overflow-hidden border border-ryb-muted cursor-pointer opacity-50 hover:opacity-100 transition [&.swiper-slide-thumb-active]:opacity-100 [&.swiper-slide-thumb-active]:border-ryb-red">
                                    <img src="{{ $image->getUrl('thumb') ?? $image->getUrl() }}"
                                        class="w-full h-full object-cover" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ===== RIGHT COLUMN: VEHICLE INFO ===== --}}
                <div class="flex flex-col">
                    <div class="border-b border-ryb-muted pb-6 mb-6">
                        <div class="flex justify-between items-start mb-2">
                            <h1 class="text-3xl md:text-4xl font-bold text-white">
                                {{ $car->brand->brand_name }}
                                <span class="text-ryb-red font-medium text-2xl uppercase">{{ $car->model_name }}</span>
                            </h1>
                            <span
                                class="px-3 py-1 {{ $car->status === 'Available' ? 'bg-green-500/10 text-green-400 border-green-500/20' : 'bg-ryb-red/10 text-ryb-red border-ryb-red/20' }} border rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md">
                                {{ $car->status }}
                            </span>
                        </div>

                        <p class="text-sm text-zinc-500 font-mono uppercase tracking-wider flex gap-3 items-center">
                            <span>Year: {{ $car->year }}</span>
                            <span class="w-1 h-1 bg-ryb-muted rounded-full"></span>
                            <span>VIN: {{ $car->carSpecification->vin_number ?? 'N/A' }}</span>
                        </p>

                        <div class="mt-6">
                            <p class="text-4xl font-bold text-white tracking-tight">₱{{ number_format($car->price, 2) }}
                            </p>
                        </div>
                    </div>

                    {{-- Specs Data Dictionary Implementation --}}
                    <div class="flex-grow">
                        <h3
                            class="text-xl font-bold text-white mb-4 flex items-center gap-2 border-b border-ryb-muted pb-2">
                            <svg class="w-5 h-5 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                            Vehicle Details
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                            <div
                                class="bg-ryb-dark border border-ryb-muted rounded-xl p-4 transition hover:bg-ryb-muted/50">
                                <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Mileage</p>
                                <p class="font-bold text-ryb-light">{{ number_format($car->mileage) }} km</p>
                            </div>
                            <div
                                class="bg-ryb-dark border border-ryb-muted rounded-xl p-4 transition hover:bg-ryb-muted/50">
                                <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Transmission</p>
                                <p class="font-bold text-ryb-light">{{ $car->transmission }}</p>
                            </div>
                            <div
                                class="bg-ryb-dark border border-ryb-muted rounded-xl p-4 transition hover:bg-ryb-muted/50">
                                <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Fuel Type</p>
                                <p class="font-bold text-ryb-light">{{ $car->fuel_type }}</p>
                            </div>
                            <div
                                class="bg-ryb-dark border border-ryb-muted rounded-xl p-4 transition hover:bg-ryb-muted/50">
                                <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Color</p>
                                <p class="font-bold text-ryb-light">{{ $car->carSpecification->color_exterior ?? 'N/A' }}
                                </p>
                            </div>
                            <div
                                class="bg-ryb-dark border border-ryb-muted rounded-xl p-4 transition hover:bg-ryb-muted/50">
                                <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Body Type</p>
                                <p class="font-bold text-ryb-light">{{ $car->carType->name ?? 'N/A' }}</p>
                            </div>
                            <div
                                class="bg-ryb-dark border border-ryb-muted rounded-xl p-4 transition hover:bg-ryb-muted/50">
                                <p class="text-xs text-zinc-500 uppercase tracking-wider mb-1">Engine</p>
                                <p class="font-bold text-ryb-light text-xs">
                                    {{ $car->carSpecification->engine_type ?? 'N/A' }}</p>
                            </div>
                        </div>

                        @if (!empty($car->features))
                            <h4 class="text-sm font-bold text-zinc-500 mt-8 mb-4 uppercase tracking-wider">Premium Features
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($car->features as $feature)
                                    <span
                                        class="px-4 py-1.5 bg-ryb-dark border border-ryb-muted text-ryb-light rounded-full text-sm backdrop-blur-sm flex items-center gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-ryb-red"></div>
                                        {{ $feature }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ===== CTA AREA ===== --}}
                    <div class="mt-10">
                        <div
                            class="bg-ryb-dark border border-ryb-muted rounded-2xl p-6 shadow-lg text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-6 border-l-4 border-l-ryb-red">
                            <div>
                                <h3 class="text-lg font-bold text-white mb-1">Interested in this vehicle?</h3>
                                <p class="text-zinc-500 text-sm">
                                    @auth Choose an action below.
                                    @else
                                    Login to inquire or book. @endauth
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row w-full md:w-auto gap-4">
                                @auth
                                    <div class="flex gap-2">
                                        <button
                                            onclick="document.getElementById('interaction-hub').scrollIntoView({behavior: 'smooth'})"
                                            class="px-8 py-3 bg-ryb-red text-white font-bold rounded-xl hover:bg-ryb-red-dark transition shadow-lg shadow-ryb-red/20 whitespace-nowrap">
                                            Interact with Dealer
                                        </button>

                                        {{-- Save to Wishlist Button --}}
                                        <button x-data @click.prevent="$store.wishlist.toggle({{ $car->id }})"
                                            class="px-6 py-3 border font-bold rounded-xl transition flex items-center gap-2"
                                            :class="$store.wishlist.items.includes({{ $car->id }}) ?
                                                'border-ryb-red text-ryb-red bg-ryb-red/10' :
                                                'border-ryb-muted text-zinc-400 hover:text-white hover:border-white/30'">
                                            <svg class="w-5 h-5"
                                                :fill="$store.wishlist.items.includes({{ $car->id }}) ? 'currentColor' :
                                                    'none'"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <span
                                                x-text="$store.wishlist.items.includes({{ $car->id }}) ? 'Saved' : 'Save Car'"></span>
                                        </button>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="px-8 py-3 border border-ryb-red text-ryb-red font-bold rounded-xl hover:bg-ryb-red hover:text-white transition text-center">
                                        Log In
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== INTERACTION HUB (AUTHENTICATED ONLY) ===== --}}
            @auth
                <div id="interaction-hub" class="mt-24 max-w-4xl mx-auto"
                    x-data='appointmentScheduler(@json($bookedSlots ?? []))'>
                    <div class="flex space-x-2 bg-ryb-dark p-1 rounded-2xl mb-6 border border-ryb-muted">
                        <button @click="activeTab = 'appointment'"
                            :class="activeTab === 'appointment' ? 'bg-ryb-red text-white shadow-lg' :
                                'text-zinc-500 hover:text-ryb-light hover:bg-ryb-muted'"
                            class="flex-1 py-3 px-4 rounded-xl font-bold text-sm transition duration-200">
                            Schedule Viewing
                        </button>
                        <button @click="activeTab = 'inquiry'"
                            :class="activeTab === 'inquiry' ? 'bg-ryb-red text-white shadow-lg' :
                                'text-zinc-500 hover:text-ryb-light hover:bg-ryb-muted'"
                            class="flex-1 py-3 px-4 rounded-xl font-bold text-sm transition duration-200">
                            General Inquiry
                        </button>
                    </div>

                    <div
                        class="bg-ryb-dark border border-ryb-muted rounded-3xl p-8 md:p-10 shadow-2xl relative overflow-hidden">

                        {{-- APPOINTMENT FORM --}}
                        <div x-show="activeTab === 'appointment'" x-transition:enter="transition duration-300"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0">
                            <h2 class="text-2xl font-bold text-white mb-2 text-center text-ryb-red">Book a Viewing</h2>
                            <p class="text-zinc-500 text-center mb-8">Select an available date and time slot for inspection.
                            </p>

                            {{-- NEW: Global Limit Warning (E.g., 3 active appointments reached) --}}
                            @error('limit')
                                <div
                                    class="mb-8 bg-ryb-red/10 border border-ryb-red/30 p-4 rounded-xl flex items-start gap-4 text-ryb-red backdrop-blur-md shadow-lg shadow-ryb-red/5">
                                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-sm tracking-wide uppercase">Request Limit Reached</h4>
                                        <p class="text-sm mt-1 text-ryb-red/80">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror

                            {{-- NEW: Vehicle Specific Warning (E.g., Already pending for this car) --}}
                            @error('car_id')
                                <div
                                    class="mb-8 bg-yellow-500/10 border border-yellow-500/30 p-4 rounded-xl flex items-start gap-4 text-yellow-500 backdrop-blur-md shadow-lg shadow-yellow-500/5">
                                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-sm tracking-wide uppercase">Duplicate Request</h4>
                                        <p class="text-sm mt-1 text-yellow-500/80">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror

                            <form action="{{ route('dashboard.appointments.store') }}" method="POST" class="space-y-8"
                                @submit="validateForm($event)">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <input type="hidden" name="scheduled_at" :value="formattedDateTime">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-white mb-4 flex items-center gap-2 font-mono">
                                            <span class="w-2 h-2 rounded-full bg-ryb-red"></span> SELECT DATE
                                        </label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <template x-for="date in availableDates" :key="date.value">
                                                <div @click="selectedDate = date.value"
                                                    :class="selectedDate === date.value ?
                                                        'bg-ryb-red border-ryb-red text-white shadow-lg shadow-ryb-red/20' :
                                                        'bg-ryb-darker border-ryb-muted text-zinc-500 hover:border-zinc-500'"
                                                    class="border rounded-xl p-3 text-center cursor-pointer transition select-none">
                                                    <p class="text-[10px] uppercase tracking-widest font-bold opacity-60"
                                                        x-text="date.dayName"></p>
                                                    <p class="text-lg font-bold mt-1" x-text="date.display"></p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-white mb-4 flex items-center gap-2 font-mono">
                                            <span class="w-2 h-2 rounded-full bg-ryb-red"></span> SELECT TIME
                                        </label>
                                        <div x-show="!selectedDate"
                                            class="flex items-center justify-center h-32 border border-dashed border-ryb-muted rounded-xl text-zinc-600 text-sm">
                                            Please select a date first.
                                        </div>
                                        <div x-show="selectedDate" class="grid grid-cols-2 gap-3" style="display: none;">
                                            <template x-for="time in processedTimeSlots" :key="time.value">
                                                <button type="button" @click="if(!time.isBooked) selectedTime = time.value"
                                                    :disabled="time.isBooked"
                                                    :class="{
                                                        'bg-ryb-red border-ryb-red text-white': selectedTime === time
                                                            .value && !time.isBooked,
                                                        'bg-ryb-darker border-ryb-muted text-zinc-400': selectedTime !==
                                                            time.value && !time.isBooked,
                                                        'bg-ryb-darker opacity-30 text-zinc-700 cursor-not-allowed': time
                                                            .isBooked
                                                    }"
                                                    class="border rounded-xl p-3 text-center transition relative overflow-hidden group">
                                                    <p class="text-base font-bold" x-text="time.display"></p>
                                                    <div x-show="time.isBooked"
                                                        class="absolute inset-0 flex items-center justify-center bg-black/40">
                                                        <span
                                                            class="text-[8px] font-black uppercase tracking-tighter text-ryb-red">TAKEN</span>
                                                    </div>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                @error('scheduled_at')
                                    <div
                                        class="bg-ryb-red/10 border border-ryb-red/50 text-ryb-red p-3 rounded-lg text-sm text-center">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <button type="submit" :disabled="!selectedDate || !selectedTime"
                                    :class="(!selectedDate || !selectedTime) ? 'opacity-50 grayscale cursor-not-allowed' :
                                    'hover:bg-ryb-red-dark shadow-ryb-red/20'"
                                    class="w-full bg-ryb-red text-white font-bold py-4 rounded-xl transition-all text-lg mt-8 flex justify-center items-center gap-2">
                                    Confirm Request
                                </button>
                            </form>
                        </div>

                        {{-- INQUIRY FORM --}}
                        <div x-show="activeTab === 'inquiry'" x-transition:enter="transition duration-300"
                            x-transition:enter-start="opacity-0 -translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                            <h2 class="text-2xl font-bold text-white mb-2 text-center text-ryb-red text-ryb-red">Send an
                                Inquiry</h2>
                            <p class="text-zinc-500 text-center mb-8">Ref: {{ $car->brand->brand_name }}
                                {{ $car->model_name }}</p>

                            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 opacity-60">
                                    <div>
                                        <label class="block text-xs font-bold text-zinc-500 mb-2 font-mono">CUSTOMER
                                            NAME</label>
                                        <input type="text" value="{{ auth()->user()->name }}" readonly
                                            class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg px-4 py-3 outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-zinc-500 mb-2 font-mono">CONTACT
                                            EMAIL</label>
                                        <input type="email" value="{{ auth()->user()->email }}" readonly
                                            class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg px-4 py-3 outline-none">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-zinc-500 mb-2 font-mono uppercase">Your
                                        Message</label>
                                    <textarea name="message" rows="4" required
                                        class="w-full bg-ryb-darker border border-ryb-muted text-white rounded-xl focus:border-ryb-red px-4 py-3 outline-none transition resize-none">I'm interested in this {{ $car->model_name }}. Please send more details.</textarea>
                                    @error('message')
                                        <span class="text-ryb-red text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="w-full border-2 border-ryb-red text-ryb-red hover:bg-ryb-red hover:text-white font-bold py-4 rounded-xl transition text-lg">
                                    Submit Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
@endsection
