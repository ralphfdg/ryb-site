<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarRequest;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the cars.
     */
    public function index(): View
    {
        // Eager load BOTH brand and media to completely eliminate N+1
        $cars = Car::with(['brand', 'media'])->latest()->paginate(10);
        
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new car.
     */
    public function create(): View
    {
        // Fetch brands to populate the select dropdown in the form
        $brands = Brand::orderBy('brand_name')->get();
        return view('admin.cars.create', compact('brands'));
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(StoreCarRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                // 1. Create the base Car record
                $car = Car::create($request->safe()->only([
                    'brand_id', 'model_name', 'year', 'price', 
                    'mileage', 'transmission', 'fuel_type', 
                    'description', 'features', 'status'
                ]));

                // 2. Create the 1:1 CarSpecification record
                $car->specification()->create($request->safe()->only([
                    'vin_number', 'engine_type', 'color_exterior', 
                    'color_interior', 'fuel_capacity'
                ]));

                // 3. Handle Media Library Uploads
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $car->addMedia($image)->toMediaCollection('car_gallery');
                    }
                }
            });

            return redirect()->route('admin.cars.index')
                ->with('status', 'Vehicle successfully added to inventory.');

        } catch (\Exception $e) {
            // Log the error for debugging in local XAMPP environment
            Log::error('Failed to store car: ' . $e->getMessage());
            
            return back()->withInput()->withErrors([
                'error' => 'A system error occurred while saving the vehicle. Please check your XAMPP storage permissions.'
            ]);
        }
    }
}