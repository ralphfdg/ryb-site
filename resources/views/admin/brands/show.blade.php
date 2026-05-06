@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-10">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 bg-[#0a0a0a] border border-[#222] rounded flex items-center justify-center p-2 shadow-lg">
                @if($brand->getFirstMediaUrl('brand_logos'))
                    <img src="{{ $brand->getFirstMediaUrl('brand_logos') }}" alt="{{ $brand->brand_name }}" class="w-full h-full object-contain">
                @else
                    <span class="text-[#444] text-xs">NO LOGO</span>
                @endif
            </div>
            <div>
                <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">{{ $brand->brand_name }}</span>
                </h2>
                <a href="{{ route('admin.brands.index') }}" class="text-[#666666] hover:text-white text-xs transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Directory
                </a>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.brands.edit', $brand) }}" class="bg-[#1a1a1a] border border-[#333] hover:bg-[#222] text-white text-[11px] font-bold uppercase tracking-wider px-5 py-2.5 rounded transition-all">
                Edit Details
            </a>
        </div>
    </div>

    <!-- Inventory Under this Brand -->
    <div class="bg-[#111111]/80 backdrop-blur-md rounded-xl border border-[#1a1a1a] overflow-hidden p-6 shadow-lg">
        <h3 class="text-[11px] font-bold text-white tracking-widest uppercase font-['Oswald'] mb-6">Inventory: {{ $brand->brand_name }}</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-[9px] uppercase text-[#666666] border-b border-[#1a1a1a] tracking-widest">
                    <tr>
                        <th class="px-2 py-3 font-semibold w-16">Image</th>
                        <th class="px-2 py-3 font-semibold">Model</th>
                        <th class="px-2 py-3 font-semibold">Year</th>
                        <th class="px-2 py-3 font-semibold">Price</th>
                        <th class="px-2 py-3 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1a1a1a] text-[11px]">
                    @forelse($brand->cars as $car)
                    <tr class="hover:bg-[#151515] transition-colors">
                        <td class="px-2 py-3">
                            <img src="{{ $car->getFirstMediaUrl('car_gallery') ?: asset('images/placeholder-car.jpg') }}" class="w-12 h-8 object-cover rounded shadow-sm border border-[#222]">
                        </td>
                        <td class="px-2 py-4 text-white font-medium">{{ $car->model_name }}</td>
                        <td class="px-2 py-4 text-[#a0a0a0]">{{ $car->year }}</td>
                        <td class="px-2 py-4 text-white">${{ number_format($car->price, 2) }}</td>
                        <td class="px-2 py-4">
                            @if($car->status == 'Available')
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Available</span>
                            @else
                                <span class="px-2 py-1 bg-[#2a0808] text-[#e52a2a] rounded border border-[#3a0a0a] text-[9px] font-bold uppercase tracking-wider">{{ $car->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-8 text-center text-[#666666]">No vehicles currently listed under {{ $brand->brand_name }}.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection