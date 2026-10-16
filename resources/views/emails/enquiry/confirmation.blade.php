@extends('emails.layouts.brand')

@section('title', 'Thank you for contacting '.config('company.name'))
@section('header_label', 'Enquiry Confirmation')

@section('content')
    <h1 style="margin:0 0 14px;font-size:26px;line-height:1.3;color:#0f1f1c;font-weight:800;">
        Thank you, {{ $enquiry->name }}!
    </h1>

    <p style="margin:0 0 14px;font-size:16px;line-height:1.75;color:#3d4f4a;">
        We truly appreciate you contacting
        <strong style="color:#0f6b5c;">{{ config('company.name') }}</strong>.
        Your enquiry has been received successfully.
    </p>

    <p style="margin:0 0 20px;font-size:16px;line-height:1.75;color:#3d4f4a;">
        Our team will carefully review your requirements and
        <strong>send you the details within a day</strong>
        — including pricing and the recommended next steps for your project.
    </p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 22px;background:#f4f7f6;border:1px solid #d5e0dc;border-radius:12px;">
        <tr>
            <td style="padding:18px 20px;">
                <p style="margin:0 0 10px;font-size:13px;font-weight:700;color:#0f6b5c;text-transform:uppercase;letter-spacing:0.06em;">
                    What happens next
                </p>
                <p style="margin:0;font-size:15px;line-height:1.8;color:#3d4f4a;">
                    1. We review your project details<br>
                    2. We prepare a tailored response for your business<br>
                    3. You receive clear pricing and recommendations within one day
                </p>
            </td>
        </tr>
    </table>

    <p style="margin:0 0 10px;font-size:15px;font-weight:700;color:#0f1f1c;">
        Your enquiry summary
    </p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:14px;line-height:1.7;color:#3d4f4a;margin-bottom:14px;">
        <tr>
            <td style="padding:8px 0;border-bottom:1px solid #e8efec;width:120px;"><strong>Business</strong></td>
            <td style="padding:8px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->company ?: '—' }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0;border-bottom:1px solid #e8efec;"><strong>Service</strong></td>
            <td style="padding:8px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->service ?: '—' }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0;border-bottom:1px solid #e8efec;"><strong>Submitted</strong></td>
            <td style="padding:8px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->created_at->format('d M Y, H:i') }}</td>
        </tr>
    </table>

    <div style="margin:0 0 22px;padding:14px 16px;background:#fafcfb;border-left:4px solid #0f6b5c;border-radius:0 8px 8px 0;white-space:pre-wrap;font-size:14px;line-height:1.7;color:#3d4f4a;">{{ $enquiry->message }}</div>

    <p style="margin:0 0 6px;font-size:15px;line-height:1.7;color:#3d4f4a;">
        Need to reach us sooner? We’re always happy to help.
    </p>

    <p style="margin:18px 0 0;font-size:15px;color:#0f1f1c;line-height:1.7;">
        Warm regards,<br>
        <strong style="color:#0f6b5c;">The {{ config('company.name') }} Team</strong>
    </p>
@endsection
