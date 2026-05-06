@extends('layouts.app')

@section('content')
<div class="bg-ryb-darker min-h-screen pt-24 pb-20 text-ryb-light" x-data="{ activeTab: 'appointments' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex justify-between items-end border-b border-ryb-muted pb-4">
            <div>
                <h1 class="text-3xl font-bold text-white">My Dashboard</h1>
                <p class="text-zinc-500 mt-1">Manage your viewings and inquiries.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tab Navigation --}}
        <div class="flex space-x-4 mb-8">
            <button @click="activeTab = 'appointments'" 
                    :class="activeTab === 'appointments' ? 'bg-ryb-red text-white' : 'bg-ryb-dark text-zinc-400 hover:text-white border border-ryb-muted'"
                    class="px-6 py-2 rounded-lg font-bold transition">
                Appointments
            </button>
            <button @click="activeTab = 'inquiries'" 
                    :class="activeTab === 'inquiries' ? 'bg-ryb-red text-white' : 'bg-ryb-dark text-zinc-400 hover:text-white border border-ryb-muted'"
                    class="px-6 py-2 rounded-lg font-bold transition">
                Inquiries
            </button>
        </div>

        {{-- Appointments Tab --}}
        <div x-show="activeTab === 'appointments'" x-transition>
            <div class="bg-ryb-dark border border-ryb-muted rounded-2xl overflow-hidden shadow-lg">
                @forelse($appointments as $appt)
                    <div class="p-6 border-b border-ryb-muted last:border-0 flex flex-col md:flex-row justify-between items-center gap-4 hover:bg-ryb-muted/20 transition">
                        <div>
                            <p class="text-sm text-zinc-500 font-mono mb-1">{{ \Carbon\Carbon::parse($appt->scheduled_at)->format('F j, Y - g:i A') }}</p>
                            <h3 class="text-xl font-bold text-white">{{ $appt->car->brand->brand_name }} {{ $appt->car->model_name }}</h3>
                            <div class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                {{ $appt->status === 'Pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : '' }}
                                {{ $appt->status === 'Approved' ? 'bg-blue-500/10 text-blue-500 border-blue-500/20' : '' }}
                                {{ $appt->status === 'Committed' ? 'bg-green-500/10 text-green-500 border-green-500/20' : '' }}
                                {{ $appt->status === 'Cancelled' ? 'bg-ryb-red/10 text-ryb-red border-ryb-red/20' : '' }}
                                border">
                                {{ $appt->status }}
                            </div>
                        </div>
                        <a href="{{ route('dashboard.appointments.show', $appt->id) }}" class="px-5 py-2 border border-ryb-red text-ryb-red hover:bg-ryb-red hover:text-white font-bold rounded-lg transition whitespace-nowrap">
                            View Details
                        </a>
                    </div>
                @empty
                    <div class="p-8 text-center text-zinc-500">You have no upcoming appointments.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $appointments->links() }}</div>
        </div>

        {{-- Inquiries Tab --}}
        <div x-show="activeTab === 'inquiries'" x-transition style="display: none;">
            <div class="bg-ryb-dark border border-ryb-muted rounded-2xl overflow-hidden shadow-lg">
                @forelse($inquiries as $inquiry)
                    <div class="p-6 border-b border-ryb-muted last:border-0 flex flex-col md:flex-row justify-between items-start gap-4 hover:bg-ryb-muted/20 transition">
                        <div class="w-full">
                            <div class="flex justify-between items-start w-full mb-2">
                                <h3 class="text-lg font-bold text-white">{{ $inquiry->subject }}</h3>
                                <span class="text-xs text-zinc-500">{{ $inquiry->created_at->diffForHumans() }}</span>
                            </div>
                            @if($inquiry->car)
                                <p class="text-sm text-ryb-red mb-2">Ref: {{ $inquiry->car->brand->brand_name }} {{ $inquiry->car->model_name }}</p>
                            @endif
                            <p class="text-zinc-400 text-sm italic border-l-2 border-ryb-muted pl-3">"{{ Str::limit($inquiry->message, 100) }}"</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-zinc-500">You have not sent any inquiries.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $inquiries->links() }}</div>
        </div>

    </div>
</div>
@endsection