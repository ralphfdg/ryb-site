@extends('layouts.admin')

@section('content')
    <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-10 gap-6 md:gap-0">
        <div>
            <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Customer</span> <span class="text-[#e52a2a]">Directory</span>
            </h2>
            <p class="text-[#666] text-sm">View registered users and their transaction history.</p>
        </div>
        
        <!-- Search Bar -->
        <form action="{{ route('admin.customers.index') }}" method="GET" class="relative w-full md:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, or phone..." 
                   class="w-full bg-[#111111]/70 backdrop-blur-xl border border-[#222] text-white text-sm rounded-xl pl-10 pr-4 py-2.5 focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] placeholder-[#555] shadow-lg">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-[#888]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            @if(request('search'))
                <a href="{{ route('admin.customers.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#e52a2a] hover:text-[#ff4757]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            @endif
        </form>
    </div>

    <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] overflow-hidden shadow-2xl p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="text-[10px] uppercase text-[#888] border-b border-[#222] tracking-widest bg-[#0a0a0a]/50">
                    <tr>
                        <th class="px-4 py-4 font-semibold rounded-tl-lg">Account Details</th>
                        <th class="px-4 py-4 font-semibold">Contact Info</th>
                        <th class="px-4 py-4 font-semibold text-center">Completed Purchases</th>
                        <th class="px-4 py-4 font-semibold">Registered On</th>
                        <th class="px-4 py-4 font-semibold text-right rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222] text-[12px]">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-[#1a1a1a]/50 transition-colors group">
                        <td class="px-4 py-4">
                            <p class="text-white font-bold text-sm">{{ $customer->name }}</p>
                            <p class="text-[#555] font-mono text-[9px] mt-1 hidden md:block">ID: {{ substr($customer->id, 0, 8) }}...</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-[#a0a0a0]">{{ $customer->email }}</p>
                            <p class="text-[#888] text-[11px] mt-0.5">{{ $customer->phone_number ?? 'No Phone Provided' }}</p>
                        </td>
                        <td class="px-4 py-4 text-center">
                            @if($customer->sales_count > 0)
                                <span class="px-3 py-1 bg-[#051c0d] text-[#2ecc71] rounded-full border border-[#0a381a] text-[10px] font-bold">{{ $customer->sales_count }} Vehicle(s)</span>
                            @else
                                <span class="text-[#555] italic text-[10px]">No Purchases</span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-[#ddd] font-medium">{{ $customer->created_at->format('M d, Y') }}</p>
                            <p class="text-[#888] text-[10px] mt-0.5">{{ $customer->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <a href="{{ route('admin.customers.show', $customer) }}" class="inline-block bg-[#1a1a1a] hover:bg-[#222] border border-[#333] text-white text-[10px] font-bold uppercase tracking-wider px-4 py-2 rounded transition-colors shadow-sm">
                                View Profile
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-[#666]">
                            @if(request('search'))
                                No customers found matching "{{ request('search') }}".
                            @else
                                No registered customers found in the system.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 border-t border-[#222] pt-4">
            {{ $customers->appends(request()->query())->links() }}
        </div>
    </div>
@endsection