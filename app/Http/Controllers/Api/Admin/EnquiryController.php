<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\EnquiryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $enquiries = Enquiry::query()
            ->search($request->string('search')->toString())
            ->status($request->string('status')->toString())
            ->submittedBetween(
                $request->string('from')->toString() ?: null,
                $request->string('to')->toString() ?: null,
            )
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return response()->json([
            'data' => collect($enquiries->items())->map(fn (Enquiry $enquiry) => $this->transform($enquiry))->values(),
            'meta' => [
                'current_page' => $enquiries->currentPage(),
                'last_page' => $enquiries->lastPage(),
                'per_page' => $enquiries->perPage(),
                'total' => $enquiries->total(),
            ],
            'filters' => [
                'search' => $request->string('search')->toString(),
                'status' => $request->string('status')->toString(),
                'from' => $request->string('from')->toString(),
                'to' => $request->string('to')->toString(),
            ],
            'statuses' => EnquiryStatus::options(),
        ]);
    }

    public function show(Enquiry $enquiry): JsonResponse
    {
        return response()->json([
            'enquiry' => $this->transform($enquiry, true),
            'statuses' => EnquiryStatus::options(),
        ]);
    }

    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry): JsonResponse
    {
        $enquiry->update($request->validated());

        return response()->json([
            'message' => 'Enquiry status updated successfully.',
            'enquiry' => $this->transform($enquiry->fresh(), true),
        ]);
    }

    public function destroy(Enquiry $enquiry): JsonResponse
    {
        $enquiry->delete();

        return response()->json([
            'message' => 'Enquiry deleted successfully.',
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function transform(Enquiry $enquiry, bool $detailed = false): array
    {
        $data = [
            'id' => $enquiry->id,
            'name' => $enquiry->name,
            'email' => $enquiry->email,
            'phone' => $enquiry->phone,
            'company' => $enquiry->company,
            'subject' => $enquiry->subject,
            'service' => $enquiry->service,
            'status' => $enquiry->status instanceof EnquiryStatus
                ? $enquiry->status->value
                : $enquiry->status,
            'status_label' => $enquiry->status instanceof EnquiryStatus
                ? $enquiry->status->label()
                : (string) $enquiry->status,
            'created_at' => $enquiry->created_at?->toIso8601String(),
            'updated_at' => $enquiry->updated_at?->toIso8601String(),
        ];

        if ($detailed) {
            $data['message'] = $enquiry->message;
            $data['admin_notes'] = $enquiry->admin_notes;
        }

        return $data;
    }
}
