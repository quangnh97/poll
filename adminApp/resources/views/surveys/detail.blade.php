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
                    <div class="d-flex">
                        <div class="pr-3">
                                <a href="/surveys/another"><strong>Another surveys</strong></a>
                        </div>
                    </div>
            </div>
        <div class="col-10 pt-2 col-right">
            <h1>POLLING - give us your opinion</h1>
            <div class="d-flex">
                <div class="pr-3">
               <a href="/surveys/another"><strong>Another surveys</strong></a>
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
                            @foreach ($questions as $question)
                                <tr>
                                    <td class="pl-5">
                                        <div>
                                            <p class="mt-2 text-primary text-left">Question: {{ $question->content}}</p>
                                        </div>
                                    </td>
                                    <td class="pr-5" style="padding-top: 20px;">
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
                                        @foreach($question->options as $key => $value)
                                            <input type="checkbox" class="q_options" data-value="{{ $value->id }}" value="{{$value->id}}" /> 
                                            {{$value->content_op}} <br>
                                        @endforeach
                                        @endif
                                        
                                        @if ($question->type == 3)
                                            <input required class="border-primary form-control" type="text" name="{{ $question->id }}">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <input type="hidden" id="q-as" name="q_as">
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

<script>
    let options = document.querySelectorAll('.q_options');
    for (let index = 0; index < options.length; index++) {
        options[index].addEventListener('click', function () {
            document.querySelector('#q-as').value = document.querySelector('#q-as').value+"_"+this.getAttribute('data-value');
        });
    }
</script>

@endsection
