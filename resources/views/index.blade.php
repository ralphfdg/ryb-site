@extends('layouts.app')

@section('content')
    @php
        // Dummy Data for Backend Simulation
        $featuredCars = [
            [
                'brand' => 'Tesla',
                'model' => 'Model 3',
                'year' => 2024,
                'price' => 45990,
                'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=Tesla+Model+3',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Camry TRD',
                'year' => 2023,
                'price' => 34000,
                'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=Toyota+Camry',
            ],
            [
                'brand' => 'BMW',
                'model' => 'M4 Competition',
                'year' => 2024,
                'price' => 85000,
                'image' => 'https://placehold.co/600x400/3e3636/f5eded?text=BMW+M4',
            ],
        ];

        $soldCars = [
            ['name' => '2022 Porsche 911', 'image' => 'https://placehold.co/400x300/3e3636/f5eded?text=Sold+Porsche'],
            ['name' => '2023 Audi RS e-tron', 'image' => 'https://placehold.co/400x300/3e3636/f5eded?text=Sold+Audi'],
            [
                'name' => '2021 Mercedes AMG GT',
                'image' => 'https://placehold.co/400x300/3e3636/f5eded?text=Sold+Mercedes',
            ],
            [
                'name' => '2024 Range Rover',
                'image' => 'https://placehold.co/400x300/3e3636/f5eded?text=Sold+Range+Rover',
            ],
        ];
    @endphp

    <div x-data="homeController()">

        <div class="relative h-[90vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://placehold.co/1920x1080/000000/3e3636?text=Luxury+Showroom" alt="Showroom"
                    class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-gradient-to-t from-ryb-black via-transparent to-ryb-black"></div>
            </div>

            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-10">
                <h1 class="text-5xl md:text-7xl font-bold text-ryb-light mb-6 tracking-tight" x-text="heroTitle"></h1>
                <p class="text-lg md:text-xl text-ryb-light/80 mb-10 max-w-2xl mx-auto">Premium vehicles, transparent
                    pricing, and a seamless buying experience.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#"
                        class="px-8 py-4 bg-ryb-red text-white font-semibold rounded-full hover:bg-red-700 transition shadow-[0_0_20px_rgba(215,35,35,0.4)]">View
                        Inventory</a>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-16">
            <div class="bg-ryb-dark/40 backdrop-blur-xl border border-ryb-dark rounded-2xl p-6 shadow-2xl">
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-1">Make / Brand</label>
                        <select
                            class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3">
                            <option>All Brands</option>
                            <option>Toyota</option>
                            <option>Honda</option>
                            <option>Tesla</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-1">Max Price</label>
                        <select
                            class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3">
                            <option>Any Price</option>
                            <option>Under $30,000</option>
                            <option>Under $50,000</option>
                            <option>Under $80,000</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-1">Year</label>
                        <select
                            class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3">
                            <option>Any Year</option>
                            <option>2024 & Newer</option>
                            <option>2020 - 2023</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="w-full bg-ryb-red text-white font-semibold py-3 rounded-lg hover:bg-red-700 transition">Search
                        Vehicles</button>
                </form>
            </div>
        </div>

        <div class="border-y border-ryb-dark bg-ryb-black py-10 mt-20 overflow-hidden">
            <div
                class="flex space-x-12 animate-marquee whitespace-nowrap opacity-50 hover:opacity-100 transition duration-500">
                @for ($i = 0; $i < 2; $i++)
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">TOYOTA</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">HONDA</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">TESLA</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">FORD</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">BMW</span>
                    <span class="text-2xl font-bold text-ryb-light tracking-widest">MERCEDES</span>
                @endfor
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <h2 class="text-3xl font-bold text-ryb-light mb-8">Featured <span class="text-ryb-red">Inventory</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($featuredCars as $car)
                    <div
                        class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl overflow-hidden hover:bg-ryb-dark/50 transition">
                        <img src="{{ $car['image'] }}"
                            class="w-full h-48 object-cover opacity-90 hover:opacity-100 transition">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-ryb-light">{{ $car['brand'] }} {{ $car['model'] }}</h3>
                            <p class="text-ryb-red font-medium mt-2">${{ number_format($car['price']) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-ryb-light mb-2">The RYB <span class="text-ryb-red">Lifestyle</span></h2>
                <p class="text-ryb-light/60">A glimpse into our premium showroom.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-[600px]">
                <div class="col-span-2 row-span-2 bg-ryb-dark rounded-2xl overflow-hidden group">
                    <img src="https://placehold.co/800x800/3e3636/f5eded?text=Showroom+Main"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
                <div class="bg-ryb-dark rounded-2xl overflow-hidden group">
                    <img src="https://placehold.co/400x400/3e3636/f5eded?text=Detail+Shot+1"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
                <div class="bg-ryb-dark rounded-2xl overflow-hidden group">
                    <img src="https://placehold.co/400x400/3e3636/f5eded?text=Detail+Shot+2"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
                <div class="col-span-2 bg-ryb-dark rounded-2xl overflow-hidden group">
                    <img src="https://placehold.co/800x400/3e3636/f5eded?text=Interior+Shot"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
            </div>
        </div>

        <div class="bg-ryb-dark/10 border-t border-ryb-dark py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-ryb-light mb-8">Recently <span class="text-ryb-red">Delivered</span></h2>

                <div class="flex overflow-x-auto space-x-6 pb-8 snap-x scrollbar-hide">
                    @foreach ($soldCars as $sold)
                        <div
                            class="min-w-[300px] md:min-w-[400px] bg-ryb-black border border-ryb-dark rounded-2xl overflow-hidden snap-center shrink-0">
                            <img src="{{ $sold['image'] }}"
                                class="w-full h-56 object-cover opacity-80 grayscale hover:grayscale-0 transition duration-500">
                            <div class="p-5">
                                <h3 class="font-bold text-ryb-light">{{ $sold['name'] }}</h3>
                                <p class="text-sm text-green-500 mt-1">✓ Successfully Sold</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <div class="border-y border-ryb-dark bg-gradient-to-r from-ryb-black via-ryb-dark/40 to-ryb-black py-16 mt-12"
        x-data="statsCounter()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-ryb-dark/50">

                <div class="p-4">
                    <div class="text-4xl md:text-5xl font-bold text-ryb-light mb-2">
                        <span x-text="vehiclesDelivered">0</span>+
                    </div>
                    <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Vehicles Delivered</p>
                </div>

                <div class="p-4">
                    <div class="text-4xl md:text-5xl font-bold text-ryb-light mb-2">
                        <span x-text="partneredBrands">0</span>+
                    </div>
                    <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Partnered Brands</p>
                </div>

                <div class="p-4">
                    <div class="text-4xl md:text-5xl font-bold text-ryb-light mb-2">
                        <span x-text="happyClients">0</span>%
                    </div>
                    <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Happy Clients</p>
                </div>

                <div class="p-4">
                    <div class="text-4xl md:text-5xl font-bold text-ryb-light mb-2">
                        <span x-text="yearsExperience">0</span>
                    </div>
                    <p class="text-ryb-red font-semibold uppercase tracking-widest text-sm">Years Experience</p>
                </div>

            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-ryb-light mb-4">What Our <span class="text-ryb-red">Clients
                    Say</span></h2>
            <p class="text-ryb-light/60 max-w-2xl mx-auto">Don't just take our word for it. Hear from the community of
                automotive enthusiasts who found their dream cars with RYB.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div
                class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-8 relative hover:-translate-y-2 transition duration-300">
                <div class="absolute top-6 right-8 text-6xl text-ryb-red opacity-20 font-serif">"</div>
                <div class="flex text-ryb-red mb-4 text-xl">★★★★★</div>
                <p class="text-ryb-light/80 italic mb-6 relative z-10">"The easiest car buying experience I have ever had.
                    The team at RYB was completely transparent about pricing and helped me secure amazing financing for my
                    new M4."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-ryb-dark overflow-hidden">
                        <img src="https://placehold.co/100x100/000000/f5eded?text=MS" alt="Michael S."
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-ryb-light font-bold">Michael S.</h4>
                        <p class="text-sm text-ryb-light/50">Bought a 2024 BMW M4</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-8 relative hover:-translate-y-2 transition duration-300">
                <div class="absolute top-6 right-8 text-6xl text-ryb-red opacity-20 font-serif">"</div>
                <div class="flex text-ryb-red mb-4 text-xl">★★★★★</div>
                <p class="text-ryb-light/80 italic mb-6 relative z-10">"I traded in my old sedan for a Tesla Model 3. The
                    RYB staff made the trade-in process seamless and gave me a fantastic value. Highly recommended!"</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-ryb-dark overflow-hidden">
                        <img src="https://placehold.co/100x100/000000/f5eded?text=JD" alt="Jessica D."
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-ryb-light font-bold">Jessica D.</h4>
                        <p class="text-sm text-ryb-light/50">Bought a 2024 Tesla Model 3</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-8 relative hover:-translate-y-2 transition duration-300">
                <div class="absolute top-6 right-8 text-6xl text-ryb-red opacity-20 font-serif">"</div>
                <div class="flex text-ryb-red mb-4 text-xl">★★★★★</div>
                <p class="text-ryb-light/80 italic mb-6 relative z-10">"I love the glass showroom and the premium feel of
                    the dealership. They don't just sell cars; they sell an experience. Thrilled with my Camry TRD."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-ryb-dark overflow-hidden">
                        <img src="https://placehold.co/100x100/000000/f5eded?text=RP" alt="Robert P."
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-ryb-light font-bold">Robert P.</h4>
                        <p class="text-sm text-ryb-light/50">Bought a 2023 Toyota Camry</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 25s linear infinite;
        }

        /* Hide scrollbar for the sold cars carousel */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
