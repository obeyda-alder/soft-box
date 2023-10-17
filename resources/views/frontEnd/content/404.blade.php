@extends('frontEnd/layouts/master')

@section('content')
    <div class="error-page">
        <div class="container">
            <div class="error-content">
                <h2>OMG!</h2>
                <h3>You broke the site!</h3>
                <p>Don’t worry. It’s just 404 page not found.</p>
                <h4>Please try Search or go back to <a href="{{ route('web:home') }}" title="">Homepage.</a></h4>
            </div>
        </div>
    </div>
@endsection
