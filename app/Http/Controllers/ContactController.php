<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Mail\AdminInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store the inquiry and trigger the email.
     */
    public function store(Request $request)
    {
        // 1. Strict Validation
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // 2. Create the Database Record
        $inquiry = Inquiry::create([
            'user_id' => auth()->id(), // Secured via auth middleware
            'car_id'  => null,         // Explicitly null for general inquiries
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status'  => 'Pending',
        ]);

        // 3. Dispatch Email to Admin via Mailtrap
        // (Assuming you have an admin email defined, or you can query users with 'Admin' role)
        Mail::to('admin@rybvehicletrading.com')->send(new AdminInquiryNotification($inquiry));

        // 4. Return with Success state
        return back()->with('success', 'Your inquiry has been sent successfully. Our team will contact you shortly.');
    }
}