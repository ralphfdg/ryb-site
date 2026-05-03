<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-200">
            {{ __('Appointment Control Hub') }}
        </h2>
    </x-slot>

    <!-- Alpine Component Wrapping the Entire Page -->
    <div class="py-12" x-data="{ updateModalOpen: false, saleModalOpen: false, activeAppointmentId: null }">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-400 bg-green-900/50 border border-green-500/50 rounded-lg backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/60 backdrop-blur-xl border border-gray-700 shadow-xl sm:rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-300">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-800/50 border-b border-gray-700">
                        <tr>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Vehicle</th>
                            <th class="px-6 py-4">Date & Time</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="border-b border-gray-800 hover:bg-white/5 transition duration-150">
                                <td class="px-6 py-4 font-medium text-white">{{ $appointment->customer->name }}</td>
                                <td class="px-6 py-4">{{ $appointment->car->year }} {{ $appointment->car->model_name }}</td>
                                <td class="px-6 py-4">{{ $appointment->scheduled_at->format('M j, Y - g:i A') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-md bg-gray-800 border border-gray-600 text-xs">{{ $appointment->status }}</span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    
                                    <!-- Step 2: Approve Action -->
                                    @if($appointment->status === 'Pending')
                                        <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-blue-400 hover:text-blue-300 border border-blue-500/30 bg-blue-500/10 px-3 py-1 rounded">Approve</button>
                                        </form>
                                    @endif

                                    <!-- Steps 3 & 4: Update/Commit Action (Opens Alpine Modal) -->
                                    @if(in_array($appointment->status, ['Approved', 'Viewed']))
                                        <button @click="updateModalOpen = true; activeAppointmentId = {{ $appointment->id }}" class="text-purple-400 hover:text-purple-300 border border-purple-500/30 bg-purple-500/10 px-3 py-1 rounded">Update</button>
                                    @endif

                                    <!-- Step 5: Finalize Sale Action (Opens Alpine Modal) -->
                                    @if($appointment->status === 'Committed')
                                        <button @click="saleModalOpen = true; activeAppointmentId = {{ $appointment->id }}" class="text-green-400 hover:text-green-300 border border-green-500/30 bg-green-500/10 px-3 py-1 rounded">Close Sale</button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Update Appointment Modal (Steps 3 & 4) -->
        <div x-show="updateModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm" x-cloak style="display: none;">
            <div @click.away="updateModalOpen = false" class="bg-gray-800 border border-gray-600 p-6 rounded-xl shadow-2xl w-full max-w-md">
                <h3 class="text-lg font-bold text-white mb-4">Update Viewing Status</h3>
                
                <!-- Dynamic form action using Alpine x-bind -->
                <form x-bind:action="`/admin/appointments/${activeAppointmentId}`" method="POST">
                    @csrf @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-400 mb-1">Status Update</label>
                        <select name="status" class="w-full bg-gray-900 border border-gray-700 text-white rounded focus:ring-purple-500 focus:border-purple-500">
                            <option value="Viewed">Viewed (Negotiating)</option>
                            <option value="Committed">Committed (Will Reserve Car)</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-400 mb-1">Negotiated Price (₱)</label>
                        <input type="number" name="negotiated_price" step="0.01" class="w-full bg-gray-900 border border-gray-700 text-white rounded focus:ring-purple-500 focus:border-purple-500" placeholder="e.g. 500000.00">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-400 mb-1">Admin Remarks</label>
                        <textarea name="admin_remarks" rows="3" class="w-full bg-gray-900 border border-gray-700 text-white rounded focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="updateModalOpen = false" class="px-4 py-2 text-gray-400 hover:text-white">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white rounded shadow">Save Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Finalize Sale Modal (Step 5) -->
        <div x-show="saleModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm" x-cloak style="display: none;">
            <div @click.away="saleModalOpen = false" class="bg-gray-800 border border-gray-600 p-6 rounded-xl shadow-2xl w-full max-w-md">
                <h3 class="text-lg font-bold text-green-400 mb-4">Finalize Transaction</h3>
                
                <form action="{{ route('admin.sales.store') }}" method="POST">
                    @csrf
                    <!-- Pass the dynamic ID to the backend -->
                    <input type="hidden" name="appointment_id" x-bind:value="activeAppointmentId">
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-400 mb-1">Payment Method</label>
                        <select name="payment_method" class="w-full bg-gray-900 border border-gray-700 text-white rounded focus:ring-green-500 focus:border-green-500">
                            <option value="Cash">Cash Transaction</option>
                            <option value="Financing">In-House / Bank Financing</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="saleModalOpen = false" class="px-4 py-2 text-gray-400 hover:text-white">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded shadow">Confirm Sale</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>