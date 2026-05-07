<x-mail::message>
# Schedule Adjustment

Hi {{ $appointment->user->name }},

The dealership has updated the schedule for your viewing of the **{{ $appointment->car->brand->brand_name }} {{ $appointment->car->model_name }}**.

**New Confirmed Schedule:** {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('l, F j, Y \a\t g:i A') }}

We have marked this as **Approved** in our system. If this new time does not work for you, please visit your dashboard to cancel the request.

<x-mail::button :url="route('dashboard.appointments.show', $appointment->id)">
View Appointment Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>