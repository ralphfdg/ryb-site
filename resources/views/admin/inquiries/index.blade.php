@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Customer</span> <span class="text-[#e52a2a]">Inquiries</span>
            </h2>
            <p class="text-[#666] text-sm">Manage communications from authenticated platform users.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-[#051c0d]/80 backdrop-blur border border-[#0a381a] text-[#2ecc71] px-4 py-3 rounded-lg text-sm shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Alpine.js Client-Side Filtering -->
    <div x-data="{ currentTab: 'All' }" class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] overflow-hidden shadow-2xl">
        
        <!-- Filter Tabs -->
        <div class="flex border-b border-[#222] bg-[#0a0a0a]/50 px-4 pt-4 gap-2">
            <button @click="currentTab = 'All'" :class="currentTab === 'All' ? 'border-[#e52a2a] text-[#e52a2a]' : 'border-transparent text-[#888] hover:text-white'" class="px-4 py-2 border-b-2 font-bold uppercase tracking-wider text-[10px] transition-colors">All Tickets</button>
            <button @click="currentTab = 'New'" :class="currentTab === 'New' ? 'border-[#e52a2a] text-[#e52a2a]' : 'border-transparent text-[#888] hover:text-white'" class="px-4 py-2 border-b-2 font-bold uppercase tracking-wider text-[10px] transition-colors">New</button>
            <button @click="currentTab = 'Pending'" :class="currentTab === 'Pending' ? 'border-[#e52a2a] text-[#e52a2a]' : 'border-transparent text-[#888] hover:text-white'" class="px-4 py-2 border-b-2 font-bold uppercase tracking-wider text-[10px] transition-colors">In Review</button>
            <button @click="currentTab = 'Resolved'" :class="currentTab === 'Resolved' ? 'border-[#e52a2a] text-[#e52a2a]' : 'border-transparent text-[#888] hover:text-white'" class="px-4 py-2 border-b-2 font-bold uppercase tracking-wider text-[10px] transition-colors">Resolved</button>
        </div>

        <div class="p-6 overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="text-[10px] uppercase text-[#888] border-b border-[#222] tracking-widest">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Customer</th>
                        <th class="px-4 py-3 font-semibold">Subject / Target</th>
                        <th class="px-4 py-3 font-semibold">Received</th>
                        <th class="px-4 py-3 font-semibold">Status</th>
                        <th class="px-4 py-3 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222] text-[12px]">
                    @forelse($inquiries as $inquiry)
                    <tr x-show="currentTab === 'All' || currentTab === '{{ $inquiry->status }}'" class="hover:bg-[#1a1a1a]/50 transition-colors group">
                        <td class="px-4 py-4">
                            <p class="text-white font-bold text-sm">{{ $inquiry->user->name }}</p>
                            <p class="text-[#a0a0a0]">{{ $inquiry->user->email }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-white font-medium max-w-[250px] truncate">{{ $inquiry->subject }}</p>
                            @if($inquiry->car)
                                <p class="text-[#e52a2a] text-[10px] uppercase tracking-wider font-bold mt-1 border border-[#e52a2a]/30 inline-block px-2 py-0.5 rounded bg-[#e52a2a]/10">
                                    {{ $inquiry->car->brand->brand_name ?? '' }} {{ $inquiry->car->model_name }}
                                </p>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-[#ddd] font-medium">{{ $inquiry->created_at->format('M d, Y') }}</p>
                            <p class="text-[#888] text-[10px]">{{ $inquiry->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-4 py-4">
                            @if($inquiry->status == 'New')
                                <span class="px-3 py-1 bg-[#2a0808] text-[#e52a2a] rounded-full border border-[#3a0a0a] text-[9px] font-bold uppercase tracking-wider">New</span>
                            @elseif($inquiry->status == 'Pending')
                                <span class="px-3 py-1 bg-[#2a1a08] text-[#f39c12] rounded-full border border-[#3a2a0a] text-[9px] font-bold uppercase tracking-wider">In Review</span>
                            @else
                                <span class="px-3 py-1 bg-[#051c0d] text-[#2ecc71] rounded-full border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Resolved</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="inline-block bg-[#1a1a1a] hover:bg-[#222] border border-[#333] text-white text-[10px] font-bold uppercase tracking-wider px-4 py-2 rounded transition-colors shadow-sm">
                                Open Ticket
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-[#666]">No customer inquiries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 pb-6 pt-2">
            {{ $inquiries->links() }}
        </div>
    </div>
@endsection