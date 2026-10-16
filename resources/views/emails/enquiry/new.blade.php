@extends('emails.layouts.brand')

@section('title', 'New Enquiry Received — '.config('company.name'))
@section('header_label', 'New Enquiry Alert')

@section('content')
    <h1 style="margin:0 0 12px;font-size:24px;line-height:1.3;color:#0f1f1c;font-weight:800;">
        New enquiry received
    </h1>

    <p style="margin:0 0 20px;font-size:15px;line-height:1.7;color:#3d4f4a;">
        A new business enquiry was submitted through the
        <strong style="color:#0f6b5c;">{{ config('company.name') }}</strong> website.
        Please review the details below and follow up promptly.
    </p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 20px;background:#f4f7f6;border:1px solid #d5e0dc;border-radius:12px;">
        <tr>
            <td style="padding:18px 20px;">
                <p style="margin:0 0 12px;font-size:13px;font-weight:700;color:#0f6b5c;text-transform:uppercase;letter-spacing:0.06em;">
                    Customer details
                </p>
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:14px;line-height:1.7;color:#3d4f4a;">
                    <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;width:120px;"><strong>Name</strong></td>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;"><strong>Email</strong></td>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;">
                            <a href="mailto:{{ $enquiry->email }}" style="color:#0f6b5c;text-decoration:none;">{{ $enquiry->email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;"><strong>Phone</strong></td>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->phone ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;"><strong>Company</strong></td>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->company ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;"><strong>Subject</strong></td>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->subject ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;"><strong>Service</strong></td>
                        <td style="padding:7px 0;border-bottom:1px solid #e8efec;">{{ $enquiry->service ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:7px 0;"><strong>Submitted</strong></td>
                        <td style="padding:7px 0;">{{ $enquiry->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p style="margin:0 0 8px;font-size:15px;font-weight:700;color:#0f1f1c;">
        Project message
    </p>
    <div style="margin:0 0 24px;padding:14px 16px;background:#fafcfb;border-left:4px solid #0f6b5c;border-radius:0 8px 8px 0;white-space:pre-wrap;font-size:14px;line-height:1.7;color:#3d4f4a;">{{ $enquiry->message }}</div>

    <table role="presentation" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td style="border-radius:8px;background:#0f6b5c;">
                <a href="{{ route('admin.enquiries.show', $enquiry) }}"
                   style="display:inline-block;padding:13px 20px;font-size:14px;font-weight:700;color:#ffffff;text-decoration:none;">
                    View in Admin Panel
                </a>
            </td>
        </tr>
    </table>

    <p style="margin:20px 0 0;font-size:13px;line-height:1.6;color:#6b7c77;">
        Tip: Reply directly to this email to respond to the customer
        (Reply-To is set to {{ $enquiry->email }}).
    </p>
@endsection
