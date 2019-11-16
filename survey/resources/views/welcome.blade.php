<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poll</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('css/wellcome.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
        <!-- Styles -->
        <style>
        
        </style>
    </head>
    <body>
        <div class="">
            @if (Route::has('login'))
                <div class="top-right links clearfix">
                    <h1 class="logo-name">Survey-UET</h1>
                    @auth
                        <a href="{{ url('/home/' . Auth::user()->username)}}">Home</a>
                    @else
                        @if (Route::has('register'))
                            <a class="sign-up" href="{{ route('register') }}">Sign up</a>
                        @endif
                        <a class="" href="{{ route('login') }}">Log in</a>
                    @endauth
                </div>
            @endif
            <br>
            <div class="content row clearfix" style="height:500px;">
                <div class="col-lg-5 col-left">
                <!-- <img src="https://www.typeform.com/_next/static/images/coffee_berry-4ed4cd5749ebe3a48890a6955b0a48ce.jpg" alt=""> -->
                </div>
                <div class="col-lg-7">
                    <div>
                        <h1>Forms & surveys for the people</h1>
                        <span>The most important online interaction for a business is the exchange of information. Don’t leave it to chance.</span>
                    </div>
                </div>
            </div>
            <div class="footer"> 
                <p>© Copyright by UET | Provided by UETer</p>
            </div>
        </div>
    </body>
</html>
