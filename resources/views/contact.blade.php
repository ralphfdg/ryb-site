@extends('layouts.app')

@section('content')
<div class="bg-ryb-black border-b border-ryb-dark pt-32 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-ryb-light tracking-tight">Get in <span class="text-ryb-red">Touch</span></h1>
        <p class="text-ryb-light/60 mt-4 text-lg">We are here to help you find your next premium vehicle.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        
        <div class="bg-ryb-dark/30 backdrop-blur-lg border border-ryb-dark rounded-2xl p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-ryb-light mb-6">Send us a Message</h2>
            
            <form action="#" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">First Name</label>
                        <input type="text" name="first_name" required class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 placeholder-ryb-light/30" placeholder="John">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Last Name</label>
                        <input type="text" name="last_name" required class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 placeholder-ryb-light/30" placeholder="Doe">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Email Address</label>
                        <input type="email" name="email" required class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 placeholder-ryb-light/30" placeholder="john@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ryb-light/70 mb-2">Phone Number</label>
                        <input type="tel" name="phone" class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 placeholder-ryb-light/30" placeholder="(555) 123-4567">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-ryb-light/70 mb-2">Subject</label>
                    <select name="subject" class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3">
                        <option value="general">General Inquiry</option>
                        <option value="financing">Financing Options</option>
                        <option value="trade-in">Trade-In Valuation</option>
                        <option value="schedule">Schedule a Test Drive</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-ryb-light/70 mb-2">Message</label>
                    <textarea name="message" rows="5" required class="w-full bg-ryb-black border border-ryb-dark text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 placeholder-ryb-light/30 resize-none" placeholder="How can we assist you today?"></textarea>
                </div>

                <button type="submit" class="w-full bg-ryb-red text-white font-bold py-4 rounded-lg hover:bg-red-700 transition shadow-[0_0_15px_rgba(215,35,35,0.3)]">
                    Send Message
                </button>
            </form>
        </div>

        <div class="space-y-8">
            
            <div class="w-full h-64 bg-ryb-dark rounded-2xl overflow-hidden border border-ryb-dark relative group">
                <img src="https://placehold.co/800x400/000000/3e3636?text=Interactive+Map" alt="Map Location" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition duration-500">
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                     <span class="bg-ryb-black/80 text-ryb-red font-bold px-4 py-2 rounded-full backdrop-blur-sm border border-ryb-red/50">View on Google Maps</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <div class="bg-ryb-dark/20 border border-ryb-dark rounded-xl p-6">
                    <h3 class="text-lg font-bold text-ryb-light mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Showroom
                    </h3>
                    <p class="text-ryb-light/60 text-sm leading-relaxed">
                        123 Luxury Drive<br>
                        Automotive District<br>
                        Beverly Hills, CA 90210
                    </p>
                </div>

                <div class="bg-ryb-dark/20 border border-ryb-dark rounded-xl p-6">
                    <h3 class="text-lg font-bold text-ryb-light mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Contact
                    </h3>
                    <p class="text-ryb-light/60 text-sm leading-relaxed">
                        <strong class="text-ryb-light">Sales:</strong> (555) 123-4567<br>
                        <strong class="text-ryb-light">Service:</strong> (555) 987-6543<br>
                        <strong class="text-ryb-light">Email:</strong> info@rybmotors.com
                    </p>
                </div>

                <div class="bg-ryb-dark/20 border border-ryb-dark rounded-xl p-6 sm:col-span-2">
                    <h3 class="text-lg font-bold text-ryb-light mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Business Hours
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="flex justify-between border-b border-ryb-dark/50 pb-2">
                            <span class="text-ryb-light/60">Monday - Friday</span>
                            <span class="text-ryb-light font-medium">9:00 AM - 8:00 PM</span>
                        </div>
                        <div class="flex justify-between border-b border-ryb-dark/50 pb-2">
                            <span class="text-ryb-light/60">Saturday</span>
                            <span class="text-ryb-light font-medium">10:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-ryb-light/60">Sunday</span>
                            <span class="text-ryb-red font-medium">Closed</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection