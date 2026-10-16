<?php

namespace App\Http\Controllers\Api;

use App\Enums\EnquiryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Mail\EnquiryConfirmationMail;
use App\Mail\NewEnquiryMail;
use App\Models\Enquiry;
use App\Models\NotificationEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EnquiryController extends Controller
{
    public function store(StoreEnquiryRequest $request): JsonResponse
    {
        $data = $request->safe()->except(['website']);

        $enquiry = Enquiry::create([
            ...$data,
            'status' => EnquiryStatus::New,
        ]);

        $this->sendNotifications($enquiry);

        return response()->json([
            'message' => 'Thank you. Your request has been submitted successfully. We will contact you shortly.',
            'enquiry_id' => $enquiry->id,
        ], 201);
    }

    protected function sendNotifications(Enquiry $enquiry): void
    {
        $recipients = NotificationEmail::activeAddresses();

        foreach ($recipients as $recipient) {
            try {
                Mail::to($recipient)->send(new NewEnquiryMail($enquiry));
            } catch (Throwable $e) {
                Log::error('Enquiry admin email failed', [
                    'enquiry_id' => $enquiry->id,
                    'recipient' => $recipient,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        try {
            Mail::to($enquiry->email)->send(new EnquiryConfirmationMail($enquiry));
        } catch (Throwable $e) {
            Log::error('Enquiry confirmation email failed', [
                'enquiry_id' => $enquiry->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
