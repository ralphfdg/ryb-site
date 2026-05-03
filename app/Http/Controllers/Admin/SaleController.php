<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Finalize a committed appointment into a finalized sale.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'payment_method' => 'required|in:Cash,Financing',
        ]);

        $appointment = Appointment::findOrFail($validated['appointment_id']);

        // Security Check
        if ($appointment->status !== 'Committed') {
            return redirect()->back()->with('error', 'Only committed appointments can be finalized into a sale.');
        }

        // Database Transaction ensures both operations succeed or fail together
        DB::transaction(function () use ($appointment, $validated) {
            
            // 1. Create the Sale Record
            Sale::create([
                'car_id' => $appointment->car_id,
                'customer_id' => $appointment->user_id,
                'appointment_id' => $appointment->id,
                'sale_price' => $appointment->negotiated_price ?? $appointment->car->price,
                'payment_method' => $validated['payment_method'],
            ]);

            // 2. Update the Car Status to Sold
            $appointment->car->update(['status' => 'Sold']);
        });

        return redirect()->route('admin.sales.index')
            ->with('success', 'Transaction closed successfully. The vehicle has been marked as Sold.');
    }
}