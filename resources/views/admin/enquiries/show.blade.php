@extends('layouts.admin')

@section('title', 'Enquiry #'.$enquiry->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-1">Enquiry #{{ $enquiry->id }}</h1>
        <p class="text-muted mb-0">Submitted {{ $enquiry->created_at->format('d M Y, H:i') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.enquiries.edit', $enquiry) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <h2 class="h5 mb-3">Customer Details</h2>
            <dl class="row mb-0">
                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $enquiry->name }}</dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9"><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></dd>
                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{ $enquiry->phone ?: '—' }}</dd>
                <dt class="col-sm-3">Company</dt>
                <dd class="col-sm-9">{{ $enquiry->company ?: '—' }}</dd>
                <dt class="col-sm-3">Subject</dt>
                <dd class="col-sm-9">{{ $enquiry->subject ?: '—' }}</dd>
                <dt class="col-sm-3">Service</dt>
                <dd class="col-sm-9">{{ $enquiry->service ?: '—' }}</dd>
            </dl>
        </div>

        <div class="admin-card">
            <h2 class="h5 mb-3">Message</h2>
            <p class="mb-0" style="white-space: pre-wrap;">{{ $enquiry->message }}</p>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <h2 class="h5 mb-3">Status</h2>
            <span class="badge {{ $enquiry->status->badgeClass() }} mb-3">
                {{ $enquiry->status->label() }}
            </span>
            <p class="mb-1"><strong>Created:</strong> {{ $enquiry->created_at->format('d M Y, H:i') }}</p>
            <p class="mb-0"><strong>Updated:</strong> {{ $enquiry->updated_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="admin-card mb-4">
            <h2 class="h5 mb-3">Admin Notes</h2>
            <p class="mb-0" style="white-space: pre-wrap;">{{ $enquiry->admin_notes ?: 'No notes yet.' }}</p>
        </div>

        <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100">Delete Enquiry</button>
        </form>
    </div>
</div>
@endsection
