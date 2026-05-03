<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Mail\AppointmentApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    /**
     * Approve an appointment and notify the customer.
     */
    public function approve(Request $request, Appointment $appointment): RedirectResponse
    {
        // 1. Update the status in the database
        $appointment->update([
            'status' => 'Approved'
        ]);

        // 2. Dispatch the email to the customer
        // Note: In a high-traffic production environment, we would use Mail::to()->queue() 
        // to prevent the UI from hanging. For XAMPP local testing, send() is fine.
        Mail::to($appointment->customer->email)->send(new AppointmentApproved($appointment));

        return redirect()->back()->with('success', 'Appointment approved and customer notified.');
    }
}
