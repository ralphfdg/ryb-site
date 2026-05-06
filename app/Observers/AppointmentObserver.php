<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Mail\AppointmentApprovedMail;
use Illuminate\Support\Facades\Mail;

class AppointmentObserver
{
    public function updated(Appointment $appointment): void
    {
        if ($appointment->wasChanged('status')) {
            
            // NEW: Send approval email to customer via Mailtrap
            if ($appointment->status === 'Approved') {
                Mail::to($appointment->user->email)->send(new AppointmentApprovedMail($appointment));
            }

            // Phase 2, Step 4: Commitment
            if ($appointment->status === 'Committed') {
                $appointment->car->update(['status' => 'Reserved']);
            }

            // Revert car status if appointment falls through
            if ($appointment->status === 'Cancelled' && $appointment->car->status === 'Reserved') {
                $appointment->car->update(['status' => 'Available']);
            }
        }
    }
}