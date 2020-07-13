<!doctype html>
<html lang="en">
<head>
    <title>{{session()->get('w')->name}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{session()->get('w')->description}}" />
    <meta name="keywords" content="" />
    <meta name="author" content="{{session()->get('w')->name}}" />
    @include('layouts.jobs.styles')
    @yield('css')
</head>
<body id="top">
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="site-wrap">
    <!-- NAVBAR -->
@include('layouts.jobs.nav')
    @yield('content')
    @include('layouts.jobs.footer')
</div>
<!-- SCRIPTS -->
@include('layouts.jobs.scripts')
@yield('js')
</body>
</html>