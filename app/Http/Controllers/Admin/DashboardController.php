<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. Top Level Metrics
        $totalCars = Car::count();
        $availableCars = Car::where('status', 'Available')->count();
        $soldCars = Car::where('status', 'Sold')->count();
        $totalCustomers = User::role('Customer')->count(); // Using Spatie Permission
        $totalSales = Sale::sum('sale_price');

        // Calculate Percentages safely to avoid division by zero
        $availablePercentage = $totalCars > 0 ? round(($availableCars / $totalCars) * 100) : 0;
        $soldPercentage = $totalCars > 0 ? round(($soldCars / $totalCars) * 100) : 0;

        // 2. Chart Data: Monthly Sales for Current Year
        $currentYear = now()->year;
        $salesData = Sale::select(
                DB::raw('MONTH(sale_date) as month'),
                DB::raw('SUM(sale_price) as total')
            )
            ->whereYear('sale_date', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Fill missing months with 0
        $monthlySales = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlySales[] = $salesData[$i] ?? 0;
        }

        // 3. Recent Inventory Table (Eager loading 'brand' to prevent N+1 query issues)
        $recentCars = Car::with(['brand', 'media'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalCars', 'availableCars', 'soldCars', 'totalCustomers', 
            'totalSales', 'availablePercentage', 'soldPercentage', 
            'monthlySales', 'recentCars', 'currentYear'
        ));
    }
}