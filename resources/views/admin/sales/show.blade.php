@extends('layouts.admin')

@section('content')
    <!-- Ambient Background Shapes -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[10%] right-[10%] w-[600px] h-[600px] rounded-full bg-[#2ecc71]/5 blur-[150px]"></div>
    </div>

    <div class="max-w-5xl mx-auto relative z-10 pt-4 pb-12">
        <!-- Header -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Transaction</span> <span class="text-[#2ecc71]">Receipt</span>
                </h2>
                <p class="text-[#666] text-xs font-mono">UUID: {{ $sale->id }}</p>
            </div>
            <a href="{{ route('admin.sales.index') }}" class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Return to Ledger
            </a>
        </div>

        <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl overflow-hidden relative">
            <!-- Receipt Branding -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#e52a2a] via-[#c92222] to-[#2ecc71]"></div>
            
            <div class="p-8">
                <!-- Top Section: Dates & Methods -->
                <div class="flex justify-between items-start border-b border-[#222] pb-8 mb-8">
                    <div>
                        <img src="{{ asset('images/logo.png') }}" alt="RYB Logo" class="h-10 mb-4 opacity-80 grayscale">
                        <p class="text-[#888] text-[10px] uppercase font-bold tracking-widest">RYB Vehicle Trading</p>
                        <p class="text-white text-sm">Official Financial Record</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-[#666] uppercase font-bold tracking-widest mb-1">Date of Sale</p>
                        <p class="text-white font-medium">{{ $sale->created_at->format('F d, Y \a\t h:i A') }}</p>
                        
                        <p class="text-[10px] text-[#666] uppercase font-bold tracking-widest mt-4 mb-1">Payment Method</p>
                        <p class="text-[#2ecc71] font-bold uppercase">{{ $sale->payment_method }}</p>
                    </div>
                </div>

                <!-- Middle Section: Customer & Origin -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Purchaser Information</h3>
                        <p class="text-white font-bold text-lg">{{ $sale->customer->name ?? 'Deleted Customer' }}</p>
                        <p class="text-[#a0a0a0] text-sm">{{ $sale->customer->email ?? 'N/A' }}</p>
                        <p class="text-[#a0a0a0] text-sm">{{ $sale->customer->phone_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Originating Appointment</h3>
                        <p class="text-white text-sm">Ref #{{ str_pad($sale->appointment_id, 5, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-[#a0a0a0] text-sm mt-1">Viewing Date: {{ \Carbon\Carbon::parse($sale->appointment->scheduled_at)->format('M d, Y') }}</p>
                        @if($sale->appointment->admin_remarks)
                            <div class="mt-3 bg-[#050505] border border-[#222] p-3 rounded text-xs text-[#888] italic">
                                " {{ $sale->appointment->admin_remarks }} "
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Bottom Section: Vehicle & Pricing -->
                <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-4 border-b border-[#222] pb-2">Vehicle & Financial Breakdown</h3>
                <div class="bg-[#050505] border border-[#222] rounded-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-white font-bold text-lg">{{ $sale->car->brand->brand_name ?? '' }} {{ $sale->car->model_name ?? 'Archived Vehicle' }}</p>
                            <p class="text-[#666] text-xs font-mono mt-1">VIN: {{ $sale->car->specification->vin_number ?? 'N/A' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-[#666] uppercase font-bold tracking-widest mb-1">Base Listing Price</p>
                            <p class="text-[#888] line-through font-['Oswald'] tracking-wide">₱{{ number_format($sale->car->price ?? 0, 2) }}</p>
                        </div>
                    </div>

                    <div class="border-t border-[#222] pt-4 mt-4 flex justify-between items-end">
                        <div>
                            <span class="inline-block px-3 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[10px] font-bold uppercase tracking-widest">
                                Transaction Closed
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-[11px] text-[#e52a2a] uppercase font-bold tracking-widest mb-1">Final Negotiated Sale Price</p>
                            <p class="text-3xl text-[#2ecc71] font-bold font-['Oswald'] tracking-wider">₱{{ number_format($sale->sale_price, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection