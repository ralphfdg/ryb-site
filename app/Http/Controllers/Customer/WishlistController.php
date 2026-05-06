<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Brand;
use App\Models\CarType;
use App\Models\CarSpecification;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class WishlistController extends Controller
{
    /**
     * Returns an array of Car IDs currently in the user's wishlist.
     */
    public function getWishlistData(Request $request)
    {
        return response()->json([
            'items' => $request->user()->savedCars()->pluck('cars.id')->toArray()
        ]);
    }

    /**
     * Toggles the saved status of a car.
     */
    public function toggle(Request $request, Car $car)
    {
        // Eloquent's toggle automatically attaches or detaches the ID
        $request->user()->savedCars()->toggle($car->id);
        
        return response()->json([
            'status' => 'success',
            'items' => $request->user()->savedCars()->pluck('cars.id')->toArray()
        ]);
    }

    /**
     * Standard view for the Dashboard Wishlist page.
     */
    public function index(Request $request)
    {
        // Re-use the identical filter options from the Catalog
        $brands = Brand::all();
        $carTypes = CarType::all();
        
        $filterOptions = [
            'colors' => CarSpecification::distinct()->pluck('color_exterior')->filter(),
            'engines' => CarSpecification::distinct()->pluck('engine_type')->filter(),
            'fuels' => Car::distinct()->pluck('fuel_type')->filter(),
            'transmissions' => Car::distinct()->pluck('transmission')->filter(),
        ];

        // Apply Spatie Query Builder directly to the Many-to-Many relationship
        $baseQuery = auth()->user()->savedCars();

        $wishlistCars = QueryBuilder::for($baseQuery)
            ->allowedFilters([
                AllowedFilter::partial('model_name'),
                AllowedFilter::exact('brand_id'),
                AllowedFilter::exact('car_type_id'),
                AllowedFilter::exact('year'),
                AllowedFilter::exact('transmission'),
                AllowedFilter::exact('fuel_type'),
                AllowedFilter::exact('plate_ending'),
                AllowedFilter::callback('mileage', fn ($query, $value) => $query->where('mileage', '<=', $value)),
                AllowedFilter::callback('price', fn ($query, $value) => $query->where('price', '<=', $value)),
                AllowedFilter::callback('color_exterior', function ($query, $value) {
                    $query->whereHas('carSpecification', fn($q) => $q->where('color_exterior', $value));
                }),
                AllowedFilter::callback('engine_type', function ($query, $value) {
                    $query->whereHas('carSpecification', fn($q) => $q->where('engine_type', $value));
                }),
            ])
            ->allowedSorts(['price', 'created_at', 'mileage', 'year'])
            ->with(['brand', 'carType', 'carSpecification', 'media'])
            ->paginate(12);

        return view('dashboard.wishlist', compact('wishlistCars', 'brands', 'carTypes', 'filterOptions'));
    }
}