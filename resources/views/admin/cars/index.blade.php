@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Vehicle</span> <span class="text-[#e52a2a]">Inventory</span>
            </h2>
            <p class="text-[#666666] text-xs">Manage your fleet, pricing, and availability.</p>
        </div>
        <div>
            <a href="{{ route('admin.cars.create') }}" class="bg-[#e52a2a] hover:bg-red-700 text-white px-5 py-2.5 rounded-md text-[11px] font-bold tracking-wider uppercase transition-colors shadow-[0_0_15px_rgba(229,42,42,0.3)]">
                + Add New Vehicle
            </a>
        </div>
    </div>

    {{-- Success Message Alert --}}
    @if(session('status'))
        <div class="bg-[#2ecc71]/10 border-l-4 border-[#2ecc71] text-[#a8f0c6] p-4 mb-6 rounded text-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-[#111111] rounded-xl border border-[#1a1a1a] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-[10px] uppercase text-[#666666] border-b border-[#1a1a1a] tracking-widest bg-[#0a0a0a]">
                    <tr>
                        <th class="px-4 py-4 font-semibold">Image</th>
                        <th class="px-4 py-4 font-semibold">Brand / Model</th>
                        <th class="px-4 py-4 font-semibold">VIN / Specs</th>
                        <th class="px-4 py-4 font-semibold">Price</th>
                        <th class="px-4 py-4 font-semibold">Status</th>
                        <th class="px-4 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1a1a1a] text-xs">
                    @forelse($cars as $car)
                    <tr class="hover:bg-[#151515] transition-colors">
                        <td class="px-4 py-4">
                            @if($car->hasMedia('car_gallery'))
                                <img src="{{ $car->getFirstMediaUrl('car_gallery') }}" alt="{{ $car->model_name }}" class="w-16 h-10 object-cover rounded border border-[#333]">
                            @else
                                <div class="w-16 h-10 bg-[#1a1a1a] rounded text-[8px] text-[#666666] flex items-center justify-center border border-[#333]">NO IMG</div>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-white font-bold text-sm">{{ $car->brand->brand_name }}</p>
                            <p class="text-[#a0a0a0]">{{ $car->model_name }} ({{ $car->year }})</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-white font-mono text-[10px]">{{ $car->specification?->vin_number ?? 'N/A' }}</p>
                            <p class="text-[#666] text-[10px]">{{ number_format($car->mileage) }} mi • {{ $car->transmission }}</p>
                        </td>
                        <td class="px-4 py-4 text-[#2ecc71] font-bold">
                            ${{ number_format($car->price, 2) }}
                        </td>
                        <td class="px-4 py-4">
                            @if($car->status == 'Available')
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Available</span>
                            @elseif($car->status == 'Sold')
                                <span class="px-2 py-1 bg-[#2a0808] text-[#e52a2a] rounded border border-[#3a0a0a] text-[9px] font-bold uppercase tracking-wider">Sold</span>
                            @else
                                <span class="px-2 py-1 bg-[#1a1a05] text-[#f5c518] rounded border border-[#332a0a] text-[9px] font-bold uppercase tracking-wider">{{ $car->status }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 flex justify-end gap-2 mt-1">
                            <a href="#" class="w-7 h-7 rounded bg-[#1a1a1a] border border-[#2a2a2a] flex items-center justify-center text-[#666666] hover:text-white transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle? This will also remove associated images.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-7 h-7 rounded bg-[#1a1a1a] border border-[#2a2a2a] flex items-center justify-center text-[#666666] hover:text-[#e52a2a] transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-[#666666]">
                            <p class="mb-2">No vehicles found in the database.</p>
                            <a href="{{ route('admin.cars.create') }}" class="text-[#e52a2a] hover:underline text-xs">Add your first vehicle</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Laravel 12 Tailwind Pagination --}}
        <div class="p-4 border-t border-[#1a1a1a]">
            {{ $cars->links() }}
        </div>
    </div>
@endsection