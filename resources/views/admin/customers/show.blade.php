@extends('layouts.admin')

@section('content')
    <!-- Ambient Background Shapes -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[10%] left-[10%] w-[500px] h-[500px] rounded-full bg-[#e52a2a]/5 blur-[150px]"></div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10 pt-4 pb-12">
        <!-- Header -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Customer</span> <span class="text-[#e52a2a]">Profile</span>
                </h2>
                <p class="text-[#666] text-xs font-mono">UUID: {{ $customer->id }}</p>
            </div>
            <a href="{{ route('admin.customers.index') }}" class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Directory
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Identity & Contact -->
            <div class="lg:col-span-1">
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6 sticky top-6">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-[#222]">
                        <div class="w-16 h-16 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-xl font-bold text-[#e52a2a]">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-white text-lg font-bold">{{ $customer->name }}</h3>
                            <span class="px-2 py-0.5 bg-[#e52a2a]/10 border border-[#e52a2a]/30 text-[#e52a2a] text-[9px] rounded uppercase font-bold tracking-wider">Registered Client</span>
                        </div>
                    </div>

                    <div class="space-y-5 text-sm">
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold tracking-widest mb-1 flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Email Address
                            </p>
                            <p class="text-white break-all">{{ $customer->email }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold tracking-widest mb-1 flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                Phone Number
                            </p>
                            <p class="text-white">{{ $customer->phone_number ?? 'Not Provided' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#666] uppercase font-bold tracking-widest mb-1 flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Account Created
                            </p>
                            <p class="text-[#a0a0a0]">{{ $customer->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: History -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Purchase History (Financial) -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6">
                    <div class="flex justify-between items-center mb-6 border-b border-[#222] pb-4">
                        <h3 class="text-[#2ecc71] text-[11px] font-bold uppercase tracking-widest">Financial Purchase History</h3>
                        <span class="text-[#2ecc71] font-bold font-['Oswald'] tracking-wider">Total Volume: ₱{{ number_format($customer->sales->sum('sale_price'), 2) }}</span>
                    </div>

                    @if($customer->sales->count() > 0)
                        <div class="space-y-4">
                            @foreach($customer->sales as $sale)
                                <div class="bg-[#050505] border border-[#222] rounded-xl p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 hover:border-[#333] transition-colors">
                                    <div>
                                        <p class="text-white font-bold">{{ $sale->car->brand->brand_name ?? '' }} {{ $sale->car->model_name ?? 'Archived Vehicle' }}</p>
                                        <p class="text-[#666] text-xs font-mono mt-1">Ref ID: {{ substr($sale->id, 0, 8) }}</p>
                                        <div class="flex items-center gap-3 mt-2">
                                            <span class="text-[#888] text-[10px] uppercase font-bold">{{ $sale->created_at->format('M d, Y') }}</span>
                                            <span class="text-[#a0a0a0] text-[10px] px-2 py-0.5 bg-[#1a1a1a] rounded uppercase font-bold tracking-wider">{{ $sale->payment_method }}</span>
                                        </div>
                                    </div>
                                    <div class="text-left sm:text-right">
                                        <p class="text-2xl text-[#2ecc71] font-bold font-['Oswald'] tracking-wide">₱{{ number_format($sale->sale_price, 2) }}</p>
                                        <a href="{{ route('admin.sales.show', $sale) }}" class="text-[10px] text-[#e52a2a] hover:text-[#ff4757] uppercase font-bold tracking-widest mt-1 inline-block transition-colors">View Receipt &rarr;</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-[#666] text-sm italic">This customer has no finalized vehicle purchases on record.</p>
                        </div>
                    @endif
                </div>

                <!-- Operational History (Appointments) -->
                <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-6">
                    <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-4">Operational History (Appointments)</h3>

                    @if($customer->appointments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left whitespace-nowrap">
                                <thead class="text-[10px] uppercase text-[#888] border-b border-[#222] tracking-widest">
                                    <tr>
                                        <th class="pb-3 font-semibold">Date</th>
                                        <th class="pb-3 font-semibold">Target Vehicle</th>
                                        <th class="pb-3 font-semibold">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#222] text-sm">
                                    @foreach($customer->appointments->sortByDesc('scheduled_at') as $appointment)
                                        <tr class="hover:bg-[#1a1a1a]/30 transition-colors">
                                            <td class="py-3 pr-4">
                                                <p class="text-[#ddd]">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y') }}</p>
                                                <p class="text-[#666] text-[10px]">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('h:i A') }}</p>
                                            </td>
                                            <td class="py-3 pr-4">
                                                <p class="text-white">{{ $appointment->car->brand->brand_name ?? '' }} {{ $appointment->car->model_name ?? 'Archived Vehicle' }}</p>
                                            </td>
                                            <td class="py-3">
                                                @if($appointment->status == 'Committed')
                                                    <span class="text-[#9b59b6] text-[10px] font-bold uppercase tracking-wider">Committed</span>
                                                @elseif($appointment->status == 'Cancelled')
                                                    <span class="text-[#e52a2a] text-[10px] font-bold uppercase tracking-wider">Cancelled</span>
                                                @elseif($appointment->status == 'Approved')
                                                    <span class="text-[#2ecc71] text-[10px] font-bold uppercase tracking-wider">Approved</span>
                                                @else
                                                    <span class="text-[#f39c12] text-[10px] font-bold uppercase tracking-wider">{{ $appointment->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-[#666] text-sm italic">This customer has not scheduled any vehicle viewings.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection