<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationEmailController extends Controller
{
    public function index(): JsonResponse
    {
        $emails = NotificationEmail::query()
            ->orderByDesc('is_active')
            ->orderBy('email')
            ->get()
            ->map(fn (NotificationEmail $email) => [
                'id' => $email->id,
                'email' => $email->email,
                'label' => $email->label,
                'is_active' => (bool) $email->is_active,
                'created_at' => $email->created_at?->toIso8601String(),
            ]);

        return response()->json(['data' => $emails]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:notification_emails,email'],
            'label' => ['nullable', 'string', 'max:255'],
        ]);

        $email = NotificationEmail::query()->create([
            'email' => strtolower($data['email']),
            'label' => $data['label'] ?? null,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Notification email added successfully.',
            'email' => [
                'id' => $email->id,
                'email' => $email->email,
                'label' => $email->label,
                'is_active' => (bool) $email->is_active,
            ],
        ], 201);
    }

    public function update(Request $request, NotificationEmail $notificationEmail): JsonResponse
    {
        $data = $request->validate([
            'label' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $notificationEmail->update([
            'label' => array_key_exists('label', $data) ? $data['label'] : $notificationEmail->label,
            'is_active' => $request->has('is_active')
                ? $request->boolean('is_active')
                : $notificationEmail->is_active,
        ]);

        return response()->json([
            'message' => 'Notification email updated successfully.',
            'email' => [
                'id' => $notificationEmail->id,
                'email' => $notificationEmail->email,
                'label' => $notificationEmail->label,
                'is_active' => (bool) $notificationEmail->is_active,
            ],
        ]);
    }

    public function destroy(NotificationEmail $notificationEmail): JsonResponse
    {
        $notificationEmail->delete();

        return response()->json([
            'message' => 'Notification email removed successfully.',
        ]);
    }
}
