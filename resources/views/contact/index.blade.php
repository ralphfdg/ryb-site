@extends('layouts.app')

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="bg-[#0f0f11] border-b border-white/10 pt-32 pb-12 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            Contact <span class="text-[#E52B2B]">Us</span>
        </h1>
        <p class="text-zinc-400 mt-4 text-lg">Have a general question? Our support team is here to assist you.</p>
    </div>
</div>

<div class="bg-[#0f0f11] min-h-screen py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Success Message Alert --}}
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 rounded-xl flex items-center gap-3 text-green-400 backdrop-blur-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Glassmorphism Contact Form --}}
        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 md:p-12 shadow-2xl">
            
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- User Identity (Readonly for Security & UX) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Full Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly
                            class="w-full bg-black/40 border border-white/10 text-zinc-500 rounded-lg px-4 py-3 outline-none cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Email Address</label>
                        <input type="email" value="{{ auth()->user()->email }}" readonly
                            class="w-full bg-black/40 border border-white/10 text-zinc-500 rounded-lg px-4 py-3 outline-none cursor-not-allowed">
                    </div>
                </div>

                {{-- Subject Line --}}
                <div>
                    <label class="block text-sm font-medium text-zinc-400 mb-2">Subject</label>
                    <input type="text" name="subject" required placeholder="What is your inquiry regarding?"
                        class="w-full bg-black/40 border border-white/10 text-white rounded-lg focus:ring-[#E52B2B] focus:border-[#E52B2B] px-4 py-3 outline-none transition backdrop-blur-sm">
                    @error('subject')
                        <span class="text-[#E52B2B] text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Main Message --}}
                <div>
                    <label class="block text-sm font-medium text-zinc-400 mb-2">Message</label>
                    <textarea name="message" rows="5" required placeholder="Type your message here..."
                        class="w-full bg-black/40 border border-white/10 text-white rounded-lg focus:ring-[#E52B2B] focus:border-[#E52B2B] px-4 py-3 outline-none transition resize-none backdrop-blur-sm"></textarea>
                    @error('message')
                        <span class="text-[#E52B2B] text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit Action --}}
                <button type="submit" class="w-full bg-[#E52B2B] text-white font-bold py-4 rounded-xl hover:bg-red-700 transition shadow-md shadow-red-900/20 text-lg">
                    Send General Inquiry
                </button>
            </form>
            
        </div>
    </div>
</div>

@endsection