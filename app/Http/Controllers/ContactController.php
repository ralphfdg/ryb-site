<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Car;
use App\Mail\AdminInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display the general contact form.
     */
    public function index(): View
    {
        return view('contact.index');
    }

    /**
     * Handle General Inquiries (from /contact)
     */
    public function storeGeneral(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $inquiry = Inquiry::create([
            'user_id' => auth()->id(),
            'car_id'  => null, // General contact has no specific car
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status'  => 'Pending',
        ]);

        Mail::to(config('mail.from.address'))->send(new AdminInquiryNotification($inquiry));

        return back()->with('success', 'Your general inquiry has been sent successfully.');
    }

    /**
     * Handle Vehicle-Specific Inquiries (from /catalog/{car})
     */
    public function storeVehicle(Request $request): RedirectResponse
    {
        // 1. Validate the incoming data (Notice we don't require 'subject' here)
        $validated = $request->validate([
            'car_id'  => 'required|exists:cars,id',
            'message' => 'required|string|max:2000',
        ]);

        // 2. Fetch the car to dynamically build the subject line
        $car = Car::with('brand')->findOrFail($validated['car_id']);
        $dynamicSubject = "Vehicle Inquiry: {$car->brand->brand_name} {$car->model_name} (ID: {$car->id})";

        // 3. Create the Database Record
        $inquiry = Inquiry::create([
            'user_id' => auth()->id(),
            'car_id'  => $validated['car_id'], // Now properly mapped to the specific vehicle[cite: 1]
            'subject' => $dynamicSubject,
            'message' => $validated['message'],
            'status'  => 'Pending',
        ]);

        // 4. Dispatch Email to Admin via Mailtrap
        Mail::to(config('mail.from.address'))->send(new AdminInquiryNotification($inquiry));

        // 5. Return with Success state
        return back()->with('success', 'Your inquiry for this vehicle has been sent. Our team will contact you shortly.');
    }
}