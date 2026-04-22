<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // ... index, create methods go here ...

    /**
     * Store a newly created car in storage.
     */
    public function store(StoreCarRequest $request)
    {
        // 1. Create the base car record using the validated data
        $car = Car::create($request->validated());

        // 2. Handle the Spatie Medialibrary image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $car->addMedia($image)->toMediaCollection('car_images');
            }
        }

        // 3. Redirect back to your inventory table with a success message
        return redirect()->route('admin.inventory.index')
                         ->with('success', 'Vehicle listing and images successfully saved.');
    }
}