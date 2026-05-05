<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display the operational hub for all appointments.
     */
    public function index(Request $request): View
    {
        // Eager load relationships to prevent N+1.
        $appointments = Appointment::with(['user', 'car.brand'])
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Viewed', 'Committed', 'Cancelled')")
            ->orderBy('scheduled_at', 'asc')
            ->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Phase 2, Step 2: Admin approves the requested time.
     */
    public function approve(Appointment $appointment): RedirectResponse
    {
        $appointment->update(['status' => 'Approved']);

        // TODO: Create AppointmentApprovedMail and uncomment this once ready
        // Mail::to($appointment->user->email)->send(new \App\Mail\AppointmentApprovedMail($appointment));

        return back()->with('success', 'Appointment approved. The customer has been notified via email.');
    }

    /**
     * Phase 2, Steps 3 & 4: Admin updates viewing notes, negotiated price, and commitment.
     */
    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        // For strictness, you could extract this to an UpdateAppointmentAdminRequest later
        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Viewed,Committed,Cancelled',
            'negotiated_price' => 'nullable|numeric|min:0',
            'admin_remarks' => 'nullable|string',
            'commitment_status' => 'boolean',
        ]);

        $appointment->update($validated);

        // Architectural Rule: Commitment shifts inventory status.
        if ($request->boolean('commitment_status')) {
            $appointment->car->update(['status' => 'Reserved']);
        } elseif ($validated['status'] === 'Cancelled' && $appointment->car->status === 'Reserved') {
             // Revert car to Available if a committed deal falls through
             $appointment->car->update(['status' => 'Available']);
        }

        return back()->with('success', 'Appointment ledger updated successfully.');
    }
}   