<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') | {{ config('company.name') }}</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"></noscript>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">
<div class="admin-wrapper">
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('assets/images/logo/kayacode-icon.svg') }}" alt="Kayacode" width="32" height="32">
                <span>Admin</span>
            </a>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.enquiries.index') }}" class="{{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
                <i class="bi bi-inbox"></i> Enquiries
            </a>
            <a href="{{ route('admin.notification-emails.index') }}" class="{{ request()->routeIs('admin.notification-emails.*') ? 'active' : '' }}">
                <i class="bi bi-envelope-plus"></i> Notification Emails
            </a>
            <a href="{{ route('home') }}" target="_blank" rel="noopener">
                <i class="bi bi-box-arrow-up-right"></i> View Website
            </a>
        </nav>
        <form method="POST" action="{{ route('admin.logout') }}" class="sidebar-logout">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <button type="button" class="btn btn-light d-lg-none" id="sidebarToggle" aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-muted small d-none d-sm-inline">{{ auth()->user()->email }}</span>
                <strong>{{ auth()->user()->name }}</strong>
            </div>
        </header>

        <div class="admin-content">
            <x-alert />
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
<script>
document.getElementById('sidebarToggle')?.addEventListener('click', function () {
    document.getElementById('adminSidebar')?.classList.toggle('open');
});
</script>
@stack('scripts')
</body>
</html>
