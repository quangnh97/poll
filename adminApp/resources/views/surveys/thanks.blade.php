@extends('layouts.app')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="content">
        <div class="row">
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
                <h1>POLLING - give us your opinion</h1>
                <div class="d-flex">
                    <div class="pr-3">
                        <a href="/surveys/create"><strong>Create new survey</strong></a> | <a href="/surveys/another"><strong>Another surveys</strong></a>
                    </div>
                    
                </div>
                <div class="col-6"><h1 class="text-primary">Thanks for your response !!!</h1></div>
            </div>
        </div>
    
    </div>
@endsection
