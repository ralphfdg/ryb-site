<x-mail::message>
# New Viewing Appointment Requested

Hello Admin,

A new vehicle viewing appointment has been submitted and is waiting for your review.

<x-mail::panel>
### Customer Information
**Name:** {{ $appointment->user->name }}  
**Email:** [{{ $appointment->user->email }}](mailto:{{ $appointment->user->email }})  
**Phone:** {{ $appointment->user->phone_number ?? 'Not Provided' }}
</x-mail::panel>

### Vehicle Details
* **Make & Model:** {{ $appointment->car->brand->brand_name }} {{ $appointment->car->model_name }}
* **VIN:** {{ $appointment->car->carSpecification->vin_number ?? 'N/A' }}
* **Listed Price:** ₱{{ number_format($appointment->car->price, 2) }}

### Requested Schedule
**Date & Time:** {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('F j, Y \a\t g:i A') }}

To approve, reschedule, or communicate with the customer, please manage this request in the admin hub.

<x-mail::button :url="route('admin.appointments.index')" color="error">
Manage Appointment
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Automated System
</x-mail::message>