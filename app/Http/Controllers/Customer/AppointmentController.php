<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the customer's appointments.
     */
    public function index(): View
    {
        // Fetch only the authenticated user's appointments, eager load the car, and sort.
        $appointments = auth()->user()->appointments()
            ->with('car')
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return view('customer.appointments.index', compact('appointments'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        // The request is already validated by StoreAppointmentRequest
        $validated = $request->validated();

        Appointment::create([
            'car_id' => $validated['car_id'],
            'user_id' => auth()->id(), // Enforce authenticated user ID
            'scheduled_at' => $validated['scheduled_at'],
            'status' => 'Pending',
        ]);

        return redirect()->route('dashboard.appointments.index')
            ->with('success', 'Your viewing request has been submitted. Our admin will review and confirm your schedule shortly.');
    }
}