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
                <div class="pr-3"><a href="#"><strong>Create new survey</strong></a></div>
                <div><a href="#"><strong>See more...</strong></a></div>
            </div>
            <div class="your-surveys">
                <h1>My surveys</h1>
                <div class="list-survey">
                    @foreach ($surveys as $survey)
                        <div class="one-survey mb-4 p-2" style="border: 1px solid; width: 400px;">
                            <p class="created-at">Created at: {{$survey->first()->created_at}}</p>
                            <p class="name-survey">Title: {{$survey->first()->name}}</p>
                            <p class="description-survey">Description: {{$survey->first()->description}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
