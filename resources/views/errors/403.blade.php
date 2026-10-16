@extends('layouts.app')

@section('title', 'Forbidden | '.config('company.name'))

@section('content')
<section class="inner-banner">
    <div class="container text-center">
        <h1>403</h1>
        <p class="mx-auto">You do not have permission to access this page.</p>
        <a href="{{ route('home') }}" class="btn-primary-custom mt-3">Back to Home</a>
    </div>
</section>
@endsection
