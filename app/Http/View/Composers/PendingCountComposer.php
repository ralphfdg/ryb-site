<?php

namespace App\Http\View\Composers;

use App\Models\Appointment;
use App\Models\Inquiry;
use Illuminate\View\View;

class PendingCountComposer
{
    public function compose(View $view)
    {
        $view->with('pendingAppointmentsCount', Appointment::where('status', 'Pending')->count());
        $view->with('pendingInquiriesCount', Inquiry::where('status', 'Pending')->count());
    }
}