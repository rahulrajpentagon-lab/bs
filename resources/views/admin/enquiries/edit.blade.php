@extends('layouts.admin')

@section('title', 'Edit Enquiry #'.$enquiry->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-1">Update Enquiry #{{ $enquiry->id }}</h1>
        <p class="text-muted mb-0">Update status and admin notes only</p>
    </div>
    <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-outline-secondary">Back</a>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="admin-card">
            <form method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $enquiry->status->value) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="admin_notes" class="form-label">Admin Notes</label>
                    <textarea name="admin_notes" id="admin_notes" rows="8"
                              class="form-control @error('admin_notes') is-invalid @enderror"
                              placeholder="Internal notes about this enquiry...">{{ old('admin_notes', $enquiry->admin_notes) }}</textarea>
                    @error('admin_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success" style="background:#0f6b5c;border-color:#0f6b5c;">
                    Save Changes
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="admin-card">
            <h2 class="h5 mb-3">Original Enquiry</h2>
            <p><strong>{{ $enquiry->name }}</strong><br>{{ $enquiry->email }}</p>
            <p><strong>Company:</strong> {{ $enquiry->company ?: 'â€”' }}</p>
            <p><strong>Service:</strong> {{ $enquiry->service ?: 'â€”' }}</p>
            <p class="mb-0" style="white-space: pre-wrap;">{{ $enquiry->message }}</p>
        </div>
    </div>
</div>
@endsection

