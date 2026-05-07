@extends('layouts.admin')

@section('content')
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[10%] right-[10%] w-[600px] h-[600px] rounded-full bg-[#e52a2a]/5 blur-[150px]"></div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10 pt-4 pb-12" x-data="appointmentScheduler(@json($bookedSlots ?? []))">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Process</span> <span class="text-[#e52a2a]">Appointment</span>
                </h2>
                <p class="text-[#666] text-sm italic">Ref #{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }} — Current Status: <span class="text-white font-bold uppercase tracking-widest text-xs ml-1">{{ $appointment->status }}</span></p>
            </div>
            <a href="{{ route('admin.appointments.index') }}" class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Queue
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-[#051c0d]/80 backdrop-blur border border-[#0a381a] text-[#2ecc71] px-4 py-3 rounded-lg text-sm shadow-lg border-l-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-8">
                
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6">
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Customer Profile</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Full Name</p>
                            <p class="text-white text-sm font-medium">{{ $appointment->user->name ?? 'Guest User' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold">Phone Number</p>
                            <p class="text-[#a0a0a0] text-sm">{{ $appointment->user->phone_number ?? 'N/A' }}</p>
                        </div>
                        <div class="pt-4 border-t border-[#222]">
                            <p class="text-[10px] text-[#666] uppercase font-bold mb-1 text-ryb-red">Requested Schedule</p>
                            <p class="text-white font-bold text-lg">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y') }}</p>
                            <p class="text-[#e52a2a] font-medium font-mono uppercase text-xs">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6">
                    <div class="flex justify-between items-center mb-4 border-b border-[#222] pb-2">
                        <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest">Target Vehicle</h3>
                        <a href="{{ route('catalog.show', $appointment->car->id) }}" target="_blank" class="text-zinc-600 hover:text-ryb-red transition" title="View Listing">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                    
                    @if($appointment->car)
                        <div class="space-y-3">
                            <div>
                                <p class="text-white font-bold text-lg">{{ $appointment->car->brand->brand_name }} {{ $appointment->car->model_name }}</p>
                                <p class="text-[#888] text-xs font-mono">VIN: {{ $appointment->car->specification->vin_number ?? 'N/A' }}</p>
                            </div>
                            <div class="flex justify-between items-center py-2 border-y border-[#222]">
                                <span class="text-[10px] text-[#666] uppercase font-bold">List Price</span>
                                <span class="text-[#2ecc71] font-bold tracking-wide">₱{{ number_format($appointment->car->price, 2) }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-[#666] uppercase font-bold block mb-1">Inventory Status</span>
                                <span class="px-2 py-0.5 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">{{ $appointment->car->status }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                
                {{-- OPTIONAL SCHEDULER: Available for Pending & Approved --}}
                @if(in_array($appointment->status, ['Pending', 'Approved']))
                    <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] p-8 shadow-xl">
                        <div class="flex justify-between items-center mb-6 border-b border-[#222] pb-2">
                            <h3 class="text-white text-[11px] font-bold uppercase tracking-widest flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#e52a2a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Propose New Schedule
                            </h3>
                            <button type="button" @click="selectedDate = ''; selectedTime = ''" x-show="selectedDate || selectedTime" class="text-[9px] text-[#e52a2a] underline font-bold uppercase tracking-tighter transition hover:text-white">Reset Selection</button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] text-[#666] uppercase font-bold mb-3">Available Dates</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <template x-for="date in availableDates" :key="date.value">
                                        <button @click="selectedDate = date.value" type="button"
                                            :class="selectedDate === date.value ? 'bg-[#e52a2a] border-[#e52a2a] text-white shadow-lg' : 'bg-[#0a0a0a] border-[#222] text-[#888]'"
                                            class="border rounded-lg p-2 text-center transition hover:border-[#e52a2a]">
                                            <p class="text-[8px] font-bold" x-text="date.dayName"></p>
                                            <p class="text-xs font-bold" x-text="date.display"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] text-[#666] uppercase font-bold mb-3">Time Slots</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <template x-for="time in processedTimeSlots" :key="time.value">
                                        <button type="button" @click="if(!time.isBooked) selectedTime = time.value"
                                            :disabled="time.isBooked"
                                            :class="{
                                                'bg-[#e52a2a] border-[#e52a2a] text-white shadow-lg': selectedTime === time.value,
                                                'bg-[#0a0a0a] border-[#222] text-[#888]': selectedTime !== time.value && !time.isBooked,
                                                'bg-[#1a0505] border-[#3a0a0a] text-[#e52a2a]/20 cursor-not-allowed': time.isBooked
                                            }"
                                            class="border rounded-lg p-2 text-xs font-bold transition relative group overflow-hidden">
                                            <span x-text="time.display"></span>
                                            <template x-if="time.isBooked">
                                                <span class="absolute inset-0 flex items-center justify-center bg-black/40 text-[8px] text-[#e52a2a] font-black uppercase tracking-tighter">Taken</span>
                                            </template>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- APPROVAL STEP --}}
                @if($appointment->status === 'Pending')
                    <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#e52a2a]/30 p-8 shadow-xl">
                        <h3 class="text-white text-lg font-bold uppercase tracking-wide mb-2">Process Approval</h3>
                        <p class="text-[#888] text-sm mb-6 leading-relaxed">Approve the requested time or suggest a new slot from the scheduler above before proceeding.</p>
                        
                        <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST" @submit="validateForm($event, true)">
                            @csrf
                            @method('PATCH')
                            {{-- Carrying Alpine selection into approval --}}
                            <input type="hidden" name="scheduled_at" :value="formattedDateTime ? formattedDateTime : '{{ $appointment->scheduled_at }}'">
                            
                            <button type="submit" class="bg-[#2ecc71] hover:bg-[#27ae60] text-[#050505] text-xs font-bold uppercase tracking-widest px-8 py-4 rounded-xl transition-all shadow-lg shadow-green-500/10">
                                <span x-text="(selectedDate && selectedTime) ? 'Approve with Reschedule' : 'Confirm & Approve Schedule'"></span>
                            </button>
                        </form>
                    </div>
                @endif

                {{-- NEGOTIATION FORM --}}
                <div class="relative">
                    {{-- OVERLAYS --}}
                    @if($appointment->status === 'Pending')
                        <div class="absolute inset-0 z-30 flex items-center justify-center bg-black/40 backdrop-blur-[2px] rounded-2xl border border-[#222]">
                            <div class="bg-black/80 px-6 py-3 rounded-xl border border-[#333] shadow-2xl">
                                <p class="text-white font-bold tracking-widest uppercase text-xs">Approve Schedule First</p>
                            </div>
                        </div>
                    @elseif($appointment->status === 'Cancelled')
                        <div class="absolute inset-0 z-30 flex items-center justify-center bg-black/60 backdrop-blur-md rounded-2xl border border-[#e52a2a]/20">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-[#e52a2a] mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-white font-bold tracking-widest uppercase text-xl">Voided Record</p>
                                <p class="text-[#666] text-sm mt-1">This appointment is locked.</p>
                            </div>
                        </div>
                    @endif

                    <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8 {{ $appointment->status === 'Pending' ? 'opacity-30' : '' }} {{ $appointment->status === 'Cancelled' ? 'opacity-20' : '' }}">
                        <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">Negotiation & Operational Details</h3>
                        
                        <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" @submit="validateForm($event, true)">
                            @csrf
                            @method('PUT')
                            {{-- Syncs scheduler with update form --}}
                            <input type="hidden" name="scheduled_at" :value="formattedDateTime ? formattedDateTime : '{{ $appointment->scheduled_at }}'">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Update Operational Status</label>
                                    <select name="status" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a] transition-all">
                                        <option value="Approved" {{ $appointment->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Viewed" {{ $appointment->status == 'Viewed' ? 'selected' : '' }}>Viewed</option>
                                        <option value="Committed" {{ $appointment->status == 'Committed' ? 'selected' : '' }}>Committed</option>
                                        <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Negotiated Price (PHP)</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#2ecc71] font-bold">₱</span>
                                        <input type="number" name="negotiated_price" value="{{ old('negotiated_price', $appointment->negotiated_price ?? $appointment->car->price) }}" step="0.01" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl pl-8 pr-4 py-3 focus:ring-1 focus:ring-[#e52a2a] transition-all">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Internal Admin Remarks</label>
                                <textarea name="admin_remarks" rows="3" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a] transition-all" placeholder="Enter viewing notes here...">{{ $appointment->admin_remarks }}</textarea>
                            </div>

                            {{-- INVENTORY COMMITMENT --}}
                            <div class="mb-8 flex items-center p-4 bg-[#1a1a1a] rounded-xl border border-[#333] group transition-all hover:border-[#e52a2a]/30">
                                <input type="checkbox" id="commit" name="commitment_status" value="1" {{ $appointment->car->status === 'Reserved' ? 'checked' : '' }} class="w-5 h-5 bg-black border-[#444] text-[#e52a2a] rounded focus:ring-0 transition-all cursor-pointer">
                                <label for="commit" class="ml-3 cursor-pointer">
                                    <span class="block text-sm font-bold text-white uppercase tracking-wider">Inventory Commitment Lock</span>
                                    <span class="block text-[10px] text-[#666] mt-0.5 tracking-tight">Checking this marks the vehicle as 'Reserved' in the public catalog.</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-[#e52a2a] hover:bg-[#c92222] text-white text-xs font-bold uppercase tracking-widest py-4 rounded-xl shadow-lg transition-all active:scale-95">
                                Save Hub Data
                            </button>
                        </form>

                        {{-- SALES LEDGER BRIDGE --}}
                        @if($appointment->status === 'Committed')
                            <div class="mt-8 pt-8 border-t border-[#333] animate-in fade-in slide-in-from-bottom-4 duration-500">
                                <div class="bg-[#051c0d]/40 border border-[#0a381a] p-5 rounded-xl flex flex-col md:flex-row items-center justify-between gap-4">
                                    <div>
                                        <h4 class="text-[#2ecc71] font-bold text-sm">Finalize Sales Ledger</h4>
                                        <p class="text-[#2ecc71]/60 text-[10px]">Create financial receipt and mark vehicle as SOLD.</p>
                                    </div>
                                    <form action="{{ route('admin.sales.store') }}" method="POST" class="flex gap-2 w-full md:w-auto">
                                        @csrf
                                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                        <select name="payment_method" class="bg-black border border-[#0a381a] text-white text-xs rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#2ecc71]">
                                            <option value="Cash">Cash</option>
                                            <option value="Financing">Financing</option>
                                        </select>
                                        <button type="submit" class="bg-[#2ecc71] hover:bg-[#27ae60] text-[#050505] font-bold text-[10px] px-6 py-2.5 rounded-lg uppercase transition-all shadow-lg shadow-green-500/10">Close Sale</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection