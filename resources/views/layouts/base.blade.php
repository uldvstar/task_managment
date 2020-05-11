<!doctype html>
<html lang="en">
<head>
    @include('vendor/head')
</head>
@yield('content')
@include('vendor/js')
@stack('scripts')
</html>