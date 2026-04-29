@extends('layouts.admin')

@section('scripts')
    {{-- Pulling in the separated JS --}}
    @vite(['resources/js/admin/customers.js'])
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="w-full">
                <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Customer</span> <span class="text-[#e52a2a]">Management</span>
                </h2>
                <p class="text-[#666666] text-xs">View and manage your registered client base.</p>
            </div>
            
            <div class="flex gap-3 w-full md:w-auto justify-end">
                {{-- Dynamic Search Form --}}
                <form action="{{ route('admin.customers.index') }}" method="GET" class="relative" id="search-form">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-[#666666]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customers..." 
                           class="bg-[#0a0a0a] border border-[#1a1a1a] text-xs text-white pl-9 pr-4 py-2 rounded-md focus:outline-none focus:border-[#e52a2a] w-64 transition-colors">
                </form>
                
                {{-- Export Button (Trigger handled in JS) --}}
                <button id="export-btn" class="bg-[#111111] border border-[#1a1a1a] text-white px-4 py-2 rounded-md text-[11px] font-bold hover:bg-[#1a1a1a] transition-colors uppercase tracking-wider">
                    Export List
                </button>
            </div>
        </div>

        <div class="bg-[#111111] rounded-xl border border-[#1a1a1a] overflow-hidden p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="text-[10px] uppercase text-[#666666] border-b border-[#1a1a1a] tracking-widest">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-center w-24">ID</th>
                            <th class="px-6 py-4 font-semibold">Customer Name</th>
                            <th class="px-6 py-4 font-semibold">Email Address</th>
                            <th class="px-6 py-4 font-semibold">Joined Date</th>
                            <th class="px-6 py-4 font-semibold text-center">Total Purchases</th>
                            <th class="px-6 py-4 font-semibold">Account Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1a1a1a] text-xs">
                        
                        @forelse($customers as $customer)
                            <tr class="hover:bg-[#151515] transition-colors group">
                                {{-- Extract first 8 chars of UUID to simulate 'U-0842' look --}}
                                <td class="px-6 py-4 text-[#e52a2a] font-bold text-center uppercase">
                                    {{ substr($customer->id, 0, 8) }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        {{-- Dynamic Initials using Laravel String Helper --}}
                                        <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">
                                            {{ collect(explode(' ', $customer->name))->map(fn($n) => substr($n, 0, 1))->take(2)->join('') }}
                                        </div>
                                        <span class="text-white font-medium">{{ $customer->name }}</span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 text-[#888]">{{ $customer->email }}</td>
                                
                                <td class="px-6 py-4 text-[#888]">{{ $customer->created_at->format('M d, Y') }}</td>
                                
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 {{ $customer->sales_count > 0 ? 'bg-[#1a1a1a] text-white' : 'bg-transparent text-[#666]' }} rounded-full border border-[#333] text-[11px]">
                                        {{ $customer->sales_count }} {{ Str::plural('Car', $customer->sales_count) }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4">
                                    @if($customer->email_verified_at)
                                        <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded border border-yellow-500/20 text-[9px] font-bold uppercase tracking-wider">Pending</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 flex justify-end gap-2">
                                    <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-[#666]">
                                    No customers found matching your criteria.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Laravel Pagination UI Integration --}}
            <div class="mt-6 pt-6 border-t border-[#1a1a1a]">
                {{ $customers->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection