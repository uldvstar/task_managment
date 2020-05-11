@extends('emails.account.layout.base')

@section('content')
    <h4 style="font-size: 1em;">Hello, {{ $user->name}}</h4>
    <p style="font-size: 0.9em">We have received a request to reset the the password for your account.</p>
    <p style="margin-top: 30px; font-size: 0.8em">Click the link below to complete the process. Note that the link expires in 24 hours</p>
    <div style="margin-top: 20px;">
        <a href="{{route('account.password.reset', ['token' => $attempt->token])}}"><button class="btn all-caps bg-primary no-border text-white pointer" style="font-size: 0.8em">Reset password</button></a>
    </div>
    <div class="all-caps hint-text" style="margin-top: 20px;"><small style="font-size: 0.7em">If you didn't perform this request you can safely ignore this email.</small></div>
@endsection