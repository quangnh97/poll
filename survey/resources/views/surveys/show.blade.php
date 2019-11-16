@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <form action="/surveys/{{ $survey->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label ">Name of this survey</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $survey->name }}" required autocomplete="name" autofocus>

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
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $survey->description }}" required autocomplete="description" autofocus>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-outline-danger btn-block col-3">Change this survey</button>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="list-question mt-5 d-flex row">
        @foreach ($survey->questions as $question)
            <div class="col-3 a-question mr-5 p-4 alert alert-success" role="alert" style="border: 1px solid;">
                <p class="alert-heading">Content: {{ $question->content }}</p>
                <p class="mb-0">Type: <?php if($question->type == 1 ) echo "True-False";  
                    else if($question->type == 2) echo "Multichoice";
                        else echo "Comment"; ?>
               </p>
                @if($question->type == 2)

                    <form action="/questions/{{ $question->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input  name="content" type="hidden" value="{{ $question->content }}">
                        <input  name="survey_id" type="hidden" value="{{ $survey->id }}">
                        <button class="btn btn-outline-danger btn-block">Create options</button>
                    </form>
                @endif 
                <div class="mt-2">
                    <form action="/questions/{{ $question->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-block" >X</button>
                    </form>
                </div>
            </div>
            
        @endforeach
        <a title="Create new question" class="card-link" href="/questions/create?survey={{ $survey->id }}">
            <img style="height: 100px; position: relative;top: 40px;" src="https://media.istockphoto.com/vectors/plus-add-flat-icon-cross-round-simple-button-circular-vector-sign-vector-id678479260?b=1&k=6&m=678479260&s=170x170&h=eo8IpS4NB_mOtTGvUoGo654RdKCW3C8N_BPif0KX2YQ=" alt="Add new question">
        </a>

    </div>
    <div>   
        <form action="/surveys/{{ $survey->id }}/detail" method="get">
            <button class="btn btn-outline-danger btn-block col-3" style="margin-left: 400px;">Done!</button>
        </form>
    </div>
</div>

@endsection
