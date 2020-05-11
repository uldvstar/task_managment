@extends('layouts.base_login')

@section('inner_content')
    <div class="row" key="1" v-show="!$store.getters.isShowing('loginSuccess') && !$store.getters.isShowing('forgetPasswordSuccess')">
        <div class="col">
            <transition-component group enter-class="animated fadeInUpBig faster" leave-class="animated fadeOutUpBig">
                <loading-component style="height: 350px;" key="1" color="primary" v-show="$store.getters.isLoading('loginSection')"></loading-component>
                <transition-component key="2" group enter-class="animated fadeInRightBig faster" leave-class="animated fadeOutUpBig" v-show="!$store.getters.isLoading('loginSection')">
                    <div class="row" key="1" v-show="!$store.getters.isShowing('forgetPassword')" >
                        <div class="col all-caps">
                            <div class="row mt-3">
                                <div class="col">
                                    <h6 class="mb-4 text-uppercase animated fadeInDownBig">Login to your account</h6>
                                </div>
                            </div>
                            @if(count($errors))
                            <div class="row mb-3">
                                <div class="col">
                                    <small class="text-warning">{!! $errors->first() !!}</small>
                                </div>
                            </div>
                            @endif
                            <login-form-component section="loginSection"></login-form-component>
                        </div>
                    </div>
                    <div class="row" key="2" v-show="$store.getters.isShowing('forgetPassword')" >
                        <div class="col all-caps">
                            <div class="row mt-5">
                                <div class="col">
                                    <h6 class="mb-2 text-uppercase animated fadeInDownBig">Did you forget your password?</h6>
                                </div>
                            </div>
                            <div class="row mb-3 animated fadeInRightBig slow">
                                <div class="col">
                                    <small class="muted" style="letter-spacing: 2px; ">Enter your email address you're using for your account below<br>and we will send you a password reset link</small>
                                </div>
                            </div>
                            <forget-password-form-component section="loginSection"></forget-password-form-component>
                        </div>
                    </div>
                </transition-component>
            </transition-component>
        </div>
    </div>
    <div class="row align-items-center justify-content-center text-center" key="2" v-show="$store.getters.isShowing('loginSuccess')">
        <div class="col">
            <div class="row mb-3 animated fadeInRightBig">
                <div class="col">
                    <i class="fa fa-user-circle-o animated pulse slower infinite text-primary" style="font-size: 45px;"></i>
                </div>
            </div>
            <div class="row animated fadeInLeftBig" style="height: 50px;">
                <div class="col">
                    <loading-component style="height: 30px;" key="1" color="primary"></loading-component>
                </div>
            </div>
            <div class="row animated fadeInUpBig fast">
                <div class="col">
                    <h5 class="text-uppercase mb-1 text-primary" style="font-size: 20px;">Login Successful</h5>
                </div>
            </div>
            <div class="row animated fadeInUpBig">
                <div class="col">
                    <small class="muted text-uppercase">Please wait for redirect</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-center justify-content-center text-center" key="3" v-show="$store.getters.isShowing('forgetPasswordSuccess')">
        <div class="col-10" style="font-size: 10px;">
            <div class="row mb-3 animated fadeInDownBig">
                <div class="col"><i class="fa fa-lock animated swing slower infinite text-primary" style="font-size: 50px;"></i></div>
            </div>
            <div class="row animated fadeInLeftBig">
                <div class="col">
                    <h5 class="text-uppercase mb-2 text-primary" style="font-size: 20px; letter-spacing: 2px;">reset your password</h5>
                </div>
            </div>
            <div class="row animated fadeInRightBig">
                <div class="col"><small class="text-uppercase" style="letter-spacing: 2px;">we have sent a reset password email to <span class="text-success" v-text="$store.getters.getResetPasswordEmail"></span><br>Please click the reset password link to set your new password.</small></div>
            </div>
            <div class="row mt-3 animated fadeInUpBig slow">
                <div class="col"><small class="text-uppercase" style="letter-spacing: 1px;"><span class="text-danger font-weight-bold mr-1">didn't receive the email yet ?</span> Please check your spam folder, or <span class="text-success  font-weight-bold pointer d-block mt-2" @click="$store.dispatch('toggleSection', {name: 'forgetPasswordSuccess', status: false})">resend the email</span></small></div>
            </div>
            <div class="row mt-5 animated fadeInUpBig slower">
                <div class="col"><small class="text-uppercase" style="letter-spacing: 1px;">Did you remember your password? Go back to <span class="text-underline text-primary bold pointer" @click="$store.dispatch('toggleSection', {name: 'forgetPasswordSuccess', status: false});$store.dispatch('toggleSection', {name: 'forgetPassword', status: false})">login</span></small></div>
            </div>
        </div>
    </div>
@endsection