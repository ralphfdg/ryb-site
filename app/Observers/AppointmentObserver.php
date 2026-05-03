<?php
namespace App\Observers;

use App\Models\Appointment;

class AppointmentObserver
{
    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        // Check if the status column was modified during this transaction
        if ($appointment->wasChanged('status')) {
            
            // Phase 2, Step 4: Commitment (The Reserve Bridge)
            if ($appointment->status === 'Committed') {
                $appointment->car->update(['status' => 'Reserved']);
            }

            // Pro-active logic: If an appointment falls through and is cancelled, 
            // we should revert the car to 'Available' (only if it hasn't been sold).
            if ($appointment->status === 'Cancelled' && $appointment->car->status === 'Reserved') {
                $appointment->car->update(['status' => 'Available']);
            }
        }
    }
}
