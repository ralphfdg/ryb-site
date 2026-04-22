<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Later, we will fetch totals from the database here
        // $totalCars = Car::count();
        
        return view('admin.dashboard');
    }
}