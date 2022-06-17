<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{isset($title) ? $title : "EMAIL - LOCAL"}}</title>
        <link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/login-register.css")}}">
        <link rel="stylesheet" href="{{asset("css/style.css")}}">
        <link rel="stylesheet" href="{{asset('plugins/alertifyjs/css/alertify.css')}}">
        @livewireStyles()
        @yield("style")
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
       @yield("content")
    </body>
    @livewireScripts()
    <script src="{{asset("jquery/jquery.min.js")}}"></script>
    <script src="{{asset("bootstrap/js/bootstrap.bundle.js")}}"></script>
    <script src="{{asset("bootstrap/js/popper.min.js")}}"></script>
    <script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>
    <script src="{{asset('plugins/alertifyjs/alertify.js')}}"></script>
    <script src="{{asset("js/index.js")}}"></script>
    @yield("script")
</html>
