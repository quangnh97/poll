@extends('layouts.app')
@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container content row">
    <div class="col-2 col-left">
        <div class="header-col-left">
            <span class="bold">Workspaces</span>
            <div class="btn-header"></div>
        </div>
        <div class="">
            <div class="pr-3">
                <a href="/home"><strong>My surveys</strong></a>
            </div>
            <div class="pr-3">
                  <a href="/surveys/another" ><strong>Another surveys</strong></a>
            </div>
            <div class="pr-3">
                <a href="/surveys-management" ><strong>Survey management </strong></a>
            </div>
            <div class="pr-3">
                <a href="/acount-management" ><strong>Account management </strong></a>
            </div>
            <div class="pr-3">
                <a href="/system-review" ><strong>Review management</strong></a>
            </div>

            
        </div>
    </div>
    <div class="col-10 pt-2 col-right">
        <form action="/surveys" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Create new survey</h1>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label ">Name of new survey</label>
    
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label ">Description:</label>
    
                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
    
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="row">
                        <button class="btn btn-outline-primary btn-block">Create new survey</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</div>
@endsection
