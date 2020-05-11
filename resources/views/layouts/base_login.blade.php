@extends('layouts.base')

@section('content')
<body class="background no-footer">
    <div class="fixed-background"></div>
    <main id="app">
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="col-5 image-side position-relative animated">
                            <div class="row">
                                <div class="col">
                                    <p class="text-white h3 text-uppercase font-weight-bold mb-3 animated fadeInDownBig">TickMee</p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col">
                                    <p class="text-white h5 text-uppercase animated fadeInLeftBig" style="letter-spacing: 2px;">office assistance</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="white mb-0 animated fadeInUp delay-1s" style="line-height: 26px;letter-spacing: 2px;">
                                        Automate the Boring Stuff, do in<br>  minutes what would take you hours<br> to do by hand; it makes the boring fun.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col form-side">
                            @yield('inner_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
@endsection