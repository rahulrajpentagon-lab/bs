@extends('layouts.admin')

@section('title', 'Notification Emails')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-1">Notification Emails</h1>
        <p class="text-muted mb-0">Add multiple addresses to receive enquiry details</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="admin-card">
            <h2 class="h5 mb-3">Add Email Address</h2>
            <form method="POST" action="{{ route('admin.notification-emails.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="name@example.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="label" class="form-label">Label (optional)</label>
                    <input type="text" name="label" id="label" value="{{ old('label') }}"
                           class="form-control @error('label') is-invalid @enderror"
                           placeholder="Sales / Founder / Support">
                    @error('label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success" style="background:#0f6b5c;border-color:#0f6b5c;">
                    Add Email
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="admin-card">
            <h2 class="h5 mb-3">Active Recipients</h2>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Label</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($emails as $item)
                        <tr>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->label ?: '—' }}</td>
                            <td>
                                @if ($item->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <form method="POST" action="{{ route('admin.notification-emails.update', $item) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="label" value="{{ $item->label }}">
                                    <input type="hidden" name="is_active" value="{{ $item->is_active ? 0 : 1 }}">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        {{ $item->is_active ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.notification-emails.destroy', $item) }}" class="d-inline"
                                      onsubmit="return confirm('Remove this notification email?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No notification emails yet. Add at least one address.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <p class="small text-muted mb-0">
                When a visitor submits an enquiry, all <strong>active</strong> emails receive the enquiry details.
            </p>
        </div>
    </div>
</div>
@endsection
