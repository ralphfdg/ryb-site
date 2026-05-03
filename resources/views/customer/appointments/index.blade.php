<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-200">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Session Alerts -->
            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-400 bg-green-900/50 border border-green-500/50 rounded-lg backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Glassmorphism Container -->
            <div class="overflow-hidden bg-gray-900/50 backdrop-blur-xl border border-gray-700 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    
                    @if($appointments->isEmpty())
                        <p class="text-gray-400">You currently have no appointment requests. <a href="{{ route('catalog.index') }}" class="text-blue-400 hover:underline">Browse our catalog</a> to schedule a viewing.</p>
                    @else
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($appointments as $appointment)
                                <!-- Individual Appointment Card -->
                                <div class="p-5 border rounded-xl bg-white/5 border-white/10 shadow-lg relative">
                                    
                                    <!-- Status Badge -->
                                    <span class="absolute top-4 right-4 px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($appointment->status === 'Pending') bg-yellow-500/20 text-yellow-300 border border-yellow-500/30
                                        @elseif($appointment->status === 'Approved') bg-blue-500/20 text-blue-300 border border-blue-500/30
                                        @elseif($appointment->status === 'Committed') bg-purple-500/20 text-purple-300 border border-purple-500/30
                                        @elseif($appointment->status === 'Cancelled') bg-red-500/20 text-red-300 border border-red-500/30
                                        @else bg-green-500/20 text-green-300 border border-green-500/30 @endif">
                                        {{ $appointment->status }}
                                    </span>

                                    <h3 class="text-lg font-bold">{{ $appointment->car->year }} {{ $appointment->car->model_name }}</h3>
                                    <p class="mt-1 text-sm text-gray-400">Scheduled for:</p>
                                    <p class="font-medium text-blue-300">{{ $appointment->scheduled_at->format('F j, Y \a\t g:i A') }}</p>

                                    @if($appointment->negotiated_price)
                                        <div class="mt-4 pt-4 border-t border-gray-700">
                                            <p class="text-sm text-gray-400">Agreed Price:</p>
                                            <p class="text-lg font-bold text-green-400">₱{{ number_format($appointment->negotiated_price, 2) }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>