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

    // GLOBAL SLOT CHECK: Fetch booked slots for ALL cars
    $bookedSlots = Appointment::whereIn('status', ['Approved', 'Viewed', 'Committed'])
        // Still exclude the CURRENT appointment so you can re-save its own time
        ->where('id', '!=', $appointment->id) 
        ->pluck('scheduled_at')
        ->map(function($date) {
            return \Carbon\Carbon::parse($date)
                ->timezone(config('app.timezone')) 
                ->format('Y-m-d H:i');
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
        // 1. Prepare data without saving to DB yet
        $rescheduled = $this->syncRescheduleData($request, $appointment);
        
        // 2. Set the status attribute
        $appointment->status = 'Approved';

        // 3. Execute a SINGLE save operation
        $appointment->save();

        // 4. Send exactly ONE email
        if ($rescheduled) {
            Mail::to($appointment->user->email)->send(new AppointmentRescheduledMail($appointment));
            $msg = 'Rescheduled and Approved.';
        } else {
            Mail::to($appointment->user->email)->send(new AppointmentApprovedMail($appointment));
            $msg = 'Approved.';
        }

        return back()->with('success', $msg);
    }

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
            'commitment_status' => 'boolean',
        ]);

        // 1. Sync reschedule data into the object (no saving)
        $rescheduled = $this->syncRescheduleData($request, $appointment);

        // 2. Fill other validated data
        $appointment->fill($validated);

        // 3. SINGLE save operation
        $appointment->save();

        // 4. Manual Inventory Lock Logic
        if ($request->boolean('commitment_status')) {
            $appointment->car->update(['status' => 'Reserved']);
        }

        // 5. Send ONE email only if time actually changed
        if ($rescheduled) {
            Mail::to($appointment->user->email)->send(new AppointmentRescheduledMail($appointment));
        }

        return back()->with('success', 'Operational record updated.');
    }

    /**
     * Updates the object attributes in memory ONLY.
     * Returns true if a change was made.
     */
    protected function syncRescheduleData(Request $request, Appointment &$appointment): bool
    {
        if ($request->filled('scheduled_at')) {
            $newDate = Carbon::parse($request->scheduled_at);
            $oldDate = Carbon::parse($appointment->scheduled_at);

            if (!$newDate->equalTo($oldDate)) {
                $appointment->scheduled_at = $newDate;
                return true; 
            }
        }
        return false;
    }
}
