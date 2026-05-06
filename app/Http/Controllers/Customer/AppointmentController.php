<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Mail\NewAppointmentMail;
use App\Mail\AppointmentCancelledMail;
use App\Models\Appointment;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AppointmentController extends Controller
{
    /**
     * Display a unified listing of the customer's appointments and inquiries.
     */
    public function index(): View
    {
        $userId = auth()->id();

        // Spatie Query Builder for Appointments
        // URL Example: /dashboard/appointments?filter[status]=Approved&sort=-scheduled_at
        $appointments = QueryBuilder::for(Appointment::class)
            ->where('user_id', $userId)
            ->allowedFilters([
                AllowedFilter::exact('status'),
            ])
            ->allowedSorts(['scheduled_at', 'created_at'])
            ->defaultSort('-scheduled_at')
            ->with(['car.brand'])
            ->paginate(5, ['*'], 'appointments_page')
            ->appends(request()->query());

        // Spatie Query Builder for Inquiries
        // URL Example: /dashboard/appointments?filter[subject]=finance
        $inquiries = QueryBuilder::for(Inquiry::class)
            ->where('user_id', $userId)
            ->allowedFilters([
                'subject',
                AllowedFilter::exact('status'),
            ])
            ->allowedSorts(['created_at'])
            ->defaultSort('-created_at')
            ->with(['car.brand'])
            ->paginate(5, ['*'], 'inquiries_page')
            ->appends(request()->query());

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

    public function cancel(Appointment $appointment): RedirectResponse
    {
        abort_if($appointment->user_id !== auth()->id(), 403);
    
        if (in_array($appointment->status, ['Pending', 'Approved'])) {
            $appointment->update(['status' => 'Cancelled']);
        
            // Notify Admin that the slot is free
            Mail::to(config('mail.from.address'))->send(new AppointmentCancelledMail($appointment)); 
        
            return back()->with('success', 'Your viewing request has been cancelled successfully.');
        }

        return back()->with('error', 'This appointment can no longer be cancelled.');
    }
}
