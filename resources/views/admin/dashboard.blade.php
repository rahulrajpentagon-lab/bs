@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-1">Dashboard</h1>
        <p class="text-muted mb-0">Enquiry overview and recent activity</p>
    </div>
    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-success" style="background:#0f6b5c;border-color:#0f6b5c;">
        View All Enquiries
    </a>
</div>

<div class="row g-3 mb-4">
    @foreach ([
        ['label' => 'Total Enquiries', 'value' => $counts['total'], 'icon' => 'bi-inbox'],
        ['label' => 'New', 'value' => $counts['new'], 'icon' => 'bi-bell'],
        ['label' => 'Contacted', 'value' => $counts['contacted'], 'icon' => 'bi-telephone'],
        ['label' => 'In Progress', 'value' => $counts['in_progress'], 'icon' => 'bi-hourglass-split'],
        ['label' => 'Completed', 'value' => $counts['completed'], 'icon' => 'bi-check-circle'],
        ['label' => 'Rejected', 'value' => $counts['rejected'], 'icon' => 'bi-x-circle'],
        ['label' => 'Cancelled', 'value' => $counts['cancelled'], 'icon' => 'bi-slash-circle'],
    ] as $tile)
        <div class="col-6 col-md-4 col-xl-3">
            <div class="stat-tile">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span>{{ $tile['label'] }}</span>
                    <i class="bi {{ $tile['icon'] }} text-success"></i>
                </div>
                <h3>{{ $tile['value'] }}</h3>
            </div>
        </div>
    @endforeach
</div>

<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Recent Enquiries</h2>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Service</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($recentEnquiries as $enquiry)
                <tr>
                    <td>#{{ $enquiry->id }}</td>
                    <td>
                        <strong>{{ $enquiry->name }}</strong><br>
                        <small class="text-muted">{{ $enquiry->email }}</small>
                    </td>
                    <td>{{ $enquiry->service ?: 'â€”' }}</td>
                    <td>
                        <span class="badge {{ $enquiry->status->badgeClass() }}">
                            {{ $enquiry->status->label() }}
                        </span>
                    </td>
                    <td>{{ $enquiry->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-outline-secondary">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No enquiries yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

