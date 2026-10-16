@extends('layouts.app')

@section('title', 'Page Not Found | '.config('company.name'))
@section('meta_description', 'The page you requested could not be found.')

@section('content')
<section class="inner-banner">
    <div class="container text-center">
        <h1>404</h1>
        <p class="mx-auto">Sorry, the page you are looking for could not be found.</p>
        <a href="{{ route('home') }}" class="btn-primary-custom mt-3">Back to Home</a>
    </div>
</section>
@endsection
