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
     * Display a unified listing of the customer's appointments and inquiries.
     */
    public function index(): View
    {
        // Fetch appointments with specific pagination name to prevent page number conflicts
        $appointments = auth()->user()->appointments()
            ->with(['car.brand']) 
            ->orderBy('scheduled_at', 'desc')
            ->paginate(5, ['*'], 'appointments_page');

        // Fetch inquiries
        $inquiries = auth()->user()->inquiries()
            ->with(['car.brand'])
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'inquiries_page');

        return view('customer.appointments.index', compact('appointments', 'inquiries'));
    }

    /**
     * Display the specified appointment summary.
     */
    public function show(Appointment $appointment): View
    {
        // Security Gate: Ensure the logged-in user actually owns this appointment
        abort_if($appointment->user_id !== auth()->id(), 403, 'Unauthorized Access');

        // Eager load relations
        $appointment->load(['car.brand', 'car.carSpecification']);

        return view('customer.appointments.show', compact('appointment'));
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