<x-mail::message>
# Your Viewing Request is Approved!

Hi {{ $appointment->user->name }},

Great news! We have confirmed your viewing schedule for the **{{ $appointment->car->brand->brand_name }} {{ $appointment->car->model_name }}**.

**Confirmed Schedule:** {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('l, F j, Y \a\t g:i A') }}

Please arrive 10 minutes early. If you need to cancel, you can manage this directly from your dashboard.

<x-mail::button :url="route('dashboard.appointments.show', $appointment->id)">
View Appointment Details
</x-mail::button>

We look forward to seeing you.

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>