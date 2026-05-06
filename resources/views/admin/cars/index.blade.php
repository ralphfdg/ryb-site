@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Inventory</span> <span class="text-[#e52a2a]">Manager</span>
            </h2>
            <p class="text-[#666] text-sm">Manage the dealership's fleet, specifications, and media galleries.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.cars.create') }}" class="bg-[#e52a2a] hover:bg-[#c92222] text-white text-[11px] font-bold uppercase tracking-wider px-5 py-2.5 rounded shadow-[0_0_15px_rgba(229,42,42,0.3)] transition-all flex items-center gap-2 hover:scale-[1.02]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Vehicle
            </a>
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
                        <th class="px-4 py-4 font-semibold w-20 rounded-tl-lg">Image</th>
                        <th class="px-4 py-4 font-semibold">Vehicle</th>
                        <th class="px-4 py-4 font-semibold">Year / Mileage</th>
                        <th class="px-4 py-4 font-semibold">Price</th>
                        <th class="px-4 py-4 font-semibold">Status</th>
                        <th class="px-4 py-4 font-semibold text-right rounded-tr-lg">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#222] text-[12px]">
                    @forelse($cars as $car)
                    <tr class="hover:bg-[#1a1a1a]/50 transition-colors group">
                        <td class="px-4 py-4">
                            <!-- Fetching the primary thumbnail via Spatie -->
                            <img src="{{ $car->getFirstMediaUrl('car_gallery') ?: asset('images/placeholder-car.jpg') }}" 
                                 alt="{{ $car->model_name }}" 
                                 class="w-16 h-10 object-cover rounded shadow-md border border-[#333] group-hover:border-[#e52a2a]/50 transition-colors">
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-white font-bold text-sm">{{ $car->brand->brand_name }}</p>
                            <p class="text-[#a0a0a0]">{{ $car->model_name }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-[#ddd] font-medium">{{ $car->year }}</p>
                            <p class="text-[#888] text-[10px]">{{ number_format($car->mileage) }} km</p>
                        </td>
                        <td class="px-4 py-4 text-[#2ecc71] font-bold tracking-wide">
                            ₱{{ number_format($car->price, 2) }}
                        </td>
                        <td class="px-4 py-4">
                            @if($car->status == 'Available')
                                <span class="px-3 py-1 bg-[#051c0d] text-[#2ecc71] rounded-full border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider shadow-sm">Available</span>
                            @elseif($car->status == 'Reserved')
                                <span class="px-3 py-1 bg-[#2a1a08] text-[#f39c12] rounded-full border border-[#3a2a0a] text-[9px] font-bold uppercase tracking-wider shadow-sm">Reserved</span>
                            @else
                                <span class="px-3 py-1 bg-[#2a0808] text-[#e52a2a] rounded-full border border-[#3a0a0a] text-[9px] font-bold uppercase tracking-wider shadow-sm">Sold</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right space-x-3">
                            <a href="{{ route('admin.cars.show', $car) }}" class="text-[#888] hover:text-white transition-colors uppercase font-bold tracking-wider text-[10px]">View</a>
                            <a href="{{ route('admin.cars.edit', $car) }}" class="text-[#4a90e2] hover:text-[#74b9ff] transition-colors uppercase font-bold tracking-wider text-[10px]">Edit</a>
                            
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline-block" onsubmit="return confirm('Soft delete this vehicle? It will be removed from the active catalog but preserved in financial audits.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#e52a2a] hover:text-[#ff4757] transition-colors uppercase font-bold tracking-wider text-[10px]">Archive</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-[#666]">No vehicles found in the inventory.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div class="mt-6 border-t border-[#222] pt-4">
            {{ $cars->links() }}
        </div>
    </div>
@endsection