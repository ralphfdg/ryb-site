@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Appointment</span> <span class="text-[#e52a2a]">Hub</span>
            </h2>
            <p class="text-[#666666] text-xs">Manage customer viewings and sales conversions.</p>
        </div>
    </div>

    <!-- Alpine Component Wrapping the Entire Page -->
    <div x-data="{ updateModalOpen: false, saleModalOpen: false, activeAppointmentId: null }">
        
        @if(session('success'))
            <div class="bg-[#2ecc71]/10 border-l-4 border-[#2ecc71] text-[#a8f0c6] p-4 mb-6 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#111111] rounded-xl border border-[#1a1a1a] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-[10px] uppercase text-[#666666] border-b border-[#1a1a1a] tracking-widest bg-[#0a0a0a]">
                        <tr>
                            <th class="px-4 py-4 font-semibold">Customer</th>
                            <th class="px-4 py-4 font-semibold">Vehicle</th>
                            <th class="px-4 py-4 font-semibold">Date & Time</th>
                            <th class="px-4 py-4 font-semibold">Status</th>
                            <th class="px-4 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1a1a1a] text-xs">
                        @forelse($appointments as $appointment)
                            <tr class="hover:bg-[#151515] transition-colors">
                                <td class="px-4 py-4 font-bold text-white">{{ $appointment->customer->name }}</td>
                                <td class="px-4 py-4 text-[#a0a0a0]">{{ $appointment->car->year }} {{ $appointment->car->model_name }}</td>
                                <td class="px-4 py-4 text-[#a0a0a0]">{{ $appointment->scheduled_at->format('M j, Y - g:i A') }}</td>
                                <td class="px-4 py-4">
                                    @if($appointment->status == 'Approved')
                                        <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">{{ $appointment->status }}</span>
                                    @elseif($appointment->status == 'Viewed')
                                        <span class="px-2 py-1 bg-[#1a1a05] text-[#f5c518] rounded border border-[#332a0a] text-[9px] font-bold uppercase tracking-wider">{{ $appointment->status }}</span>
                                    @else
                                        <span class="px-2 py-1 bg-[#1a1a1a] text-[#666666] rounded border border-[#333333] text-[9px] font-bold uppercase tracking-wider">{{ $appointment->status }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 flex justify-end gap-2 mt-1">
                                    
                                    <!-- Step 2: Approve Action -->
                                    @if($appointment->status === 'Pending')
                                        <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#4ea8de] hover:text-white transition-colors text-[10px] font-bold uppercase tracking-wider">Approve</button>
                                        </form>
                                    @endif

                                    <!-- Steps 3 & 4: Update/Commit Action (Opens Alpine Modal) -->
                                    @if(in_array($appointment->status, ['Approved', 'Viewed']))
                                        <button @click="updateModalOpen = true; activeAppointmentId = {{ $appointment->id }}" class="px-3 py-1 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#9d4edd] hover:text-white transition-colors text-[10px] font-bold uppercase tracking-wider">Update</button>
                                    @endif

                                    <!-- Step 5: Finalize Sale Action (Opens Alpine Modal) -->
                                    @if($appointment->status === 'Committed')
                                        <button @click="saleModalOpen = true; activeAppointmentId = {{ $appointment->id }}" class="px-3 py-1 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#2ecc71] hover:text-white transition-colors text-[10px] font-bold uppercase tracking-wider">Close Sale</button>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-[#666666]">
                                    <p class="mb-2">No appointments found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Update Appointment Modal (Steps 3 & 4) -->
        <div x-show="updateModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-cloak style="display: none;">
            <div @click.away="updateModalOpen = false" class="bg-[#111111] border border-[#1a1a1a] p-6 rounded-xl shadow-[0_0_30px_rgba(0,0,0,0.8)] w-full max-w-md">
                <h3 class="text-lg font-bold text-white mb-4 uppercase tracking-wide">Update Viewing Status</h3>
                
                <form x-bind:action="`/admin/appointments/${activeAppointmentId}`" method="POST">
                    @csrf @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-[10px] uppercase tracking-widest text-[#666666] mb-1">Status Update</label>
                        <select name="status" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] text-white rounded focus:ring-[#e52a2a] focus:border-[#e52a2a] text-sm p-2.5">
                            <option value="Viewed">Viewed (Negotiating)</option>
                            <option value="Committed">Committed (Will Reserve Car)</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[10px] uppercase tracking-widest text-[#666666] mb-1">Negotiated Price ($)</label>
                        <input type="number" name="negotiated_price" step="0.01" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] text-white rounded focus:ring-[#e52a2a] focus:border-[#e52a2a] text-sm p-2.5" placeholder="e.g. 50000.00">
                    </div>

                    <div class="mb-6">
                        <label class="block text-[10px] uppercase tracking-widest text-[#666666] mb-1">Admin Remarks</label>
                        <textarea name="admin_remarks" rows="3" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] text-white rounded focus:ring-[#e52a2a] focus:border-[#e52a2a] text-sm p-2.5"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="updateModalOpen = false" class="px-4 py-2 text-[#666666] hover:text-white text-xs font-bold uppercase tracking-wider transition-colors">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-[#9d4edd] hover:bg-purple-600 text-white rounded text-xs font-bold uppercase tracking-wider transition-colors">Save Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Finalize Sale Modal (Step 5) -->
        <div x-show="saleModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-cloak style="display: none;">
            <div @click.away="saleModalOpen = false" class="bg-[#111111] border border-[#1a1a1a] p-6 rounded-xl shadow-[0_0_30px_rgba(0,0,0,0.8)] w-full max-w-md">
                <h3 class="text-lg font-bold text-[#2ecc71] mb-4 uppercase tracking-wide">Finalize Transaction</h3>
                
                <form action="{{ route('admin.sales.store') }}" method="POST">
                    @csrf
                    <!-- Pass the dynamic ID to the backend -->
                    <input type="hidden" name="appointment_id" x-bind:value="activeAppointmentId">
                    
                    <div class="mb-6">
                        <label class="block text-[10px] uppercase tracking-widest text-[#666666] mb-1">Payment Method</label>
                        <select name="payment_method" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] text-white rounded focus:ring-[#2ecc71] focus:border-[#2ecc71] text-sm p-2.5">
                            <option value="Cash">Cash Transaction</option>
                            <option value="Financing">In-House / Bank Financing</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="saleModalOpen = false" class="px-4 py-2 text-[#666666] hover:text-white text-xs font-bold uppercase tracking-wider transition-colors">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-[#2ecc71] hover:bg-green-600 text-white rounded text-xs font-bold uppercase tracking-wider transition-colors">Confirm Sale</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection