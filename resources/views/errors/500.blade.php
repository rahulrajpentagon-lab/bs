@extends('layouts.app')

@section('title', 'Server Error | '.config('company.name'))

@section('content')
<section class="inner-banner">
    <div class="container text-center">
        <h1>500</h1>
        <p class="mx-auto">Something went wrong on our side. Please try again shortly.</p>
        <a href="{{ route('home') }}" class="btn-primary-custom mt-3">Back to Home</a>
    </div>
</section>
@endsection
