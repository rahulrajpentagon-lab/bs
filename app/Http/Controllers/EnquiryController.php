<?php

namespace App\Http\Controllers;

use App\Enums\EnquiryStatus;
use App\Http\Requests\StoreEnquiryRequest;
use App\Mail\EnquiryConfirmationMail;
use App\Mail\NewEnquiryMail;
use App\Models\Enquiry;
use App\Models\NotificationEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class EnquiryController extends Controller
{
    public function create(): View
    {
        return view('frontend.request', [
            'seo' => [
                'title' => 'Request a Quote | Affordable Website Development India',
                'description' => 'Request a quote for affordable professional website development or custom web application development in India. Share your business goals and get a personal reply within one day.',
                'canonical' => route('enquiry.create'),
                'keywords' => implode(', ', [
                    'affordable website development quote India',
                    'website development company India',
                    'custom web application development quote',
                    'affordable websites for businesses',
                ]),
            ],
        ]);
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['website']);

        $enquiry = Enquiry::create([
            ...$data,
            'status' => EnquiryStatus::New,
        ]);

        $this->sendNotifications($enquiry);

        return redirect()
            ->to($request->input('_redirect', route('enquiry.create')).'#contact')
            ->with('success', 'Thank you. Your request has been submitted successfully. We will contact you shortly.');
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
