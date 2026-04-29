@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Admin</span> <span class="text-[#e52a2a]">Dashboard</span>
            </h2>
            <p class="text-[#666666] text-xs">Welcome back — here's what's happening today.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-[11px] text-[#666666] border border-[#1a1a1a] bg-[#0a0a0a] px-4 py-2 rounded-full font-medium">
                {{ now()->format('D, F j, Y') }}
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <!-- Total Cars -->
        <div class="bg-[#111111] p-5 rounded-xl border border-[#1a1a1a]">
            <!-- ... Keep your SVG icon ... -->
            <h3 class="text-[#666666] text-[9px] font-bold uppercase tracking-widest mb-1">Total Cars</h3>
            <p class="text-2xl font-bold text-white mb-1">{{ number_format($totalCars) }}</p>
        </div>

        <!-- Available Cars -->
        <div class="bg-[#111111] p-5 rounded-xl border border-[#1a1a1a]">
            <!-- ... Keep your SVG icon ... -->
            <h3 class="text-[#666666] text-[9px] font-bold uppercase tracking-widest mb-1">Available Cars</h3>
            <p class="text-2xl font-bold text-[#2ecc71] mb-1">{{ number_format($availableCars) }}</p>
            <p class="text-[10px] text-[#2ecc71]">{{ $availablePercentage }}% of fleet</p>
        </div>

        <!-- Sold Cars -->
        <div class="bg-[#111111] p-5 rounded-xl border border-[#1a1a1a]">
            <!-- ... Keep your SVG icon ... -->
            <h3 class="text-[#666666] text-[9px] font-bold uppercase tracking-widest mb-1">Sold Cars</h3>
            <p class="text-2xl font-bold text-[#e52a2a] mb-1">{{ number_format($soldCars) }}</p>
            <p class="text-[10px] text-[#e52a2a]">{{ $soldPercentage }}% of fleet</p>
        </div>

        <!-- Total Customers -->
        <div class="bg-[#111111] p-5 rounded-xl border border-[#1a1a1a]">
            <!-- ... Keep your SVG icon ... -->
            <h3 class="text-[#666666] text-[9px] font-bold uppercase tracking-widest mb-1">Total Customers</h3>
            <p class="text-2xl font-bold text-blue-400 mb-1">{{ number_format($totalCustomers) }}</p>
        </div>

        <!-- Total Sales -->
        <div class="bg-[#111111] p-5 rounded-xl border border-[#1a1a1a]">
            <!-- ... Keep your SVG icon ... -->
            <h3 class="text-[#666666] text-[9px] font-bold uppercase tracking-widest mb-1">Total Sales</h3>
            <p class="text-2xl font-bold text-yellow-500 mb-1">${{ number_format($totalSales, 2) }}</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="col-span-2 bg-[#111111] p-6 rounded-xl border border-[#1a1a1a]">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-[11px] font-bold text-white tracking-widest uppercase font-['Oswald']">Monthly Sales Revenue</h3>
                <span class="text-[9px] text-[#e52a2a] bg-[#e52a2a]/10 px-2 py-1 rounded border border-[#e52a2a]/20">{{ $currentYear }}</span>
            </div>
            <div class="relative h-[220px]">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="col-span-1 bg-[#111111] p-6 rounded-xl border border-[#1a1a1a] flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-[11px] font-bold text-white tracking-widest uppercase font-['Oswald']">Fleet Status</h3>
                <span class="text-[9px] text-[#2ecc71] bg-[#2ecc71]/10 px-2 py-1 rounded border border-[#2ecc71]/20">LIVE</span>
            </div>
            <div class="relative flex-1 flex justify-center items-center">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Inventory Table Section -->
    <div class="bg-[#111111] rounded-xl border border-[#1a1a1a] overflow-hidden p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-[11px] font-bold text-white tracking-widest uppercase font-['Oswald']">Recent Inventory</h3>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-[9px] uppercase text-[#666666] border-b border-[#1a1a1a] tracking-widest">
                    <tr>
                        <th class="px-2 py-3 font-semibold">Brand</th>
                        <th class="px-2 py-3 font-semibold">Model</th>
                        <th class="px-2 py-3 font-semibold">Year</th>
                        <th class="px-2 py-3 font-semibold">Price</th>
                        <th class="px-2 py-3 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1a1a1a] text-[11px]">
                    @forelse($recentCars as $car)
                    <tr class="hover:bg-[#151515] transition-colors">
                        <td class="px-2 py-4 text-white">{{ $car->brand->brand_name }}</td>
                        <td class="px-2 py-4 text-[#a0a0a0]">{{ $car->model_name }}</td>
                        <td class="px-2 py-4 text-[#a0a0a0]">{{ $car->year }}</td>
                        <td class="px-2 py-4 text-white font-medium">${{ number_format($car->price, 2) }}</td>
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
                        <td colspan="5" class="px-2 py-8 text-center text-[#666666]">No vehicles in inventory yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.rybDashboardData = {
            monthlySales: @json($monthlySales),
            availableCars: {{ $availableCars }},
            soldCars: {{ $soldCars }}
        };
    </script>
    
    <!-- 2. Let Vite handle the bundling and injection -->
    @vite(['resources/js/admin/dashboard.js'])
@endsection