@extends('layouts.app')

@section('content')
<div>
    
    <div class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://placehold.co/1920x1080/000000/3e3636?text=RYB+Dealership+Exterior" alt="RYB Dealership" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-ryb-black via-ryb-black/80 to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-20">
            <h1 class="text-4xl md:text-6xl font-bold text-ryb-light mb-4 tracking-tight">Driven by <span class="text-ryb-red">Excellence</span></h1>
            <p class="text-lg text-ryb-light/80">Redefining the premium automotive retail experience.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div>
                <h2 class="text-3xl font-bold text-ryb-light mb-6">Our <span class="text-ryb-red">Story</span></h2>
                <div class="space-y-4 text-ryb-light/70 leading-relaxed">
                    <p>
                        Founded by a team of lifelong automotive enthusiasts, RYB Vehicle Trading was built on a simple premise: buying a luxury vehicle should be just as exhilarating as driving one. We noticed a gap in the market for a dealership that offered both high-end inventory and absolute transparency.
                    </p>
                    <p>
                        We carefully curate our showroom to feature only the finest vehicles from the world's most respected brands. Whether you are looking for an electric commuter, a rugged SUV, or a high-performance sports car, our collection is hand-picked to ensure unparalleled quality.
                    </p>
                    <p>
                        At RYB Motors, we do not just sell cars. We build lasting relationships with our clients, providing expert guidance, seamless financing, and a stress-free environment from the moment you walk through our doors.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-ryb-dark rounded-2xl overflow-hidden mt-8">
                    <img src="https://placehold.co/600x800/3e3636/f5eded?text=Handshake" alt="Customer Service" class="w-full h-full object-cover opacity-90 hover:opacity-100 transition duration-500">
                </div>
                <div class="bg-ryb-dark rounded-2xl overflow-hidden mb-8">
                    <img src="https://placehold.co/600x800/3e3636/f5eded?text=Steering+Wheel" alt="Premium Interior" class="w-full h-full object-cover opacity-90 hover:opacity-100 transition duration-500">
                </div>
            </div>

        </div>
    </div>

    <div class="bg-ryb-dark/10 border-y border-ryb-dark py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-ryb-light mb-4">The RYB <span class="text-ryb-red">Standard</span></h2>
                <p class="text-ryb-light/60">The principles that drive everything we do.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-8 text-center hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 mx-auto bg-ryb-black border border-ryb-red rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-ryb-light mb-3">Uncompromising Quality</h3>
                    <p class="text-sm text-ryb-light/60 leading-relaxed">Every vehicle undergoes a rigorous 150-point inspection before it ever reaches our showroom floor. We only sell the best.</p>
                </div>

                <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-8 text-center hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 mx-auto bg-ryb-black border border-ryb-red rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-ryb-light mb-3">Transparent Pricing</h3>
                    <p class="text-sm text-ryb-light/60 leading-relaxed">No hidden fees, no aggressive haggling. We offer upfront, market-competitive pricing so you can purchase with confidence.</p>
                </div>

                <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-8 text-center hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 mx-auto bg-ryb-black border border-ryb-red rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-ryb-light mb-3">Client-First Approach</h3>
                    <p class="text-sm text-ryb-light/60 leading-relaxed">From browsing to financing, our dedicated team is here to serve you, ensuring your experience is completely tailored to your needs.</p>
                </div>

            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <h2 class="text-3xl font-bold text-ryb-light mb-6">Ready to find your dream car?</h2>
        <p class="text-ryb-light/70 mb-8">Browse our online catalog or visit our state-of-the-art showroom today to experience the RYB difference in person.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#" class="px-8 py-4 bg-ryb-red text-white font-semibold rounded-full hover:bg-red-700 transition shadow-[0_0_20px_rgba(215,35,35,0.4)]">Browse Inventory</a>
            <a href="#" class="px-8 py-4 bg-transparent border border-ryb-light/30 text-ryb-light font-semibold rounded-full hover:bg-ryb-light/10 transition">Contact Us</a>
        </div>
    </div>

</div>
@endsection