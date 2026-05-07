<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // 3. Featured inventory, eager loaded with specifications
        $featuredCars = Car::with(['brand', 'media', 'carSpecification'])
            ->where('status', 'Available')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        // 2. Fetch brands with media for the logo marquee
        $brands = Brand::with('media')->get();

        // 6. Static Testimonials Data (6 items)
        $testimonials = [
            ['name' => 'Juan Dela Cruz', 'comment' => 'The most transparent car buying experience I’ve ever had.', 'rating' => 5],
            ['name' => 'Maria Santos', 'comment' => 'Found my dream SUV. The documentation process was incredibly fast!', 'rating' => 5],
            ['name' => 'Ricardo Gomez', 'comment' => 'RYB Garage has the cleanest inventory. Highly recommend their lineup.', 'rating' => 4],
            ['name' => 'Elena Reyes', 'comment' => 'Fair pricing and honest staff. They really care about vehicle history.', 'rating' => 5],
            ['name' => 'Kevin Tan', 'comment' => 'The premium dark mode website matches the high-end feel of the showroom.', 'rating' => 5],
            ['name' => 'Sarah Lim', 'comment' => 'Smooth transaction from inquiry to delivery. 10/10 service!', 'rating' => 5],
        ];

        return view('home', compact('featuredCars', 'brands', 'testimonials'));
    }
}