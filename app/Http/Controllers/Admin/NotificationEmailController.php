<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationEmailController extends Controller
{
    public function index(): View
    {
        $emails = NotificationEmail::query()
            ->orderByDesc('is_active')
            ->orderBy('email')
            ->get();

        return view('admin.notification-emails.index', compact('emails'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:notification_emails,email'],
            'label' => ['nullable', 'string', 'max:255'],
        ]);

        NotificationEmail::query()->create([
            'email' => strtolower($data['email']),
            'label' => $data['label'] ?? null,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.notification-emails.index')
            ->with('success', 'Notification email added successfully.');
    }

    public function update(Request $request, NotificationEmail $notificationEmail): RedirectResponse
    {
        $data = $request->validate([
            'label' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $notificationEmail->update([
            'label' => $data['label'] ?? $notificationEmail->label,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.notification-emails.index')
            ->with('success', 'Notification email updated successfully.');
    }

    public function destroy(NotificationEmail $notificationEmail): RedirectResponse
    {
        $notificationEmail->delete();

        return redirect()
            ->route('admin.notification-emails.index')
            ->with('success', 'Notification email removed successfully.');
    }
}
