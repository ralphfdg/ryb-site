@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Brand</span> <span class="text-[#e52a2a]">Manager</span>
            </h2>
            <p class="text-[#666666] text-xs">Manage manufacturer directories and official logos.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.brands.create') }}" class="bg-[#e52a2a] hover:bg-[#c92222] text-white text-[11px] font-bold uppercase tracking-wider px-5 py-2.5 rounded shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Brand
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-[#051c0d] border border-[#0a381a] text-[#2ecc71] px-4 py-3 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 bg-[#2a0808] border border-[#3a0a0a] text-[#e52a2a] px-4 py-3 rounded text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-[#111111]/80 backdrop-blur-md rounded-xl border border-[#1a1a1a] overflow-hidden p-6 shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-[9px] uppercase text-[#666666] border-b border-[#1a1a1a] tracking-widest">
                    <tr>
                        <th class="px-4 py-3 font-semibold w-24">Logo</th>
                        <th class="px-4 py-3 font-semibold">Manufacturer Name</th>
                        <th class="px-4 py-3 font-semibold text-center w-32">Cars in Stock</th>
                        <th class="px-4 py-3 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1a1a1a] text-[11px]">
                    @forelse($brands as $brand)
                    <tr class="hover:bg-[#151515] transition-colors">
                        <td class="px-4 py-4">
                            <div class="w-12 h-12 bg-[#0a0a0a] border border-[#222] rounded flex items-center justify-center p-1">
                                <!-- Spatie MediaLibrary hook -->
                                @if($brand->getFirstMediaUrl('brand_logos'))
                                    <img src="{{ $brand->getFirstMediaUrl('brand_logos') }}" alt="{{ $brand->brand_name }}" class="w-full h-full object-contain">
                                @else
                                    <span class="text-[#444] text-[9px]">NO LOGO</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-4 text-white font-medium text-sm">{{ $brand->brand_name }}</td>
                        <td class="px-4 py-4 text-[#a0a0a0] text-center">
                            {{ $brand->cars_count ?? $brand->cars()->count() }}
                        </td>
                        <td class="px-4 py-4 text-right space-x-3">
                            <a href="{{ route('admin.brands.show', $brand) }}" class="text-[#666] hover:text-white transition-colors uppercase font-bold tracking-wider text-[10px]">View</a>
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="text-[#4a90e2] hover:text-[#74b9ff] transition-colors uppercase font-bold tracking-wider text-[10px]">Edit</a>
                            
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#e52a2a] hover:text-[#ff4757] transition-colors uppercase font-bold tracking-wider text-[10px]">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-[#666666]">No brands added yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $brands->links() }}
        </div>
    </div>
@endsection