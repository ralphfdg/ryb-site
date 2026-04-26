<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Fetch 3 available cars for the Featured section, eager loading the brand and media
        $featuredCars = Car::with(['brand', 'media'])
            ->where('status', 'Available')
            ->latest()
            ->take(3)
            ->get();

        // Fetch 4 recently sold cars
        $soldCars = Car::with(['brand', 'media'])
            ->where('status', 'Sold')
            ->latest('updated_at')
            ->take(4)
            ->get();

        return view('home', compact('featuredCars', 'soldCars'));
    }
}
