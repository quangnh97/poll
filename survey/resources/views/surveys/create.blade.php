@extends('layouts.app')

@section('content')
<div class="container">
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
@endsection
