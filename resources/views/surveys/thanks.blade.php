@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/home/{{ auth()->user()->username }}">My homepage</a>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-6"><h1 class="text-primary">Thanks for your response !!!</h1></div>
        <div class="col-2"></div>
    </div>
    
</div>
@endsection
