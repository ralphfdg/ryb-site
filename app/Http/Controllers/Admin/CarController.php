<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(): View
    {
        // Eager load brand. Admin sees all statuses (Available, Sold, Reserved)
        $cars = Car::with('brand')->latest()->paginate(20);
        return view('admin.cars.index', compact('cars'));
    }

    public function create(): View
    {
        $brands = Brand::all();
        return view('admin.cars.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:Available,Sold,Reserved'],
            'vin_number' => ['required', 'string', 'unique:car_specifications,vin_number'],
            // Features would be validated as an array here
        ]);

        // Create the Car
        $car = Car::create([
            'brand_id' => $validated['brand_id'],
            'price' => $validated['price'],
            'status' => $validated['status'],
        ]);

        // Create the 1:1 Specification linking the VIN
        $car->specification()->create([
            'vin_number' => $validated['vin_number']
        ]);

        return redirect()->route('admin.cars.index')->with('success', 'Car added to inventory successfully.');
    }

    // edit(), update(), and destroy() methods would follow similar standard Laravel patterns...
    // destroy() will automatically utilize the SoftDeletes trait we added to the model.
}