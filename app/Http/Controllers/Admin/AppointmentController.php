<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Mail\AppointmentApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    /**
     * Display a listing of all system appointments.
     */
    public function index(): View
    {
        // Fetch all appointments, eager load relations, order by schedule
        $appointments = Appointment::with(['car', 'customer'])
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Approve an appointment and notify the customer.
     */
    public function approve(Request $request, Appointment $appointment): RedirectResponse
    {
        $appointment->update([
            'status' => 'Approved'
        ]);

        // Dispatch email to customer
        Mail::to($appointment->customer->email)->send(new AppointmentApproved($appointment));

        return redirect()->back()->with('success', 'Appointment approved and customer notified.');
    }

    /**
     * Update the appointment details after a physical viewing.
     */
    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:Viewed,Committed,Cancelled',
            'negotiated_price' => 'nullable|numeric|min:0',
            'admin_remarks' => 'nullable|string',
        ]);

        $appointment->update([
            'status' => $validated['status'],
            'negotiated_price' => $validated['negotiated_price'],
            'admin_remarks' => $validated['admin_remarks'],
            'commitment_status' => $validated['status'] === 'Committed',
        ]);

        // Note: The AppointmentObserver automatically changes the Car status 
        // to 'Reserved' when commitment_status becomes true.

        return redirect()->back()->with('success', "Appointment marked as {$validated['status']}.");
    }
}