@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Sales</span> <span class="text-[#e52a2a]">Ledger</span>
            </h2>
            <p class="text-[#666] text-sm">View-only financial records and completed transactions.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222] text-[#2ecc71] font-bold text-xs font-['Oswald'] tracking-wider">
                TOTAL VOLUME: ₱{{ number_format($sales->sum('sale_price'), 2) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-[#051c0d]/80 backdrop-blur border border-[#0a381a] text-[#2ecc71] px-4 py-3 rounded-lg text-sm shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] overflow-hidden shadow-2xl p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="text-[10px] uppercase text-[#888] border-b border-[#222] tracking-widest bg-[#0a0a0a]/50">
                    <tr>
                        <th class="px-4 py-4 font-semibold rounded-tl-lg">Transaction ID (UUID)</th>
                        <th class="px-4 py-4 font-semibold">Customer</th>
                        <th class="px-4 py-4 font-semibold">Vehicle</th>
                        <th class="px-4 py-4 font-semibold">Final Price</th>
                        <th class="px-4 py-4 font-semibold">Method</th>
                        <th class="px-4 py-4 font-semibold text-right rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222] text-[12px]">
                    @forelse($sales as $sale)
                    <tr class="hover:bg-[#1a1a1a]/50 transition-colors group">
                        <td class="px-4 py-4 text-[#555] font-mono text-[10px]">{{ substr($sale->id, 0, 13) }}...</td>
                        <td class="px-4 py-4">
                            <p class="text-white font-bold text-sm">{{ $sale->customer->name ?? 'Deleted Customer' }}</p>
                            <p class="text-[#a0a0a0]">{{ $sale->customer->email ?? 'N/A' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-white font-medium">{{ $sale->car->brand->brand_name ?? 'Unknown' }} {{ $sale->car->model_name ?? 'Archived Vehicle' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <span class="text-[#2ecc71] font-bold tracking-wider font-['Oswald']">₱{{ number_format($sale->sale_price, 2) }}</span>
                        </td>
                        <td class="px-4 py-4">
                            @if($sale->payment_method === 'Cash')
                                <span class="px-3 py-1 bg-[#051c0d] text-[#2ecc71] rounded-full border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Cash</span>
                            @else
                                <span class="px-3 py-1 bg-[#1a0a2a] text-[#9b59b6] rounded-full border border-[#2a0a3a] text-[9px] font-bold uppercase tracking-wider">Financing</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right">
                            <a href="{{ route('admin.sales.show', $sale) }}" class="inline-block bg-[#1a1a1a] hover:bg-[#222] border border-[#333] text-white text-[10px] font-bold uppercase tracking-wider px-4 py-2 rounded transition-colors shadow-sm">
                                View Receipt
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-[#666]">No completed sales recorded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 border-t border-[#222] pt-4">
            {{ $sales->links() }}
        </div>
    </div>
@endsection