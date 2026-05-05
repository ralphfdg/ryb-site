<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Appointment;
use Closure;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Enforce strict Role-Based Access Control
        return auth()->check() && auth()->user()->hasRole('Customer');
    }

    public function rules(): array
    {
        return [
            'car_id' => ['required', 'exists:cars,id'],
            'scheduled_at' => [
                'required', 
                'date', 
                'after:now',
                // Laravel Closure to check MySQL for double-booking conflicts
                function (string $attribute, mixed $value, Closure $fail) {
                    $isTaken = Appointment::where('scheduled_at', $value)
                        ->whereIn('status', ['Approved', 'Viewed', 'Committed'])
                        ->exists();

                    if ($isTaken) {
                        $fail('This specific time slot has just been confirmed for another customer. Please choose a different time.');
                    }
                },
            ],
        ];
    }
}