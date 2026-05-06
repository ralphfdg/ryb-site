<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\Car;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

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
            'car_id' => [
                'required',
                'exists:cars,id',
                // Rule: Check if vehicle is actually available in the DB
                function ($attribute, $value, $fail) {
                    $car = Car::find($value);
                    if ($car && $car->status !== 'Available') {
                        $fail('This vehicle is no longer available for viewings.');
                    }
                },
                // Rule: One pending appointment per car per user
                function ($attribute, $value, $fail) {
                    $exists = Appointment::where('user_id', auth()->id())
                        ->where('car_id', $value)
                        ->whereIn('status', ['Pending', 'Approved'])
                        ->exists();
                    if ($exists) {
                        $fail('You already have an active viewing request for this vehicle.');
                    }
                },
            ],
            'scheduled_at' => [
                'required',
                'date',
                'after:now',
                // Your existing double-booking closure...
        ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Rule: Global limit of 3 active appointments per user
            $activeCount = auth()->user()->appointments()
                ->whereIn('status', ['Pending', 'Approved'])
                ->count();

            if ($activeCount >= 3) {
                $validator->errors()->add('limit', 'You have reached the maximum of 3 active viewing requests. Please wait for the Admin to process your current ones.');
            }
        });
    }
}