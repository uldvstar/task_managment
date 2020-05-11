<!doctype html>
<html lang="en">
<head>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <style>
        body {
            margin: 0 !important;
            padding: 0 !important;
            font-family: 'Lato', sans-serif;
            font-size: 16px;
        }
        .font-lato {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
        }
        .background {
            background-blend-mode: multiply; -webkit-background-size: cover;
            background-size: cover;
            background: #202020 url('https://xyou.co.jp/wp-content/themes/highlight/customizer/sections/images/cropped-hero-3.jpg') no-repeat center center;
        }
        .container {
            width: 600px;
        }
        .sm-hide {
            display: block;
        }
        @media only screen and (max-width: 600px) {
            body {
                font-size: 10px;
            }
            .container {
                width: 100%;
            }
            .sm-hide {
                display: none;
            }
        }
        .content {
            width: 100%;
            padding: 30px;
            box-sizing: border-box;
        }
        a {
            color: #39acf3;
        }
        .btn {
            padding: 15px 2em;
        }
        .bg-primary {
            background-color: #576a3d;
        }
        .bg-white {
            background-color: #FFFFFF;
        }
        .align-center {
            margin: auto;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .w-100 {
            width: 100%;
        }
        .all-caps {
            text-transform: uppercase;
        }
        .hint-text {
            opacity: 0.7;
        }
        .muted {
            color: #9c9c9c;
        }
        .text-white {
            color: #FFFFFF;
        }
        .text-primary {
            color: #576a3d;
        }
        .pointer {
            cursor: pointer;
        }
        .text-complete {
            color: #39acf3;
        }
        .lightest {
            font-weight: 100 !important;
        }
        .light {
            font-weight: 300 !important;
        }
        .normal {
            font-weight: 400 !important;
        }
        .bold {
            font-weight: 700 !important;
        }
        .bolder {
            font-weight: 900 !important;
        }
        .no-border {
            border: none !important;
        }
        .no-padding {
            padding: 0 !important;
        }
        .no-margin {
            margin: 0 !important;
        }
    </style>
</head>
<body>
<div class="w-100">
    <div class="background text-center">
        <div class="sm-hide" style="height: 50px;"></div>
        <div class="container align-center">
            @include('emails.account.layout.header')
            <div class="bg-white text-left">
                <div class="content">
                    @yield('content')
                    <div class="muted all-caps" style="margin-top: 30px; font-size: 0.6em">You're receiving this email because of your account on <a href="https://tick-mee.com" class="bold text-primary" style="margin-left: 5px;">tick-mee.com</a>.</div>

                </div>
            </div>
        </div>
        <div class="text-center text-white all-caps" style="margin-top: 30px;">
            <small style="font-size: 0.6em; letter-spacing: 3px;">&copy;2020 TickMee. All rights reserved</small>
        </div>
        <div style="height: 30px;"></div>
    </div>
</div>
</body>
</html>