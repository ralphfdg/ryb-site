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
                AllowedFilter::callback('price', fn ($query, $value) => $query->where('price', '<=', $value)),
                AllowedFilter::exact('brand_id'),
                // Custom filters for features JSON can be added here later
            ])
            ->allowedSorts(['price', 'created_at'])
            ->with(['brand', 'media']) // Eager load the brand and media to prevent N+1
            ->paginate(12);

        // Pass the query results to the Blade view
        return view('catalog.index', compact('cars'));
    }

    /**
     * Display the specific car details.
     */
    public function show(Car $car): View
    {
        // Ensure the car is loaded with its specifications and media
        $car->load(['brand', 'specification', 'media']);
        
        return view('catalog.show', compact('car'));
    }
}