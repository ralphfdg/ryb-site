<x-mail::message>
# Appointment Confirmed

Hello {{ $appointment->customer->name }},

Your request to view the **{{ $appointment->car->year }} {{ $appointment->car->model_name }}** has been approved by our team.

**Viewing Details:**
* **Date & Time:** {{ $appointment->scheduled_at->format('F j, Y \a\t g:i A') }}
* **Location:** RYB Vehicle Trading Main Showroom

If you need to reschedule or have any questions prior to your visit, please contact us or reply directly to this email.

<x-mail::button :url="route('dashboard.appointments')">
View My Appointments
</x-mail::button>

We look forward to seeing you,<br>
{{ config('app.name') }}
</x-mail::message>