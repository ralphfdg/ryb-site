<x-mail::message>
# Viewing Appointment Cancelled

The following viewing request has been cancelled by the customer. The time slot is now available for other inquiries.

**Customer Details:**
* **Name:** {{ $appointment->user->name }}
* **Phone:** {{ $appointment->user->phone_number }}

**Vehicle Information:**
* **Car:** {{ $appointment->car->brand->brand_name }} {{ $appointment->car->model_name }} 
* **Original Schedule:** {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('l, F j, Y \a\t g:i A') }} 

**System Note:**
The car status has been automatically updated if it was previously reserved.

<x-mail::button :url="route('admin.appointments.index')">
View Appointment Hub
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Automated System
</x-mail::message>