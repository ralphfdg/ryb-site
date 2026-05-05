<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $brands = Brand::all();
        $carTypes = CarType::all();

        $cars = QueryBuilder::for(Car::class)
            ->where('status', 'Available') // Global scope enforcement
            ->allowedFilters([
                AllowedFilter::partial('model_name'),
                AllowedFilter::exact('brand_id'),
                AllowedFilter::exact('car_type_id'), // The new shape filter
                AllowedFilter::exact('year'),
                AllowedFilter::exact('transmission'),
                AllowedFilter::callback('price', fn ($query, $value) => $query->where('price', '<=', $value)),
            ])
            ->allowedSorts(['price', 'created_at'])
            ->with(['brand', 'carType', 'carSpecification', 'media'])
            ->paginate(12);

        return view('catalog.index', compact('cars', 'brands', 'carTypes'));
    }

    public function show(Car $car): View
    {
        if ($car->status !== 'Available') {
            abort(404, 'This vehicle is no longer available in our public catalog.');
        }

        $car->load(['brand', 'carType', 'carSpecification', 'media']);
        return view('catalog.show', compact('car'));
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