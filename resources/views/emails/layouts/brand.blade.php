<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', config('company.name'))</title>
</head>
<body style="margin:0;padding:0;background:#e8efec;font-family:Arial,Helvetica,sans-serif;color:#0f1f1c;-webkit-text-size-adjust:100%;">
@php
    $logoUrl = asset('assets/images/logo/kayacode-logo.jpg');
    $company = config('company.name');
    $tagline = config('company.tagline');
    $phone = config('company.phone');
    $email = config('company.email');
    $whatsapp = config('company.whatsapp');
    $location = config('company.location');
    $siteUrl = config('app.url');
@endphp

<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#e8efec;padding:32px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:640px;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #d5e0dc;">

                {{-- HEADER --}}
                <tr>
                    <td style="background:#0f6b5c;padding:0;">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td style="padding:28px 28px 18px;text-align:center;background:linear-gradient(135deg,#0f6b5c 0%,#0a4f44 100%);">
                                    <a href="{{ $siteUrl }}" style="text-decoration:none;">
                                        <img
                                            src="{{ $logoUrl }}"
                                            alt="{{ $company }}"
                                            width="190"
                                            style="display:block;margin:0 auto 12px;max-width:190px;width:100%;height:auto;border:0;">
                                    </a>
                                    <p style="margin:0;font-size:20px;font-weight:800;color:#ffffff;letter-spacing:0.2px;">
                                        {{ $company }}
                                    </p>
                                    <p style="margin:8px 0 0;font-size:13px;line-height:1.5;color:#c9ebe2;">
                                        {{ $tagline }}
                                    </p>
                                </td>
                            </tr>
                            @hasSection('header_label')
                                <tr>
                                    <td style="background:#0a4f44;padding:10px 28px;text-align:center;">
                                        <p style="margin:0;font-size:12px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9fd9c6;">
                                            @yield('header_label')
                                        </p>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>

                {{-- BODY --}}
                <tr>
                    <td style="padding:32px 28px 24px;background:#ffffff;">
                        @yield('content')
                    </td>
                </tr>

                {{-- CONTACT STRIP --}}
                <tr>
                    <td style="padding:0 28px 28px;background:#ffffff;">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f4f7f6;border:1px solid #d5e0dc;border-radius:12px;">
                            <tr>
                                <td style="padding:18px 20px;">
                                    <p style="margin:0 0 10px;font-size:13px;font-weight:700;color:#0f6b5c;text-transform:uppercase;letter-spacing:0.06em;">
                                        Contact {{ $company }}
                                    </p>
                                    <p style="margin:0;font-size:14px;line-height:1.8;color:#3d4f4a;">
                                        <strong>Email:</strong>
                                        <a href="mailto:{{ $email }}" style="color:#0f6b5c;text-decoration:none;">{{ $email }}</a><br>
                                        <strong>Phone:</strong> {{ $phone }}<br>
                                        <strong>WhatsApp:</strong>
                                        <a href="https://wa.me/{{ $whatsapp }}" style="color:#0f6b5c;text-decoration:none;">Chat with us</a><br>
                                        <strong>Location:</strong> {{ $location }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td style="background:#0f1f1c;padding:24px 28px;text-align:center;">
                        <p style="margin:0 0 8px;font-size:15px;font-weight:700;color:#ffffff;">
                            {{ $company }}
                        </p>
                        <p style="margin:0 0 14px;font-size:13px;line-height:1.6;color:#9fb3ad;">
                            Affordable website development &amp; custom web applications for businesses across India.
                        </p>
                        <p style="margin:0 0 14px;font-size:13px;line-height:1.7;">
                            <a href="{{ $siteUrl }}" style="color:#8fc9bb;text-decoration:none;margin:0 8px;">Website</a>
                            <span style="color:#445854;">|</span>
                            <a href="{{ $siteUrl }}/request" style="color:#8fc9bb;text-decoration:none;margin:0 8px;">Get a Quote</a>
                            <span style="color:#445854;">|</span>
                            <a href="mailto:{{ $email }}" style="color:#8fc9bb;text-decoration:none;margin:0 8px;">Email Us</a>
                        </p>
                        <p style="margin:0;font-size:12px;color:#6f857f;">
                            &copy; {{ date('Y') }} {{ $company }}. All rights reserved.<br>
                            This email was sent by {{ $company }}.
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
