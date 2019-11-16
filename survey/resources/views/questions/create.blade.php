@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/questions?survey={{ request()->survey }}" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Create new question</h1>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label ">Content of new question: </label>

                    <div class="col-md-6">
                        <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required autocomplete="content" autofocus>

                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label ">Type:</label>

                    <div class="col-md-6">
                        <select name="type" id="type">
                            <option value="#">Type</option>
                            <option value="1">1 - True || False</option>
                            <option value="2">2 - Multichoice</option>
                            <option value="3">3 - Comment</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-outline-primary btn-block">Create new question</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
