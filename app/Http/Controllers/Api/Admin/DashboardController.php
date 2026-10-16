<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\EnquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
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

        $recentEnquiries = Enquiry::latest()
            ->take(8)
            ->get()
            ->map(fn (Enquiry $enquiry) => $this->transformEnquiry($enquiry));

        return response()->json([
            'counts' => $counts,
            'recent_enquiries' => $recentEnquiries,
            'statuses' => EnquiryStatus::options(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function transformEnquiry(Enquiry $enquiry): array
    {
        return [
            'id' => $enquiry->id,
            'name' => $enquiry->name,
            'email' => $enquiry->email,
            'phone' => $enquiry->phone,
            'company' => $enquiry->company,
            'subject' => $enquiry->subject,
            'service' => $enquiry->service,
            'status' => $enquiry->status?->value ?? $enquiry->status,
            'status_label' => $enquiry->status instanceof EnquiryStatus
                ? $enquiry->status->label()
                : (string) $enquiry->status,
            'created_at' => $enquiry->created_at?->toIso8601String(),
        ];
    }
}
