@extends('layouts.app')

@section('title', 'Page Expired | '.config('company.name'))

@section('content')
<section class="inner-banner">
    <div class="container text-center">
        <h1>419</h1>
        <p class="mx-auto">Your session has expired. Please refresh and try again.</p>
        <a href="{{ url()->previous() }}" class="btn-primary-custom mt-3">Go Back</a>
    </div>
</section>
@endsection
