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
                    <span class="text-white">Process</span> <span class="text-[#e52a2a]">Appointment</span>
                </h2>
                <p class="text-[#666] text-sm">Ref #{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }} — Current Status: <span class="text-white font-bold">{{ $appointment->status }}</span></p>
            </div>
            <a href="{{ route('admin.appointments.index') }}" class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Queue
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-[#051c0d]/80 backdrop-blur border border-[#0a381a] text-[#2ecc71] px-4 py-3 rounded-lg text-sm shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Contextual Data -->
            <div class="lg:col-span-1 space-y-8">
                
                <!-- Customer Profile Card -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6">
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Customer Profile</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Full Name</p>
                            <p class="text-white text-sm font-medium">{{ $appointment->user->name ?? 'Guest User' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Email Address</p>
                            <p class="text-[#a0a0a0] text-sm">{{ $appointment->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Phone Number</p>
                            <p class="text-[#a0a0a0] text-sm">{{ $appointment->user->phone_number ?? 'N/A' }}</p>
                        </div>
                        <div class="pt-4 border-t border-[#222]">
                            <p class="text-[10px] text-[#666] uppercase font-bold mb-1">Requested Schedule</p>
                            <p class="text-white font-bold text-lg">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y') }}</p>
                            <p class="text-[#e52a2a] font-medium">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Target Vehicle Card -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6">
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Target Vehicle</h3>
                    
                    @if($appointment->car)
                        @if($appointment->car->getFirstMediaUrl('car_gallery'))
                            <img src="{{ $appointment->car->getFirstMediaUrl('car_gallery') }}" class="w-full h-32 object-cover rounded-lg mb-4 border border-[#333]">
                        @endif
                        <div class="space-y-3">
                            <div>
                                <p class="text-white font-bold text-lg">{{ $appointment->car->brand->brand_name }} {{ $appointment->car->model_name }}</p>
                                <p class="text-[#888] text-xs">VIN: <span class="font-mono text-[#aaa]">{{ $appointment->car->specification->vin_number ?? 'N/A' }}</span></p>
                            </div>
                            <div class="flex justify-between items-center py-2 border-y border-[#222]">
                                <span class="text-[10px] text-[#666] uppercase font-bold">Listed Price</span>
                                <span class="text-[#2ecc71] font-bold tracking-wide font-['Oswald']">₱{{ number_format($appointment->car->price, 2) }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-[#666] uppercase font-bold block mb-1">Vehicle Status</span>
                                @if($appointment->car->status == 'Available')
                                    <span class="px-2 py-0.5 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Available</span>
                                @else
                                    <span class="px-2 py-0.5 bg-[#2a1a08] text-[#f39c12] rounded border border-[#3a2a0a] text-[9px] font-bold uppercase tracking-wider">{{ $appointment->car->status }}</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="text-xs text-[#666] italic">Vehicle data unavailable or deleted.</p>
                    @endif
                </div>
            </div>

            <!-- Right Column: Operational Controls -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Step 1: Initial Approval Workflow -->
                @if($appointment->status === 'Pending')
                    <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#e52a2a]/30 shadow-[0_0_20px_rgba(229,42,42,0.1)] p-8">
                        <h3 class="text-white text-lg font-bold uppercase tracking-wide mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#e52a2a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Action Required: Pending Approval
                        </h3>
                        <p class="text-[#888] text-sm mb-6">Review the requested schedule. Approving this will shift the status to 'Approved' and (optionally) notify the customer.</p>
                        
                        <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST" class="flex gap-4">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-[#2ecc71] hover:bg-[#27ae60] text-[#050505] text-sm font-bold uppercase tracking-widest px-8 py-3 rounded-xl shadow-lg transition-all hover:scale-[1.02]">
                                Approve Schedule
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Step 2: Negotiation & Finalization Form -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8 {{ $appointment->status === 'Pending' ? 'opacity-50 pointer-events-none' : '' }}">
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">Negotiation & Finalization</h3>
                    
                    @if($appointment->status === 'Pending')
                        <div class="absolute inset-0 z-20 flex items-center justify-center bg-black/40 backdrop-blur-[2px] rounded-2xl">
                            <p class="text-white font-bold tracking-widest uppercase bg-[#050505] px-6 py-2 rounded-lg border border-[#333]">Approve Schedule First</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Update Operational Status</label>
                            <select name="status" required class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                                <option value="Approved" {{ $appointment->status == 'Approved' ? 'selected' : '' }}>Approved (Awaiting Viewing)</option>
                                <option value="Viewed" {{ $appointment->status == 'Viewed' ? 'selected' : '' }}>Viewed (In Negotiations)</option>
                                <option value="Committed" {{ $appointment->status == 'Committed' ? 'selected' : '' }}>Committed (Ready for Sales Ledger)</option>
                                <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Final Negotiated Price (PHP)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#e52a2a] font-bold">₱</span>
                                <input type="number" name="negotiated_price" value="{{ old('negotiated_price', $appointment->negotiated_price ?? $appointment->car->price ?? 0) }}" step="0.01" min="0" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl pl-8 pr-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                            </div>
                            <p class="text-[10px] text-[#555] mt-1">Leave empty or default if no discount was applied.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Internal Admin Remarks</label>
                            <textarea name="admin_remarks" rows="4" placeholder="Record viewing notes, customer conditions, or financing requirements..." class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">{{ old('admin_remarks', $appointment->admin_remarks) }}</textarea>
                            <p class="text-[10px] text-[#555] mt-1">This field is hidden from the customer's portal.</p>
                        </div>

                        <div class="flex items-center p-4 bg-[#1a1a1a] rounded-xl border border-[#333]">
                            <input type="checkbox" id="commitment_status" name="commitment_status" value="1" {{ old('commitment_status', $appointment->commitment_status) ? 'checked' : '' }} class="w-5 h-5 bg-[#050505] border-[#444] text-[#e52a2a] rounded focus:ring-[#e52a2a]">
                            <label for="commitment_status" class="ml-3 cursor-pointer">
                                <span class="block text-sm font-bold text-white tracking-wide">Lock Vehicle Commitment</span>
                                <span class="block text-[10px] text-[#888] mt-0.5">Checking this automatically changes the vehicle's catalog status to 'Reserved'.</span>
                            </label>
                        </div>

                        <div class="pt-6 border-t border-[#222] flex justify-end">
                            <button type="submit" class="bg-[#e52a2a] hover:bg-[#c92222] text-white text-sm font-bold uppercase tracking-widest px-10 py-4 rounded-xl shadow-[0_0_15px_rgba(229,42,42,0.3)] transition-all hover:scale-[1.02]">
                                Save Hub Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection