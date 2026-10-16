@extends('layouts.admin')

@section('title', 'Enquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-1">Enquiries</h1>
        <p class="text-muted mb-0">Search, filter and manage customer requests</p>
    </div>
</div>

<div class="admin-card mb-4">
    <form method="GET" action="{{ route('admin.enquiries.index') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label for="search" class="form-label">Search</label>
            <input type="text" name="search" id="search" value="{{ $filters['search'] }}"
                   class="form-control" placeholder="Name, email, phone, subject...">
        </div>
        <div class="col-md-2">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All</option>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected($filters['status'] === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="from" class="form-label">From</label>
            <input type="date" name="from" id="from" value="{{ $filters['from'] }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="to" class="form-label">To</label>
            <input type="date" name="to" id="to" value="{{ $filters['to'] }}" class="form-control">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-success flex-fill" style="background:#0f6b5c;border-color:#0f6b5c;">Filter</button>
            <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Service</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($enquiries as $enquiry)
                <tr>
                    <td>#{{ $enquiry->id }}</td>
                    <td>{{ $enquiry->name }}</td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{{ $enquiry->phone ?: 'â€”' }}</td>
                    <td>{{ $enquiry->subject ?: 'â€”' }}</td>
                    <td>{{ $enquiry->service ?: 'â€”' }}</td>
                    <td>
                        <span class="badge {{ $enquiry->status->badgeClass() }}">
                            {{ $enquiry->status->label() }}
                        </span>
                    </td>
                    <td>{{ $enquiry->created_at->format('d M Y, H:i') }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-outline-secondary">View</a>
                        <a href="{{ route('admin.enquiries.edit', $enquiry) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">No enquiries found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $enquiries->links() }}
    </div>
</div>
@endsection

