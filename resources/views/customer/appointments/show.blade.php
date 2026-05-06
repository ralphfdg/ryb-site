@extends('layouts.app')

@section('content')
    <div class="bg-ryb-darker min-h-screen pt-24 pb-20 text-ryb-light">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('dashboard.appointments.index') }}"
                class="inline-flex items-center text-zinc-500 hover:text-white transition mb-8 font-medium group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Dashboard
            </a>

            <div class="bg-ryb-dark border border-ryb-muted rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                {{-- Status Banner --}}
                <div
                    class="absolute top-0 left-0 w-full h-2 
                {{ $appointment->status === 'Pending' ? 'bg-yellow-500' : '' }}
                {{ $appointment->status === 'Approved' ? 'bg-blue-500' : '' }}
                {{ $appointment->status === 'Committed' ? 'bg-green-500' : '' }}
                {{ $appointment->status === 'Cancelled' ? 'bg-ryb-red' : '' }}">
                </div>

                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-ryb-muted pb-6 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Viewing Summary</h1>
                        <p class="text-zinc-500 font-mono">Ref ID: #{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <p class="text-sm text-zinc-500 uppercase tracking-widest mb-1">Status</p>
                        <span class="text-xl font-bold text-white tracking-wide">{{ $appointment->status }}</span>
                    </div>
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    {{-- Left Col: Schedule & Info --}}
                    <div class="space-y-6">
                        <div>
                            <p class="text-xs text-zinc-500 uppercase tracking-widest mb-1">Confirmed Schedule</p>
                            <p class="text-xl font-bold text-ryb-light">
                                {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('l, F j, Y') }}</p>
                            <p class="text-lg text-ryb-red font-mono">
                                {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('g:i A') }}</p>
                        </div>

                        <div class="bg-ryb-darker p-4 rounded-xl border border-ryb-muted">
                            <p class="text-xs text-zinc-500 uppercase tracking-widest mb-2">Vehicle Details</p>
                            <p class="font-bold text-white text-lg">{{ $appointment->car->brand->brand_name }}
                                {{ $appointment->car->model_name }}</p>
                            <p class="text-sm text-zinc-400">{{ $appointment->car->year }} |
                                {{ $appointment->car->transmission }} | {{ number_format($appointment->car->mileage) }} km
                            </p>

                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-ryb-muted/50">
                                <p class="text-sm text-zinc-400 font-mono">Asking:
                                    ₱{{ number_format($appointment->car->price, 2) }}</p>

                                {{-- Redirect button to the Public Catalog Show Page --}}
                                <a href="{{ route('catalog.show', $appointment->car->id) }}"
                                    class="text-xs flex items-center gap-1 px-3 py-1.5 border border-ryb-red/50 text-ryb-red rounded-lg hover:bg-ryb-red hover:text-white transition">
                                    View Listing
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        {{-- Status-Based Action Area --}}
                        <div
                            class="mt-8 pt-8 border-t border-ryb-muted flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="text-center md:text-left">
                                <h4 class="text-white font-bold mb-1">Need to change your plans?</h4>
                                <p class="text-zinc-500 text-sm">If you can no longer attend, please cancel so others may
                                    view this vehicle.</p>
                            </div>

                            @if (in_array($appointment->status, ['Pending', 'Approved']))
                                <form action="{{ route('dashboard.appointments.cancel', $appointment->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to cancel this viewing request?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="px-8 py-3 border-2 border-ryb-red text-ryb-red hover:bg-ryb-red hover:text-white font-bold rounded-xl transition duration-300 shadow-lg shadow-ryb-red/5">
                                        Cancel Appointment
                                    </button>
                                </form>
                            @else
                                <div
                                    class="px-6 py-3 bg-ryb-dark border border-ryb-muted rounded-xl text-zinc-500 text-sm italic">
                                    Cancellation is no longer available for this status.
                                </div>
                            @endif
                        </div>
                    </div>



                    {{-- Right Col: Dealership Notes --}}
                    <div class="bg-ryb-darker p-6 rounded-xl border border-ryb-muted flex flex-col justify-between">
                        <div>
                            <p class="text-xs text-zinc-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                    </path>
                                </svg>
                                Dealership Remarks
                            </p>
                            @if ($appointment->admin_remarks)
                                <p class="text-zinc-300 text-sm leading-relaxed">{{ $appointment->admin_remarks }}</p>
                            @else
                                <p class="text-zinc-600 text-sm italic">No remarks have been added by the admin yet.</p>
                            @endif
                        </div>

                        <div class="mt-6 pt-6 border-t border-ryb-muted">
                            <p class="text-xs text-zinc-500 uppercase tracking-widest mb-1">Negotiated Price</p>
                            @if ($appointment->negotiated_price)
                                <p class="text-3xl font-bold text-green-400 tracking-tight">
                                    ₱{{ number_format($appointment->negotiated_price, 2) }}</p>
                            @else
                                <p class="text-lg font-bold text-zinc-600 tracking-tight">Pending Negotiation</p>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($appointment->status === 'Committed')
                    <div class="bg-green-500/10 border border-green-500/20 rounded-xl p-4 text-center">
                        <p class="text-green-400 font-bold">This vehicle has been secured and is preparing for final sale!
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
