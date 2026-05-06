@extends('layouts.app')

@section('content')
    <div class="bg-ryb-darker min-h-screen pt-24 pb-20 text-ryb-light">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('dashboard.appointments.index', ['activeTab' => 'inquiries']) }}" class="inline-flex items-center text-zinc-500 hover:text-white transition mb-8 font-medium group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Dashboard
            </a>

            <div class="bg-ryb-dark border border-ryb-muted rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                <div class="border-b border-ryb-muted pb-6 mb-6 flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-2">{{ $inquiry->subject }}</h1>
                        <p class="text-zinc-500 text-sm">Submitted on {{ $inquiry->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $inquiry->status === 'Resolved' ? 'bg-green-500/10 text-green-500 border-green-500/20' : 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' }} border">
                        {{ $inquiry->status }}
                    </span>
                </div>

                @if($inquiry->car)
                    <div class="mb-6 p-4 bg-ryb-darker rounded-xl border border-ryb-muted flex justify-between items-center">
                        <div>
                            <p class="text-xs text-zinc-500 uppercase tracking-widest mb-1">Referenced Vehicle</p>
                            <p class="font-bold text-white">{{ $inquiry->car->brand->brand_name }} {{ $inquiry->car->model_name }}</p>
                        </div>
                        <a href="{{ route('catalog.show', $inquiry->car->id) }}" class="text-ryb-red hover:underline text-sm font-bold">View Car</a>
                    </div>
                @endif

                <div class="space-y-6">
                    <div>
                        <p class="text-xs text-zinc-500 uppercase tracking-widest mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Your Message
                        </p>
                        <div class="bg-ryb-darker p-5 rounded-xl border border-ryb-muted">
                            <p class="text-zinc-300 leading-relaxed whitespace-pre-wrap">{{ $inquiry->message }}</p>
                        </div>
                    </div>

                    @if($inquiry->status === 'Resolved')
                    <div>
                        <p class="text-xs text-zinc-500 uppercase tracking-widest mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Resolution Notes
                        </p>
                        <div class="bg-green-500/5 p-5 rounded-xl border border-green-500/20">
                            <p class="text-zinc-300 leading-relaxed italic">An admin has reviewed and marked this inquiry as resolved. Please check your email ({{ auth()->user()->email }}) for detailed replies from our team.</p>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection