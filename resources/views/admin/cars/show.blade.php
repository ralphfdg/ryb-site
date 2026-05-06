@extends('layouts.admin')

@section('content')
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Ambient Background Shapes -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[10%] right-[10%] w-[600px] h-[600px] rounded-full bg-[#e52a2a]/5 blur-[150px]"></div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10 pt-4 pb-12">
        <!-- Header -->
        <div class="flex justify-between items-end mb-8">
            <div class="flex items-center gap-4">
                @if ($car->brand->getFirstMediaUrl('brand_logos'))
                    <img src="{{ $car->brand->getFirstMediaUrl('brand_logos') }}"
                        class="h-12 w-auto object-contain bg-[#0a0a0a] p-2 rounded border border-[#222]">
                @endif
                <div>
                    <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1 flex items-center gap-3">
                        <span class="text-white">{{ $car->brand->brand_name }}</span>
                        <span class="text-[#e52a2a]">{{ $car->model_name }}</span>
                        @if ($car->is_featured)
                            <span
                                class="bg-[#e52a2a]/20 text-[#e52a2a] border border-[#e52a2a]/30 text-[10px] px-2 py-1 rounded tracking-widest">FEATURED</span>
                        @endif
                    </h2>
                    <p class="text-[#666] text-sm font-medium">VIN: <span
                            class="text-[#aaa] font-mono">{{ $car->carSpecification->vin_number ?? 'N/A' }}</span></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.cars.index') }}"
                    class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
                <a href="{{ route('admin.cars.edit', $car) }}"
                    class="bg-[#1a1a1a] border border-[#333] hover:bg-[#222] text-white text-[11px] font-bold uppercase tracking-wider px-5 py-2.5 rounded-lg transition-all shadow-lg">
                    Edit Vehicle
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Gallery & Primary Specs -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Swiper Image Gallery -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-4">
                    <div class="swiper mySwiper rounded-xl overflow-hidden aspect-video border border-[#1a1a1a]">
                        <div class="swiper-wrapper">
                            @forelse($car->getMedia('car_gallery') as $media)
                                <div class="swiper-slide bg-[#050505] flex items-center justify-center">
                                    <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover" />
                                </div>
                            @empty
                                <div
                                    class="swiper-slide bg-[#050505] flex flex-col items-center justify-center text-[#444]">
                                    <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-sm font-medium uppercase tracking-widest">No Media Uploaded</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-button-next text-[#e52a2a]"></div>
                        <div class="swiper-button-prev text-[#e52a2a]"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- 1:1 carSpecifications Table -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8">
                    <h3
                        class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">
                        Technical Specifications</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-6 gap-x-4">
                        <div>
                            <p class="text-[10px] text-[#666] uppercase tracking-widest font-bold">Body Type</p>
                            <p class="text-white text-sm mt-1">{{ $car->carType->name ?? 'Unspecified' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase tracking-widest font-bold">Engine</p>
                            <p class="text-white text-sm mt-1">{{ $car->carSpecification->engine_type ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase tracking-widest font-bold">Transmission</p>
                            <p class="text-white text-sm mt-1">{{ $car->transmission }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase tracking-widest font-bold">Fuel Type</p>
                            <p class="text-white text-sm mt-1">{{ $car->fuel_type }}
                                ({{ $car->carSpecification->fuel_capacity ?? 'N/A' }})</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase tracking-widest font-bold">Exterior Color</p>
                            <p class="text-white text-sm mt-1">{{ $car->carSpecification->color_exterior ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase tracking-widest font-bold">Interior Color</p>
                            <p class="text-white text-sm mt-1">{{ $car->carSpecification->color_interior ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Pricing, Status & Features -->
            <div class="space-y-8">
                <!-- Pricing & Status Card -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8">
                    <h3 class="text-[#888] text-[11px] font-bold uppercase tracking-widest mb-2">Listing Price</h3>
                    <p class="text-4xl font-bold text-[#2ecc71] mb-6 font-['Oswald'] tracking-wide">
                        ₱{{ number_format($car->price, 2) }}</p>

                    <div class="flex justify-between items-center py-4 border-t border-[#222]">
                        <span class="text-xs text-[#888] uppercase tracking-widest font-bold">Current Status</span>
                        @if ($car->status == 'Available')
                            <span
                                class="px-3 py-1 bg-[#051c0d] text-[#2ecc71] rounded-full border border-[#0a381a] text-[10px] font-bold uppercase tracking-wider">Available</span>
                        @elseif($car->status == 'Reserved')
                            <span
                                class="px-3 py-1 bg-[#2a1a08] text-[#f39c12] rounded-full border border-[#3a2a0a] text-[10px] font-bold uppercase tracking-wider">Reserved</span>
                        @else
                            <span
                                class="px-3 py-1 bg-[#2a0808] text-[#e52a2a] rounded-full border border-[#3a0a0a] text-[10px] font-bold uppercase tracking-wider">Sold</span>
                        @endif
                    </div>

                    <div class="flex justify-between items-center py-4 border-t border-[#222]">
                        <span class="text-xs text-[#888] uppercase tracking-widest font-bold">Mileage</span>
                        <span class="text-white text-sm font-medium">{{ number_format($car->mileage) }} km</span>
                    </div>

                    <div class="flex justify-between items-center py-4 border-t border-[#222]">
                        <span class="text-xs text-[#888] uppercase tracking-widest font-bold">Prev. Owners</span>
                        <span class="text-white text-sm font-medium">{{ $car->previous_owners }}</span>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-[#222]">
                        <span class="text-xs text-[#888] uppercase tracking-widest font-bold">Plate Ending</span>
                        <span
                            class="text-white text-sm font-medium bg-[#1a1a1a] px-3 py-1 rounded border border-[#333]">{{ $car->plate_ending }}</span>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8">
                    <h3
                        class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">
                        Additional Features</h3>
                    <ul class="space-y-3">
                        @php
                            // Ensure $features is iterable. If it's a string (due to bad data), we split it.
$features = $car->features;
if (is_string($features)) {
    $features = array_map('trim', explode(',', $features));
                            }
                        @endphp

                        @forelse($features ?? [] as $feature)
                            <li class="flex items-start gap-3 text-sm text-[#ddd]">
                                <svg class="w-4 h-4 text-[#e52a2a] mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $feature }}
                            </li>
                        @empty
                            <li class="text-xs text-[#666] italic">No additional features listed.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper.js Initialization -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".mySwiper", {
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: true,
                }
            });
        });
    </script>
@endsection
