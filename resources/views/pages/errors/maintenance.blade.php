@extends('layouts.base')

@section('content')
    <div class="d-flex justify-content-center full-height full-width align-items-center" id="maintenanceContainer">
        <div class="error-container text-center">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <img src="{{asset('images/maintenance.png')}}" class="w-100">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4 class="bold all-caps text-primary">The site is currently down for maintenance</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h6 class="semi-bold m-b-5 hint-text m-t-0">Just tidying up a bit. We will be done shortly... so please check back soon!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection