<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Models\CarSpecification;

class CarController extends Controller
{
    public function index(): View
    {
        // Eager load brand, car_type, and media to completely eliminate N+1 queries
        $cars = Car::with(['brand', 'carType', 'media'])->latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Display the specified car's deep details.
     */
    public function show(Car $car): View
    {
        // Adhering to the Data Dictionary: Eager load the 1:1 specification record, 
        // the polymorphic media gallery, the brand, and the car type.
        $car->load(['brand', 'carType', 'carSpecification', 'media']);
        
        return view('admin.cars.show', compact('car'));
    }

    public function create(): View
    {
        $brands = Brand::orderBy('brand_name')->get();
        $carTypes = CarType::orderBy('name')->get(); // Added corresponding to the new schema
        return view('admin.cars.create', compact('brands', 'carTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $featuresRaw = $request->input('features', '');
        $featuresArray = array_filter(array_map('trim', explode(',', $featuresRaw)));

        // Validation adhering precisely to the data dictionary data types
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'car_type_id' => 'nullable|exists:car_types,id',
            'model_name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'previous_owners' => 'required|integer|min:0',
            'plate_ending' => 'required|integer|min:0|max:9',
            'features' => 'nullable|string', // Will cast to JSON array object in model[cite: 1]
            'status' => 'required|in:Available,Reserved,Sold',
            'is_featured' => 'boolean',
            
            // 1:1 Specifications
            'vin_number' => 'required|string|size:17|unique:car_specifications,vin_number',
            'engine_type' => 'required|string|max:50',
            'color_exterior' => 'required|string|max:30',
            'color_interior' => 'required|string|max:30',
            'fuel_capacity' => 'required|string|max:15',
            
            // Media
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max per image
        ]);

        try {
            DB::transaction(function () use ($request, $validated, $featuresArray) {
                // 1. Base Car Record
                $car = Car::create([
                    'brand_id' => $validated['brand_id'],
                    'car_type_id' => $validated['car_type_id'],
                    'model_name' => $validated['model_name'],
                    'year' => $validated['year'],
                    'price' => $validated['price'],
                    'mileage' => $validated['mileage'],
                    'transmission' => $validated['transmission'],
                    'fuel_type' => $validated['fuel_type'],
                    'previous_owners' => $validated['previous_owners'],
                    'plate_ending' => $validated['plate_ending'],
                    // Assuming comma-separated string from frontend, handle array cast
                    'features' => $featuresArray,
                    'status' => $validated['status'],
                    'is_featured' => $request->boolean('is_featured'),
                ]);

                // 2. 1:1 Specification Record[cite: 1]
                $car->carSpecification()->create([
                    'vin_number' => $validated['vin_number'],
                    'engine_type' => $validated['engine_type'],
                    'color_exterior' => $validated['color_exterior'],
                    'color_interior' => $validated['color_interior'],
                    'fuel_capacity' => $validated['fuel_capacity'],
                ]);

                // 3. Spatie Media Library[cite: 1]
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $car->addMedia($image)->toMediaCollection('car_gallery');
                    }
                }
            });

            return redirect()->route('admin.cars.index')->with('success', 'Vehicle added to inventory.');

        } catch (\Exception $e) {
            Log::error('Failed to store car: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Database transaction failed. Please check XAMPP logs.');
        }
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Car $car): View
    {
        // Eager load specifications and media to prevent N+1 queries during edit
        $car->load(['carSpecification', 'media']);
        
        // Fetch lookup data for the dropdowns
        $brands = Brand::orderBy('brand_name')->get();
        $carTypes = CarType::orderBy('name')->get(); 

        return view('admin.cars.edit', compact('car', 'brands', 'carTypes'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Car $car): RedirectResponse
    {
        // Strict validation mirroring the data dictionary definitions
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'car_type_id' => 'nullable|exists:car_types,id',
            'model_name' => 'required|string|max:191',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'previous_owners' => 'required|integer|min:0',
            'plate_ending' => 'required|integer|min:0|max:9',
            'features' => 'nullable|string', 
            'status' => 'required|in:Available,Reserved,Sold',
            'is_featured' => 'boolean',
            
            // 1:1 Specifications Validation
            // Note: We ignore the current specification's ID to prevent unique constraint failures
            'vin_number' => 'required|string|size:17|unique:car_specifications,vin_number,' . $car->carSpecification?->id,
            'engine_type' => 'required|string|max:50',
            'color_exterior' => 'required|string|max:30',
            'color_interior' => 'required|string|max:30',
            'fuel_capacity' => 'required|string|max:15',
            
            // Spatie Media Library Validation
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'deleted_media' => 'nullable|array',
            'deleted_media.*' => 'integer|exists:media,id',
        ]);

        $featuresRaw = $request->input('features', '');
        $featuresArray = array_filter(array_map('trim', explode(',', $featuresRaw)));

        try {
            DB::transaction(function () use ($request, $validated, $car, $featuresArray) {
                // 1. Update Base Car Record
                $car->update([
                    'brand_id' => $validated['brand_id'],
                    'car_type_id' => $validated['car_type_id'],
                    'model_name' => $validated['model_name'],
                    'year' => $validated['year'],
                    'price' => $validated['price'],
                    'mileage' => $validated['mileage'],
                    'transmission' => $validated['transmission'],
                    'fuel_type' => $validated['fuel_type'],
                    'previous_owners' => $validated['previous_owners'],
                    'plate_ending' => $validated['plate_ending'],
                    'features' => $featuresArray,
                    'status' => $validated['status'],
                    'is_featured' => $request->boolean('is_featured'),
                ]);

                // 2. Update 1:1 Specification Record
                // Uses updateOrCreate in case a legacy record is missing its spec table
                $car->carSpecification()->updateOrCreate(
                    ['car_id' => $car->id],
                    [
                        'vin_number' => $validated['vin_number'],
                        'engine_type' => $validated['engine_type'],
                        'color_exterior' => $validated['color_exterior'],
                        'color_interior' => $validated['color_interior'],
                        'fuel_capacity' => $validated['fuel_capacity'],
                    ]
                );

                // 3. Process Media Deletions (From the Alpine.js UI)
                if ($request->filled('deleted_media')) {
                    $car->media()->whereIn('id', $request->input('deleted_media'))->delete();
                }

                // 4. Process New Media Additions
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $car->addMedia($image)->toMediaCollection('car_gallery');
                    }
                }
            });

            return redirect()->route('admin.cars.index')
                ->with('success', 'Vehicle records and media gallery updated successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to update car: ' . $e->getMessage());
            return back()->withInput()->with('error', 'A system error occurred. Check XAMPP error logs.');
        }
    }

    public function destroy(Car $car): RedirectResponse
    {
        // Rule 2: Soft Deletes utilizing deleted_at to preserve historical audit/sales data[cite: 1]
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Vehicle removed from active inventory (Soft Deleted).');
    }
}