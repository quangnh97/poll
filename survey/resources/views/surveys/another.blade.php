@extends('layouts.app')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class=" content">
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
                                <a href="/surveys/another"><strong>Another surveys</strong></a>
                        </div>
                    </div>
            </div>
        <div class="col-9 pt-2">

            <div class="your-surveys mt-5">
                <div class="row">
                    <h3>Another surveys</h3>
                </div>
                
                <div class="list-survey d-flex">
                    @foreach ($surveys as $survey)
                        <div class="one-survey mb-4 p-2" style="border: 1px solid; width: 400px;">
                            <p class="created-at">Created at: {{$survey->created_at}}</p>
                            <p class="name-survey">Title: {{$survey->name}}</p>
                            <p class="description-survey">Description: {{$survey->description}}</p>
                            <a href="/surveys/{{$survey->id}}/start">Start this survey</a>
                        </div>    
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
