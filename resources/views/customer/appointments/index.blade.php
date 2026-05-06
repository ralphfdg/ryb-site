@extends('layouts.app')

@section('content')
<div class="bg-ryb-darker min-h-screen pt-24 pb-20 text-ryb-light" x-data="{ activeTab: '{{ request('activeTab', 'appointments') }}' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex justify-between items-end border-b border-ryb-muted pb-4">
            <div>
                <h1 class="text-3xl font-bold text-white">My Dashboard</h1>
                <p class="text-zinc-500 mt-1">Manage your viewings and inquiries.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl font-medium shadow-lg shadow-green-500/5">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabs & Filters Row --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            
            {{-- Tab Navigation --}}
            <div class="flex space-x-4 bg-ryb-dark p-1 rounded-xl border border-ryb-muted">
                <button @click="activeTab = 'appointments'" 
                        :class="activeTab === 'appointments' ? 'bg-ryb-red text-white shadow-md' : 'text-zinc-500 hover:text-white'"
                        class="px-6 py-2 rounded-lg font-bold transition">
                    Appointments
                </button>
                <button @click="activeTab = 'inquiries'" 
                        :class="activeTab === 'inquiries' ? 'bg-ryb-red text-white shadow-md' : 'text-zinc-500 hover:text-white'"
                        class="px-6 py-2 rounded-lg font-bold transition">
                    Inquiries
                </button>
            </div>

            {{-- Appointments Filter (Only visible when Appointments tab is active) --}}
            <form x-show="activeTab === 'appointments'" method="GET" action="{{ route('dashboard.appointments.index') }}" class="flex items-center gap-3">
                <input type="hidden" name="activeTab" value="appointments">
                <div class="flex items-center gap-2 bg-ryb-dark border border-ryb-muted rounded-lg pl-3 pr-1 py-1 focus-within:border-ryb-red transition shadow-lg">
                    <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    <select name="filter[status]" onchange="this.form.submit()" class="bg-transparent text-sm text-ryb-light outline-none cursor-pointer py-1 pr-4">
                        <option value="">All Statuses</option>
                        <option value="Pending" {{ request('filter.status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ request('filter.status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Committed" {{ request('filter.status') === 'Committed' ? 'selected' : '' }}>Committed</option>
                        <option value="Cancelled" {{ request('filter.status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                @if(request()->has('filter.status'))
                    <a href="{{ route('dashboard.appointments.index') }}" class="text-xs text-zinc-500 hover:text-ryb-red transition underline underline-offset-2">Clear</a>
                @endif
            </form>
        </div>

        {{-- Appointments Tab Content --}}
        <div x-show="activeTab === 'appointments'" x-transition>
            <div class="bg-ryb-dark border border-ryb-muted rounded-2xl overflow-hidden shadow-lg">
                @forelse($appointments as $appt)
                    <div class="p-6 border-b border-ryb-muted last:border-0 flex flex-col md:flex-row justify-between items-center gap-4 hover:bg-ryb-muted/20 transition">
                        <div>
                            <p class="text-sm text-zinc-500 font-mono mb-1">{{ \Carbon\Carbon::parse($appt->scheduled_at)->format('F j, Y - g:i A') }}</p>
                            <h3 class="text-xl font-bold text-white">{{ $appt->car->brand->brand_name }} {{ $appt->car->model_name }}</h3>
                            <div class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border
                                {{ $appt->status === 'Pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : '' }}
                                {{ $appt->status === 'Approved' ? 'bg-blue-500/10 text-blue-500 border-blue-500/20' : '' }}
                                {{ $appt->status === 'Committed' ? 'bg-green-500/10 text-green-500 border-green-500/20' : '' }}
                                {{ $appt->status === 'Cancelled' ? 'bg-ryb-red/10 text-ryb-red border-ryb-red/20' : '' }}">
                                {{ $appt->status }}
                            </div>
                        </div>
                        <a href="{{ route('dashboard.appointments.show', $appt->id) }}" class="px-5 py-2 border border-ryb-red text-ryb-red hover:bg-ryb-red hover:text-white font-bold rounded-lg transition whitespace-nowrap">
                            View Details
                        </a>
                    </div>
                @empty
                    <div class="p-12 flex flex-col items-center justify-center text-center">
                        <svg class="w-16 h-16 text-zinc-600 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <h3 class="text-lg font-bold text-white mb-1">No Appointments Found</h3>
                        <p class="text-zinc-500 text-sm">You haven't booked any viewings yet, or none match your current filter.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-6">{{ $appointments->links() }}</div>
        </div>

        {{-- Inquiries Tab Content --}}
        <div x-show="activeTab === 'inquiries'" x-transition style="display: none;">
            {{-- Search Filter for Inquiries --}}
            <form method="GET" action="{{ route('dashboard.appointments.index') }}" class="mb-6 flex gap-4">
                <input type="hidden" name="activeTab" value="inquiries">
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="filter[subject]" value="{{ request('filter.subject') }}" placeholder="Search inquiry subjects..." class="w-full bg-ryb-dark border border-ryb-muted text-ryb-light rounded-lg pl-10 pr-4 py-2 outline-none focus:border-ryb-red transition text-sm shadow-lg">
                </div>
                 @if(request()->has('filter.subject'))
                    <a href="{{ route('dashboard.appointments.index', ['activeTab' => 'inquiries']) }}" class="px-4 py-2 text-zinc-400 hover:text-white transition flex items-center text-sm">Clear</a>
                @endif
            </form>

            <div class="bg-ryb-dark border border-ryb-muted rounded-2xl overflow-hidden shadow-lg">
                @forelse($inquiries as $inquiry)
                    <div class="p-6 border-b border-ryb-muted last:border-0 flex flex-col md:flex-row justify-between items-start gap-4 hover:bg-ryb-muted/20 transition">
                        <div class="w-full">
                            <div class="flex justify-between items-start w-full mb-2">
                                <h3 class="text-lg font-bold text-white">{{ $inquiry->subject }}</h3>
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider {{ $inquiry->status === 'Resolved' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }} border border-ryb-muted">
                                    {{ $inquiry->status }}
                                </span>
                            </div>
                            <span class="text-xs text-zinc-500 block mb-3 font-mono">{{ $inquiry->created_at->diffForHumans() }}</span>
                            <p class="text-zinc-400 text-sm italic border-l-2 border-ryb-muted pl-3 leading-relaxed">"{{ Str::limit($inquiry->message, 120) }}"</p>
                        </div>
                        <a href="{{ route('dashboard.inquiries.show', $inquiry->id) }}" class="mt-4 md:mt-0 px-5 py-2 border border-ryb-muted text-zinc-300 hover:border-ryb-red hover:text-ryb-red font-bold rounded-lg transition whitespace-nowrap text-sm">
                            View Thread
                        </a>
                    </div>
                @empty
                    <div class="p-12 flex flex-col items-center justify-center text-center">
                        <svg class="w-16 h-16 text-zinc-600 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        <h3 class="text-lg font-bold text-white mb-1">No Inquiries Found</h3>
                        <p class="text-zinc-500 text-sm">You haven't sent any messages to the dealership yet.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-6">{{ $inquiries->links() }}</div>
        </div>

    </div>
</div>
@endsection