<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class InquiryController extends Controller
{
    /**
     * Display a listing of the customer inquiries.
     */
    public function index(Request $request): View
    {
        // Eager load potential guest-first null user relationships and associated cars[cite: 1]
        $query = Inquiry::with(['user', 'car']);

        // Optional: Implement simple filtering for the admin view
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Order by Newest first, but prioritize unread/pending inquiries at the top
        $inquiries = $query->orderByRaw("FIELD(status, 'New', 'Pending', 'Resolved')")
                           ->latest()
                           ->paginate(15);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Display the full inquiry message and context.
     */
    public function show(Inquiry $inquiry): View
    {
        // Workflow Optimization: Automatically mark 'New' messages as 'Pending' 
        // once an admin opens them to read.
        if ($inquiry->status === 'New') {
            $inquiry->update(['status' => 'Pending']);
        }
        
        // Eager load the nullable user (handling guest-first inquiries safely) 
        // and the optionally attached car[cite: 1].
        $inquiry->load(['user', 'car.brand']);
        
        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Mark an inquiry as resolved.
     */
    public function resolve(Request $request, Inquiry $inquiry): RedirectResponse
    {
        // Simple state mutation to clear the admin dashboard backlog
        $inquiry->update(['status' => 'Resolved']);

        return back()->with('success', 'Inquiry marked as resolved.');
    }
}