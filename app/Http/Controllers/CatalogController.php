<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
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
        // Dynamically fetch brands for the filter sidebar
        $brands = Brand::all();

        $cars = QueryBuilder::for(Car::class)
            ->where('status', 'Available') // SECURITY: Globally scoped to available cars only
            ->allowedFilters([
                AllowedFilter::partial('model_name'), // Enables partial text search
                AllowedFilter::exact('brand_id'),
                AllowedFilter::exact('year'),
                AllowedFilter::callback('price', fn ($query, $value) => $query->where('price', '<=', $value)),
            ])
            ->allowedSorts(['price', 'created_at'])
            ->with(['brand', 'carSpecification', 'media']) // Prevent N+1 queries
            ->paginate(12);

        return view('catalog.index', compact('cars', 'brands'));
    }

    /**
     * Display the specific car details.
     */
    public function show(Car $car): View
    {
        // Edge Case: If a user accesses a bookmarked URL of a sold car
        if ($car->status !== 'Available') {
            abort(404, 'This vehicle is no longer available in our public catalog.');
        }

        // Ensure the relationship exactly matches your updated schema
        $car->load(['brand', 'carSpecification', 'media']);
        
        return view('catalog.show', compact('car'));
    }
}