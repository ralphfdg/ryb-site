<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        // Spatie Permission isolation: Get ONLY users with the 'Customer' role[cite: 1]
        $query = User::role('Customer')->withCount('sales');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified customer's profile and history.
     */
    public function show(User $customer): View
    {
        // Security Gate: Utilize Spatie Permission to ensure the Admin 
        // is strictly viewing a 'Customer' role, not another Admin[cite: 1].
        if (!$customer->hasRole('Customer')) {
            abort(403, 'Unauthorized access. This profile does not belong to a registered customer.');
        }

        // Eager load the customer's financial and operational history
        $customer->load([
            'sales.car.brand', 
            'appointments.car.brand'
        ]);

        return view('admin.customers.show', compact('customer'));
    }
}