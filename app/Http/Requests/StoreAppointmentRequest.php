<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Spatie RBAC ensures only customers hit this route, 
        // but we double-check that the user is authenticated.
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Ensure the car exists and is actually available for booking
            'car_id' => [
                'required', 
                'exists:cars,id',
                // Custom rule to prevent booking sold/reserved cars
                function ($attribute, $value, $fail) {
                    $car = \App\Models\Car::find($value);
                    if ($car && $car->status !== 'Available') {
                        $fail('This vehicle is currently not available for viewing.');
                    }
                },
            ],
            // Ensure the date is in the future
            'scheduled_at' => ['required', 'date', 'after:now'],
        ];
    }
}