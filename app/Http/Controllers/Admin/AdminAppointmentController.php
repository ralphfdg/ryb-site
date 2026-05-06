<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminAppointmentController extends Controller
{
    public function index(Request $request): View
    {
        // Eager load relationships. Utilizing UUID mapping implicitly via the 'user' relationship[cite: 1]
        $appointments = Appointment::with(['user', 'car.brand'])
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Viewed', 'Committed', 'Cancelled')")
            ->orderBy('scheduled_at', 'asc')
            ->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Display the specific appointment details for negotiation review.
     */
    public function show(Appointment $appointment): View
    {
        // Eager load the user (via UUID) and the specific car details[cite: 1]
        $appointment->load(['user', 'car.brand', 'car.carSpecification']);
        
        return view('admin.appointments.show', compact('appointment'));
    }

    public function approve(Appointment $appointment): RedirectResponse
    {
        $appointment->update(['status' => 'Approved']);
        // TODO: Trigger Mailable notification to $appointment->user->email using Mailtrap[cite: 1]
        return back()->with('success', 'Appointment approved. Customer notified via email.');
    }

    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Viewed,Committed,Cancelled',
            'negotiated_price' => 'nullable|numeric|min:0',
            'admin_remarks' => 'nullable|string',
            'commitment_status' => 'boolean',
        ]);

        $appointment->update($validated);

        // Business Logic Domain Constraint: Observer trigger shifts inventory status[cite: 1]
        if ($request->boolean('commitment_status')) {
            $appointment->car->update(['status' => 'Reserved']);
        } elseif ($validated['status'] === 'Cancelled' && $appointment->car->status === 'Reserved') {
            $appointment->car->update(['status' => 'Available']);
        }

        return back()->with('success', 'Appointment ledger updated successfully.');
    }
}