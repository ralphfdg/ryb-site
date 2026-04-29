<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the registered customers.
     */
    public function index(Request $request): View
    {
        // Start the query: Get only Customers and count their related sales
        $query = User::role('Customer')->withCount('sales');

        // Handle Search Filtering
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Paginate results (10 per page to match your UI)
        $customers = $query->latest()->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }
}