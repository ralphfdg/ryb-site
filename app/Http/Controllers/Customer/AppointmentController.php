<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    /**
     * Store a newly created appointment in storage.
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        // The request is already validated at this point.
        $validated = $request->validated();

        // Create the appointment. 
        // Notice we explicitly pull the user_id from the authenticated session, 
        // NOT the form request, to prevent ID spoofing vulnerabilities.
        Appointment::create([
            'car_id' => $validated['car_id'],
            'user_id' => auth()->id(),
            'scheduled_at' => $validated['scheduled_at'],
            'status' => 'Pending', // Defaults to Pending per data dictionary
        ]);

        // Redirect back to the car catalog or user dashboard with a success flash message
        return redirect()->route('dashboard.appointments')
            ->with('success', 'Your viewing request has been submitted. Our admin will review and confirm your schedule shortly.');
    }
}
