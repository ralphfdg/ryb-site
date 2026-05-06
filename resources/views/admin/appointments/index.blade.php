@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Operations</span> <span class="text-[#e52a2a]">Hub</span>
            </h2>
            <p class="text-[#666] text-sm">Manage vehicle viewing schedules, negotiations, and commitments.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222] text-[#888] text-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-[#e52a2a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Pending Approvals: <span class="text-white font-bold">{{ $appointments->where('status', 'Pending')->count() }}</span>
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
                        <th class="px-4 py-4 font-semibold rounded-tl-lg">ID</th>
                        <th class="px-4 py-4 font-semibold">Customer Details</th>
                        <th class="px-4 py-4 font-semibold">Vehicle Requested</th>
                        <th class="px-4 py-4 font-semibold">Scheduled Date</th>
                        <th class="px-4 py-4 font-semibold">Status</th>
                        <th class="px-4 py-4 font-semibold text-right rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222] text-[12px]">
                    @forelse($appointments as $appointment)
                    <tr class="hover:bg-[#1a1a1a]/50 transition-colors group">
                        <td class="px-4 py-4 text-[#555] font-mono">#{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-4 py-4">
                            <p class="text-white font-bold text-sm">{{ $appointment->user->name ?? 'Guest/Deleted' }}</p>
                            <p class="text-[#a0a0a0]">{{ $appointment->user->phone_number ?? 'N/A' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-white font-medium">{{ $appointment->car->brand->brand_name ?? 'Unknown' }} {{ $appointment->car->model_name ?? '' }}</p>
                            <p class="text-[#888] text-[10px]">VIN: <span class="font-mono">{{ $appointment->car->specification->vin_number ?? 'N/A' }}</span></p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-[#ddd] font-medium">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y') }}</p>
                            <p class="text-[#888] text-[10px]">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('h:i A') }}</p>
                        </td>
                        <td class="px-4 py-4">
                            @if($appointment->status == 'Pending')
                                <span class="px-3 py-1 bg-[#2a1a08] text-[#f39c12] rounded-full border border-[#3a2a0a] text-[9px] font-bold uppercase tracking-wider">Pending</span>
                            @elseif($appointment->status == 'Approved')
                                <span class="px-3 py-1 bg-[#051c0d] text-[#2ecc71] rounded-full border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Approved</span>
                            @elseif($appointment->status == 'Committed')
                                <span class="px-3 py-1 bg-[#1a0a2a] text-[#9b59b6] rounded-full border border-[#2a0a3a] text-[9px] font-bold uppercase tracking-wider">Committed</span>
                            @else
                                <span class="px-3 py-1 bg-[#2a0808] text-[#e52a2a] rounded-full border border-[#3a0a0a] text-[9px] font-bold uppercase tracking-wider">{{ $appointment->status }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right">
                            <a href="{{ route('admin.appointments.show', $appointment) }}" class="inline-block bg-[#e52a2a] hover:bg-[#c92222] text-white text-[10px] font-bold uppercase tracking-wider px-4 py-2 rounded transition-colors shadow-sm">
                                Process
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-[#666]">No appointments in the operational queue.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 border-t border-[#222] pt-4">
            {{ $appointments->links() }}
        </div>
    </div>
@endsection