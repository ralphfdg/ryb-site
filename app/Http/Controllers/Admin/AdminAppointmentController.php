<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentRescheduledMail;
use App\Mail\AppointmentApprovedMail;
use App\Models\Appointment;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminAppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $appointments = QueryBuilder::for(Appointment::class)
            ->with(['user', 'car.brand'])
            ->allowedFilters([
                AllowedFilter::exact('status'),
                AllowedFilter::exact('car_id'),
                AllowedFilter::callback('scheduled_at', function ($query, $value) {
                    $query->whereDate('scheduled_at', $value);
                }),
            ])
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Viewed', 'Committed', 'Cancelled')")
            ->orderBy('scheduled_at', 'asc')
            ->paginate(15)
            ->appends($request->query());

        $cars = Car::select('id', 'model_name', 'brand_id')->with('brand')->get();

        return view('admin.appointments.index', compact('appointments', 'cars'));
    }

    /**
     * Display the specific appointment details for negotiation review.
     */
    public function show(Appointment $appointment): View
{
    $appointment->load(['user', 'car.brand', 'car.carSpecification']);

    // Fetch ONLY the booked slots for this car, excluding the current appointment
    $bookedSlots = Appointment::where('car_id', $appointment->car_id)
        ->whereIn('status', ['Approved', 'Viewed', 'Committed'])
        ->where('id', '!=', $appointment->id) 
        ->pluck('scheduled_at')
        ->map(function($date) {
            // Force YYYY-MM-DD HH:MM format for JS matching
            return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
        })
        ->toArray();

    return view('admin.appointments.show', compact('appointment', 'bookedSlots'));
}

    /**
     * Handle the initial approval. 
     * Now accepts Request to catch potential reschedules from the scheduler.
     */
    public function approve(Request $request, Appointment $appointment): RedirectResponse
    {
        // 1. Process potential reschedule before approving
        $rescheduled = $this->handleRescheduleLogic($request, $appointment);

        // 2. Update Status
        $appointment->update(['status' => 'Approved']);

        // 3. Notify Customer
        if ($rescheduled) {
            // Customer gets the Reschedule Mail (which includes the approval notice)
            Mail::to($appointment->user->email)->send(new AppointmentRescheduledMail($appointment));
            $msg = 'Appointment rescheduled and approved.';
        } else {
            // Standard Approval Mail
            Mail::to($appointment->user->email)->send(new AppointmentApprovedMail($appointment));
            $msg = 'Appointment approved and customer notified.';
        }

        return back()->with('success', $msg);
    }

    /**
     * General update for negotiations and status changes.
     */
    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        if ($appointment->status === 'Cancelled') {
            return back()->with('error', 'Cannot modify a cancelled appointment.');
        }

        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Viewed,Committed,Cancelled',
            'negotiated_price' => 'nullable|numeric|min:0',
            'admin_remarks' => 'nullable|string',
            'scheduled_at' => 'nullable|date', 
            'commitment_status' => 'boolean', // Re-adding this for your checkbox
        ]);

        // 1. Handle potential reschedule
        if ($this->handleRescheduleLogic($request, $appointment)) {
            Mail::to($appointment->user->email)->send(new AppointmentRescheduledMail($appointment));
        }

        // 2. Sync remaining data
        $appointment->update($validated);

        // 3. Handle Inventory Lock (The "Commitment" Checkbox)
        if ($request->boolean('commitment_status')) {
            $appointment->car->update(['status' => 'Reserved']);
        } elseif ($validated['status'] === 'Cancelled' && $appointment->car->status === 'Reserved') {
            $appointment->car->update(['status' => 'Available']);
        }

        return back()->with('success', 'Operational record updated successfully.');
    }

    /**
     * Centralized Reschedule Logic
     * Returns true if the schedule was actually changed.
     */
    protected function handleRescheduleLogic(Request $request, Appointment $appointment): bool
    {
        if ($request->filled('scheduled_at')) {
            $newDate = Carbon::parse($request->scheduled_at);
            $oldDate = Carbon::parse($appointment->scheduled_at);

            // Only act if the date/time is actually different
            if (!$newDate->equalTo($oldDate)) {
                $appointment->scheduled_at = $newDate;
                $appointment->save();
                return true;
            }
        }
        return false;
    }
}
