@extends('layouts.app')
@section('css')
<style>
    .col-left{
        border: 1px solid #EDEDED;
        background: #fff;
    }

    .col-right{
        padding: 30px !important;
    }

</style>
@endsection
@section('content')
<div class="">
    <div class="row">
        <div class="col-3 col-left">
            
        </div>
        <div class="col-9 col-right pt-2">
            <h1>POLLING - give us your opinion</h1>
            <div class="d-flex">
                <div class="pr-3">
                    <a href="/surveys/create"><strong>Create new survey</strong></a> | <a href="/surveys/another"><strong>Another surveys</strong></a>
                </div>
                
            </div>
            <div class="your-surveys mt-5">
                <div class="row">
                    <h3>My surveys</h3>
                </div>
                
                <div class="list-survey">
                    @if(isset($surveys))
                        @foreach ($surveys as $survey)
                            <div class="one-survey mb-4 p-2" style="border: 1px solid; width: 400px;">
                                <p class="created-at">Created at: {{$survey->first()->created_at}}</p>
                                <p class="name-survey">Title: {{$survey->first()->name}}</p>
                                <p class="description-survey">Description: {{$survey->first()->description}}</p>
                                <a href="/surveys/{{$survey->first()->id}}">Setting</a> 
                                | <a href="/surveys/{{ $survey->first()->id }}/statistical">Statistical</a> 
                                | <a href="/surveys/{{ $survey->first()->id }}/detail">Detail</a>
                                <div style="position: relative;">
                                    <form action="/surveys/{{$survey->first()->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="row" style="position: absolute; top: -140px; left: 360px;">
                                            <button class="btn btn-danger">X</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
