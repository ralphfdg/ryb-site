<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Mail\NewAppointmentMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    /**
     * Display a paginated listing of the customer's appointments.
     */
    public function index(): View
    {
        // Eager load the car and its brand to prevent N+1 queries in the view.
        // Replaced ->get() with ->paginate() for better memory management.
        $appointments = auth()->user()->appointments()
            ->with(['car.brand']) 
            ->orderBy('scheduled_at', 'desc')
            ->paginate(10);

        return view('customer.appointments.index', compact('appointments'));
    }

    /**
     * Store a newly created appointment and notify the admin.
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        // Validation and Double-Booking prevention handled by the Form Request
        $validated = $request->validated();

        $appointment = Appointment::create([
            'car_id' => $validated['car_id'],
            'user_id' => auth()->id(), // Strict enforcement of authenticated identity
            'scheduled_at' => $validated['scheduled_at'],
            'status' => 'Pending',
        ]);

        // Dispatch background email to Admin via Mailtrap (Ensure QUEUE_CONNECTION=sync/database in .env)
        Mail::to(config('mail.from.address'))->send(new NewAppointmentMail($appointment));

        return redirect()->route('dashboard.appointments.index')
            ->with('success', 'Your viewing request has been submitted. Our team will review and confirm your schedule shortly.');
    }
}