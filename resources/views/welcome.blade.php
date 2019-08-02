<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poll</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #EEEEEE;
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
                float: left;
                background-color: #FFFFFF;
                width:100%;
                height: 55px;
                position: absolute;
                /*right: 20px;*/
                top: 0px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            

            .links > a {
                border: 3px solid #80bfff;
                border-radius: 3px;
                float: right;
                margin-right: 25px;
                margin-top: 10px;
                width: 80px;
                height: 20px;
                background-color: #80bfff;
                color: green;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-align: center;
                padding-top: 5px;
            }

            .m-b-md {
                float: left;
                font-size: 150px;
                margin-bottom: 30px;
                font-weight: 600;
                color:#4CAF50;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home/' . Auth::user()->username)}}">Home</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif
            <br>
            <div class="content">
                <div class="title m-b-md">
                    POLLING
                </div>
            </div>
        </div>
    </body>
</html>
