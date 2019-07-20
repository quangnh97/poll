@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfUD35TkfHpgPcH9Ox_xTaNa49f9s-IVZaj2rPjxk0jkxK0ZyA" alt="logo" style="height: 150px">
        </div>
        <div class="col-9 pt-2">
            <h1>POLLING - give us your opinion</h1>
            <div class="d-flex">
                <div class="pr-3">
                    <a href="/home/{{auth()->user()->username}}"><strong>My surveys</strong></a> | <a href="/surveys/another"><strong>Another surveys</strong></a>
                </div>
            </div>
            <div class="mt-5 border border-primary p-5">
                <div class="survey mb-4 p-2 border border-info mx-auto" style="width: 400px;">
                    <h1 class="name-survey text-primary text-center">{{$survey->name}}</h1>
                    <p class="description-survey">Description: {{$survey->description}}</p>
                    <p class="author">Created by: <strong class="p-1 rounded text-light bg-dark">{{$survey->user->username}}</strong></p>
                    <p class="created-at">Created at: <time>{{$survey->created_at}}</time></p>
                </div>
                <div class="list-question row">
                    <table class="table">
                        <form action="/responses" method="post">
                            @csrf
                            @foreach ($survey->questions as $question)
                                <tr>
                                    <td class="pl-5">
                                        <p class="mt-2 text-primary text-left">Question: {{ $question->content}}</p>
                                    </td>
                                    <td class="pr-5">
                                        @if ($question->type == 1)
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="{{ $question->id }}" value="true"> True
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="{{ $question->id }}" value="false"> False
                                                </label>
                                            </div>
                                        @endif

                                        @if ($question->type == 2)
                                            
                                        @endif
                                        
                                        @if ($question->type == 3)
                                            <input required class="border-primary form-control" type="text" name="{{ $question->id }}">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    <button class="btn btn-block btn-outline-primary">Answer</button>
                                </td>
                            </tr>
                        </form>
                    </table>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
