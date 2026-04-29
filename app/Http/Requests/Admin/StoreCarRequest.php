<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // We rely on the route middleware for Spatie Role checking, so return true here.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Core Car Data
            'brand_id' => ['required', 'exists:brands,id'],
            'model_name' => ['required', 'string', 'max:150'],
            'year' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'price' => ['required', 'numeric', 'min:0'],
            'mileage' => ['required', 'integer', 'min:0'],
            'transmission' => ['required', 'string', 'max:20'],
            'fuel_type' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string'],
            'features' => ['nullable', 'array'], // Cast to JSON in the Model
            'features.*' => ['string'],
            'status' => ['required', 'in:Available,Sold,Reserved'],

            // 1:1 Specifications Data
            'vin_number' => ['required', 'string', 'max:17', 'unique:car_specifications,vin_number'],
            'engine_type' => ['required', 'string', 'max:50'],
            'color_exterior' => ['required', 'string', 'max:30'],
            'color_interior' => ['required', 'string', 'max:30'],
            'fuel_capacity' => ['required', 'string', 'max:15'],

            // Spatie MediaLibrary Image Validation
            'images' => ['required', 'array', 'min:1', 'max:10'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // 5MB max per image
        ];
    }
}