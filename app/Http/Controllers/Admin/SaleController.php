<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        // View-only financial ledger populated automatically[cite: 1]
        $sales = Sale::with(['car.brand', 'customer', 'appointment'])->latest()->paginate(15);
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Display the financial transaction receipt.
     */
    public function show(Sale $sale): View
    {
        // The Sale model uses a char(36) UUID. Route Model binding handles this 
        // natively in Laravel 12. Eager load the required financial paper trail[cite: 1].
        $sale->load(['car.brand', 'customer', 'appointment']);
        
        return view('admin.sales.show', compact('sale'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'payment_method' => 'required|in:Cash,Financing', // Enum constraint[cite: 1]
        ]);

        $appointment = Appointment::findOrFail($validated['appointment_id']);

        if ($appointment->status !== 'Committed') {
            return back()->with('error', 'Only committed appointments can be finalized into a sale.');
        }

        DB::transaction(function () use ($appointment, $validated) {
            // Note: Sale model requires the HasUuids trait to auto-generate the char(36) ID[cite: 1]
            Sale::create([
                'car_id' => $appointment->car_id,
                'customer_id' => $appointment->user_id, // Safely handles UUID foreign key
                'appointment_id' => $appointment->id,
                'sale_price' => $appointment->negotiated_price ?? $appointment->car->price,
                'payment_method' => $validated['payment_method'],
            ]);

            $appointment->car->update(['status' => 'Sold']);
        });

        return redirect()->route('admin.sales.index')->with('success', 'Transaction closed successfully.');
    }
}