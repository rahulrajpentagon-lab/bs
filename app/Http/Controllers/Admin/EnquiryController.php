<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EnquiryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function index(Request $request): View
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

        return view('admin.enquiries.index', [
            'enquiries' => $enquiries,
            'statuses' => EnquiryStatus::options(),
            'filters' => [
                'search' => $request->string('search')->toString(),
                'status' => $request->string('status')->toString(),
                'from' => $request->string('from')->toString(),
                'to' => $request->string('to')->toString(),
            ],
        ]);
    }

    public function show(Enquiry $enquiry): View
    {
        return view('admin.enquiries.show', [
            'enquiry' => $enquiry,
            'statuses' => EnquiryStatus::options(),
        ]);
    }

    public function edit(Enquiry $enquiry): View
    {
        return view('admin.enquiries.edit', [
            'enquiry' => $enquiry,
            'statuses' => EnquiryStatus::options(),
        ]);
    }

    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry): RedirectResponse
    {
        $enquiry->update($request->validated());

        return redirect()
            ->route('admin.enquiries.show', $enquiry)
            ->with('success', 'Enquiry status updated successfully.');
    }

    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry deleted successfully.');
    }
}
