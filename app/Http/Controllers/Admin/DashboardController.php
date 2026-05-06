<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Sale;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. Top Level Metrics
        $totalCars = Car::count();
        $availableCars = Car::where('status', 'Available')->count();
        $soldCars = Car::where('status', 'Sold')->count();
        $totalCustomers = User::role('Customer')->count(); // Spatie Role-Based mapping[cite: 1]
        $totalSales = Sale::sum('sale_price');

        // 2. Safe percentage calculations to prevent DivisionByZeroError
        $availablePercentage = $totalCars > 0 ? round(($availableCars / $totalCars) * 100) : 0;
        $soldPercentage = $totalCars > 0 ? round(($soldCars / $totalCars) * 100) : 0;

        // 3. Chart.js Data Generation[cite: 1]
        $currentYear = now()->year;
        $salesData = Sale::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(sale_price) as total')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlySales = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlySales[] = $salesData[$i] ?? 0;
        }

        // 4. Eager load relationships to prevent N+1 queries
        $recentCars = Car::with(['brand', 'media'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalCars', 'availableCars', 'soldCars', 'totalCustomers', 
            'totalSales', 'availablePercentage', 'soldPercentage', // <-- Re-added here
            'monthlySales', 'recentCars', 'currentYear'
        ));
    }
}