<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of all sales.
     */
    public function index(): View
    {
        // Eager load customer and car. 
        // Note: Our Models already use withTrashed() for these relationships, 
        // ensuring financial history remains intact even if a car/user is soft-deleted.
        $sales = Sale::with(['car.brand', 'customer'])->latest('sale_date')->paginate(20);
        
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create(): View
    {
        // Only fetch cars that are currently 'Available'
        $availableCars = Car::with('brand')->where('status', 'Available')->get();
        
        // Fetch users who have the 'Customer' role
        $customers = User::role('Customer')->get();

        return view('admin.sales.create', compact('availableCars', 'customers'));
    }

    /**
     * Store a newly created sale in storage and update car status.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'car_id' => ['required', 'exists:cars,id'],
            'customer_id' => ['required', 'exists:users,id'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'sale_date' => ['required', 'date'],
        ]);

        // Wrap the process in a DB transaction for financial integrity
        DB::transaction(function () use ($validated) {
            
            // 1. Create the Sale Record
            Sale::create([
                'car_id' => $validated['car_id'],
                'customer_id' => $validated['customer_id'],
                'sale_price' => $validated['sale_price'],
                'sale_date' => $validated['sale_date'],
            ]);

            // 2. Update the Car's status so it drops off the public catalog
            $car = Car::findOrFail($validated['car_id']);
            $car->update(['status' => 'Sold']);
            
        });

        return redirect()->route('admin.sales.index')
            ->with('success', 'Sale recorded successfully. The vehicle has been marked as Sold.');
    }

    /**
     * Display the specified sale receipt/details.
     */
    public function show(Sale $sale): View
    {
        // Load relationships for a detailed view
        $sale->load(['car.brand', 'car.specification', 'customer']);
        
        return view('admin.sales.show', compact('sale'));
    }
}
