<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EnquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $counts = [
            'total' => Enquiry::count(),
            'new' => Enquiry::where('status', EnquiryStatus::New)->count(),
            'contacted' => Enquiry::where('status', EnquiryStatus::Contacted)->count(),
            'in_progress' => Enquiry::where('status', EnquiryStatus::InProgress)->count(),
            'completed' => Enquiry::where('status', EnquiryStatus::Completed)->count(),
            'rejected' => Enquiry::where('status', EnquiryStatus::Rejected)->count(),
            'cancelled' => Enquiry::where('status', EnquiryStatus::Cancelled)->count(),
        ];

        $recentEnquiries = Enquiry::latest()->take(8)->get();

        return view('admin.dashboard', compact('counts', 'recentEnquiries'));
    }
}
