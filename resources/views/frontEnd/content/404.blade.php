<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') ?? '404 Error' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crope - Multipurpose agency website" />
    <meta name="author" content="George_fx">
    <meta name="keywords" content="" />
    @include('frontEnd/layouts/sections/styles')
</head>

<body>
</body>
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

</html>
