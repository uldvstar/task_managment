@extends('layouts.base_login')

@section('inner_content')
    <div class="row" key="1" v-show="!$store.getters.isShowing('resetPasswordSuccess')">
        <div class="col">
            <transition-component group enter-class="animated fadeInUpBig faster" leave-class="animated fadeOutUpBig">
                <loading-component style="height: 350px;" key="1" color="primary" v-show="$store.getters.isLoading('resetPasswordSection')"></loading-component>
                <div class="row" key="2" v-show="!$store.getters.isLoading('resetPasswordSection')" >
                    <div class="col all-caps">
                        <div class="row mt-3">
                            <div class="col">
                                <h6 class="mb-4 text-uppercase animated fadeInDownBig">Reset your password</h6>
                            </div>
                        </div>
                        <reset-password-form-component section="loginSection" token="{{$token}}"></reset-password-form-component>
                    </div>
                </div>
            </transition-component>
        </div>
    </div>
    <div class="row align-items-center justify-content-center text-center" key="3" v-show="$store.getters.isShowing('resetPasswordSuccess')">
        <div class="col-10" style="font-size: 10px;">
            <div class="row mb-3 animated fadeInDownBig">
                <div class="col"><i class="fa fa-check-circle animated swing slower infinite text-primary" style="font-size: 50px;"></i></div>
            </div>
            <div class="row animated fadeInLeftBig">
                <div class="col">
                    <h5 class="text-uppercase mb-2 text-primary" style="font-size: 20px; letter-spacing: 2px;">Password Changed</h5>
                </div>
            </div>
            <div class="row animated fadeInRightBig">
                <div class="col"><small class="text-uppercase" style="letter-spacing: 2px;">Your password has been changed successfully</div>
            </div>
            <div class="row mt-3 animated fadeInUpBig slow">
                <div class="col">
                    <a :href="route('login')" @click="$store.dispatch('toggleSection', {name: 'resetPasswordSuccess', status: false});$store.dispatch('toggleLoading', {name: 'resetPasswordSection', status: true})">
                        <div class="btn btn-outline-secondary pointer">Go to login</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection