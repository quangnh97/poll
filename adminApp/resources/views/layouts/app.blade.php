<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Opinion Investigation</title>
    <link rel="icon" href="https://i.vimeocdn.com/portrait/18778258_300x300">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- boostrap 4 --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/wellcome.css') }}" rel="stylesheet">
    @yield('css')
    <style>
        body {
            background-color: #ecf0f1;
            color: #192a56;
        }
        .polling{
            margin-top: 5px;
            border: 3px solid  #80bfff;
            border-radius: 3px;
            background-color: #80bfff;
            width: 90px;
            height: 40px;
            color: green;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            text-align: center;
            padding-top: 7px;
        }
        .nav-link{
            float: right;
            margin-right: 10px;
            margin-top: 5px;
            border: 1px solid  #B9DFDF;
            border-radius: 3px;
            background-color: #80bfff;
            width: 95px;
            height: 40px;
            color: green;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            text-align: center;
            padding-top: 7px;
        }
        .one-survey{
            float: left;
            margin-right: 25px;
            background-color:#ffffff;
            border: 5px solid  blue;
            border-radius: 10px;
        }

        .nav-item {
            border: 1px solid #000;
            border-radius: 3px;
            float: right;
            margin-right: 25px;
            margin-top: 0px;
            width: 80px;
            height: 40px;
            background-color: #fff;
            color: #000;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .1rem;
            text-decoration: none;
            text-align: center;
            line-height: 40px;
        }

        .btn-login {
            /* margin-right: -100px; */
        }

        .container-header {
            max-width: 1600px;
        }

        .a-login {
            color: #000;
        }

        .a-sign-up {
            background: #000;
            color: #fff;
        }

        .a-user-name {
            border: 1px solid #000;
            border-radius: 5px;
            float: right;
            margin-right: 25px;
            margin-top: 0px;
            width: 200px;
            height: 40px;
            background-color: #fff;
            color: #000 !important;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .1rem;
            text-decoration: none;
            text-align: center;
            
        }

        .a-user-name:hover {
            background: #ECF0F1;
        }

        .content {
            min-height: 500px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container container-header">
                <a class="navbar-brand" href="{{ url('/home') }}">
                <h1 class="logo-name">Survey-UET</h1> 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto btn-login">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="a-login" href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item a-sign-up">
                                    <a class="a-sign-up" href="{{ route('register') }}">Sign up</a>
                                </li>
                            @endif
                        @else
   
                            <li class="nav-item1 dropdown">
                                <a  id="navbarDropdown" class="nav-link dropdown-toggle a-user-name" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ substr(Auth::user()->username,0,6) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class=" main-content">
            @yield('content')
        </main>
    </div>

    <div class="footer"> 
        <p>© Copyright by UET | Provided by UETer</p>
    </div>
    
</body>
</html>
