@extends('layouts.base')

@section('content')
    <body id="app-container" class="flat menu-sub-hidden show-spinner">
        @include('partials.header')
        @include('partials.menu')
        <main id="app">
            @yield('inner_content')
        </main>
        @include('partials.footer')
    </body>
@endsection