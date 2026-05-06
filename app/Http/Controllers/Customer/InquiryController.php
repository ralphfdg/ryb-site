<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\View\View;

class InquiryController extends Controller
{
    /**
     * Display the specified inquiry thread for the customer.
     */
    public function show(Inquiry $inquiry): View
    {
        // Security Gate: Strict enforcement to ensure the user owns this inquiry
        abort_if($inquiry->user_id !== auth()->id(), 403, 'Unauthorized Access');

        // Eager load the car and brand relationships to prevent N+1 query issues
        $inquiry->load('car.brand');

        return view('customer.inquiries.show', compact('inquiry'));
    }
}