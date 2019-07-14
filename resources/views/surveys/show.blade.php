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
                        <button class="btn btn-outline-danger btn-block">Change this survey</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="list-question mt-5 d-flex">
        @foreach ($survey->questions as $question)
            <div class="a-question mr-5 p-4 alert alert-success" role="alert" style="border: 1px solid; width: 200px; height: 200px;">
                <p class="alert-heading">Content: {{ $question->content }}</p>
                <p class="mb-0">Type: {{ $question->type }}</p>
            </div>
            <div>
                <form action="/questions/{{ $question }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" style="position:relative; top: 151px; left: -160px;">X</button>
                </form>
            </div>
        @endforeach
        
        <a title="Create new question" class="card-link" href="/questions/create?survey={{ $survey->id }}">
            <img style="height: 100px; position: relative;top: 40px;" src="https://media.istockphoto.com/vectors/plus-add-flat-icon-cross-round-simple-button-circular-vector-sign-vector-id678479260?b=1&k=6&m=678479260&s=170x170&h=eo8IpS4NB_mOtTGvUoGo654RdKCW3C8N_BPif0KX2YQ=" alt="Add new question">
        </a>

    </div>
</div>
@endsection
