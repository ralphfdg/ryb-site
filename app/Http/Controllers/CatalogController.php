<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\CarType;
use App\Models\CarSpecification;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $brands = Brand::all();
        $carTypes = CarType::all();

        // Dynamically fetch unique values for the filters as requested
        $filterOptions = [
            'colors' => CarSpecification::distinct()->pluck('color_exterior')->filter(),
            'engines' => CarSpecification::distinct()->pluck('engine_type')->filter(),
            'fuels' => Car::distinct()->pluck('fuel_type')->filter(),
            'transmissions' => Car::distinct()->pluck('transmission')->filter(),
        ];

        $cars = QueryBuilder::for(Car::class)
            ->where('status', 'Available')
            ->allowedFilters([
                AllowedFilter::partial('model_name'),
                AllowedFilter::exact('brand_id'),
                AllowedFilter::exact('car_type_id'),
                AllowedFilter::exact('year'),
                AllowedFilter::exact('transmission'),
                AllowedFilter::exact('fuel_type'),
                AllowedFilter::exact('plate_ending'),
                // Filter mileage: finds cars with mileage less than or equal to input
                AllowedFilter::callback('mileage', fn ($query, $value) => $query->where('mileage', '<=', $value)),
                // Filter price: finds cars with price less than or equal to input
                AllowedFilter::callback('price', fn ($query, $value) => $query->where('price', '<=', $value)),
                // Relational filters for CarSpecifications
                AllowedFilter::callback('color_exterior', function ($query, $value) {
                    $query->whereHas('carSpecification', fn($q) => $q->where('color_exterior', $value));
                }),
                AllowedFilter::callback('engine_type', function ($query, $value) {
                    $query->whereHas('carSpecification', fn($q) => $q->where('engine_type', $value));
                }),
            ])
            ->allowedSorts(['price', 'created_at', 'mileage', 'year'])
            ->with(['brand', 'carType', 'carSpecification', 'media'])
            ->paginate(6);

        return view('catalog.index', compact('cars', 'brands', 'carTypes', 'filterOptions'));
    }

    /**
     * Display the specified car and pass booked slots for the Alpine.js scheduler.
     */
    public function show(Car $car): View
    {
        // 1. Eager load relations to prevent N+1 queries
        $car->load(['brand', 'carSpecification', 'carType', 'media']);

        // 2. Fetch upcoming booked slots for THIS specific car
        // We block 'Approved', 'Viewed', and 'Committed' to prevent double-booking
        $bookedSlots = Appointment::whereIn('status', ['Approved', 'Viewed', 'Committed'])
    ->pluck('scheduled_at')
    ->map(function($date) {
        return \Carbon\Carbon::parse($date)
            ->timezone(config('app.timezone'))
            ->format('Y-m-d H:i');
    })
    ->toArray();

        return view('catalog.show', compact('car', 'bookedSlots'));
    }

    public function compare(Request $request): View|RedirectResponse
    {
        $carIds = $request->input('cars', []);

        // Security & Integrity: Restrict comparison size to prevent UI breaking
        if (count($carIds) < 2 || count($carIds) > 3) {
            return redirect()->route('catalog.index')
                ->with('error', 'Please select 2 to 3 vehicles to compare.');
        }

        // Optimized query: whereIn fetches all models efficiently to prevent N+1
        $cars = Car::whereIn('id', $carIds)
            ->where('status', 'Available')
            ->with(['brand', 'carType', 'carSpecification', 'media'])
            ->get();

        return view('catalog.compare', compact('cars'));
    }
}