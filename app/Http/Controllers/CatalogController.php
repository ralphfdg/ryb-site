<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CatalogController extends Controller
{
    /**
     * Display a listing of available cars with filtering.
     */
    public function index(Request $request): View
    {
        $cars = QueryBuilder::for(Car::class)
            ->allowedFilters([
                'status',
                'price',
                AllowedFilter::exact('brand_id'),
                // We can add custom filters here for features JSON later
            ])
            ->allowedSorts(['price', 'created_at'])
            ->with('brand') // Eager load the brand relationship to prevent N+1 performance bottlenecks
            ->where('status', 'Available') // Default to only showing available cars to the public
            ->paginate(12);

        // We will pass this to the Blade view we build in Phase 4
        return view('catalog.index', compact('cars'));
    }

    /**
     * Display the specific car details.
     */
    public function show(Car $car): View
    {
        // Ensure the car is loaded with its specifications
        $car->load(['brand', 'specification']);
        
        return view('catalog.show', compact('car'));
    }
}   
