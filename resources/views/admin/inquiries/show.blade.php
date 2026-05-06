@extends('layouts.admin')

@section('content')
    <!-- Ambient Background Shapes -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[10%] right-[10%] w-[600px] h-[600px] rounded-full bg-[#e52a2a]/5 blur-[150px]"></div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10 pt-4 pb-12">
        <!-- Header -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Process</span> <span class="text-[#e52a2a]">Ticket</span>
                </h2>
                <p class="text-[#666] text-sm">Ticket #{{ str_pad($inquiry->id, 5, '0', STR_PAD_LEFT) }} — Submitted {{ $inquiry->created_at->format('M d, Y @ h:i A') }}</p>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Inbox
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-[#2a0808] border border-[#e52a2a]/50 text-[#ff4757] px-6 py-4 rounded-xl text-sm backdrop-blur-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Context -->
            <div class="lg:col-span-1 space-y-6">
                <!-- User Profile -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6">
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Authenticated User</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Account Name</p>
                            <p class="text-white text-sm font-medium">{{ $inquiry->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Email Address</p>
                            <p class="text-[#a0a0a0] text-sm">{{ $inquiry->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Phone Number</p>
                            <p class="text-[#a0a0a0] text-sm">{{ $inquiry->user->phone_number ?? 'Not Provided' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Targeted Vehicle (If Any) -->
                @if($inquiry->car)
                    <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6 border-l-4 border-l-[#e52a2a]">
                        <h3 class="text-[#888] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Vehicle of Interest</h3>
                        <p class="text-white font-bold">{{ $inquiry->car->brand->brand_name ?? '' }} {{ $inquiry->car->model_name }}</p>
                        <p class="text-[#2ecc71] font-bold mt-1">₱{{ number_format($inquiry->car->price, 2) }}</p>
                        <a href="{{ route('admin.cars.show', $inquiry->car) }}" target="_blank" class="mt-4 inline-block text-[10px] uppercase font-bold tracking-widest text-[#4a90e2] hover:text-[#74b9ff] transition-colors">View Inventory Record &rarr;</a>
                    </div>
                @endif
            </div>

            <!-- Right Column: Message & Response -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Original Message -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8">
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4">Subject</h3>
                    <p class="text-xl text-white font-bold mb-6">{{ $inquiry->subject }}</p>
                    
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-t border-[#222] pt-4">Message Body</h3>
                    <div class="text-[#ddd] text-sm leading-relaxed whitespace-pre-wrap bg-[#050505] p-6 rounded-xl border border-[#1a1a1a]">{{ $inquiry->message }}</div>
                </div>

                <!-- Auto-Email Form -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8 {{ $inquiry->status === 'Resolved' ? 'opacity-60 pointer-events-none' : '' }}">
                    <h3 class="text-[#2ecc71] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">Resolution & Response</h3>
                    
                    @if($inquiry->status === 'Resolved')
                        <div class="mb-4 bg-[#051c0d] border border-[#0a381a] text-[#2ecc71] px-4 py-3 rounded text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            This ticket is permanently closed.
                        </div>
                    @else
                        <form action="{{ route('admin.inquiries.resolve', $inquiry) }}" method="POST">
                            @csrf
                            @method('PATCH') <!-- Or POST depending on your routes/web.php -->

                            <div class="mb-6">
                                <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Draft Email Response</label>
                                <textarea name="admin_response" required rows="6" placeholder="Type your response here. This will be sent directly to {{ $inquiry->user->email }} via our SMTP relay..." class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]"></textarea>
                            </div>

                            <div class="flex justify-end items-center gap-4">
                                <p class="text-[10px] text-[#666] uppercase tracking-widest font-bold">Action will mark ticket as Resolved</p>
                                <button type="submit" class="bg-[#e52a2a] hover:bg-[#c92222] text-white text-[11px] font-bold uppercase tracking-wider px-8 py-3 rounded-xl shadow-[0_0_15px_rgba(229,42,42,0.3)] transition-all hover:scale-[1.02] flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    Send Email & Resolve
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection