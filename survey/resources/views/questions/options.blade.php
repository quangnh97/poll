@extends('layouts.app')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<style>
    .back {
        margin-left: 500px;
    }

    #add-option {
        background: #4FB0AE;
        color: #fff;
    }

    #submit-options {
        margin-left: 300px;
    }
</style>
@endsection

@section('content')

{{-- @php
    $example = '{"option1":"a","option2":"b","option3":"c","option4":"d"}';
    dd(json_decode($example, true));
@endphp --}}
<div class="">
    {{-- <form action="/questions/{{$question_id}}" method="get">
    @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>create options</h1>
                    <button class="back" type="button" onclick="quay_lai_trang_truoc()">Back</button>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label ">Name question:</label>

                    <div class="col-md-6">
                       <p style=" margin-top: 5px;">{{$content}}</p>
                    </div>
                </div>

                <div class="form-group row">
                <table id="myTable" width="100%">
                        <tr>
                            <td> Option A:</td>
                            <td> 
                                <div>
                                    <input name="a" id="a" type="text" class=" @error('a') is-invalid @enderror" required autocomplete="a"> 
                                    @error('a')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror   
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Option B:</td>
                            <td> 
                                <div>
                                    <input name="b" id="b" type="text" class=" @error('b') is-invalid @enderror" required autocomplete="b"> 
                                    @error('b')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror   
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Option C:</td>
                            <td> 
                                <div>
                                    <input name="c" id="c" type="text" class=" @error('c') is-invalid @enderror" required autocomplete="c"> 
                                    @error('c')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror   
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Option D:</td>
                            <td> 
                                <div>
                                    <input name="d" id="d" type="text" class=" @error('d') is-invalid @enderror" required autocomplete="d"> 
                                    @error('d')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror   
                                </div> 
                            </td>
                        </tr>
                        
                </table>
                <br>
               
                </div>

                <div class="row">
                    <button class=" col-md-4 btn btn-outline-primary btn-block">Done!</button>
                </div>
            </div>
        </div>
    </form> --}}


    <div class="content row">
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
                <div class="pr-3">
                <a href="/surveys/create"><strong>Create new survey</strong></a> 
                </div>
            </div>
        </div>
        <div class="col-10 pt-2 col-right ml-0 mr-0 justify-content-center">
            <div class="form-group row">
                <label for="name" class=" col-form-label ">Name question:</label>

                <div class="col-10">
                   <p style=" margin-top: 5px;">{{$content}}</p>
                </div>
            </div>
            <div class="col-8" id="options-box">
                <div class="form-group">
                    <label for="option-1">Option 1: </label>
                    <input type="text" id="option-1" class="js-option form-control">
                </div>
                <div class="form-group">
                    <label for="option-2">Option 2: </label>
                    <input type="text" id="option-2" class="js-option form-control">
                </div>
            </div>
            <div class="col-8 add-option">
                <button class="btn btn-default" id="add-option">
                    <strong class="">
                        <i class="fa fa-plus"></i>&nbsp;Thêm Option
                    </strong>
                </button>
            </div>
            <form action="{{route('store-options')}}" method="POST" class="row ml-0 mr-0" id="add-option-form">
                @csrf
                <input type="hidden" name="question_id" value="{{$question_id}}" id="question-id">
                <input type="hidden" name="options" id="options">
                <button type="button" class="btn btn-primary" id="submit-options">Submit</button>
            </form>
        </div>
    </div>

</div>
<script>
    function quay_lai_trang_truoc(){
        history.back();
    }
    document.querySelector('#add-option').addEventListener('click', function () {
        let optionBox = document.querySelector('#options-box');
        if (optionBox.childElementCount == 10) {
            alert("This question can not has more than 10 options");
            return false;
        }
        let addOptionRow = document.createElement('div');
        addOptionRow.classList.add('form-group');
        let inputId = `option-${optionBox.childElementCount + 1}`;
        // <label for="option_1">Option 1: </label>
        let optionLabel = document.createElement('label');
        optionLabel.setAttribute('for', `${inputId}`);
        optionLabel.innerText = `Option ${optionBox.childElementCount + 1}: `;
        addOptionRow.appendChild(optionLabel);
        // <input type="text" id="option-1" class="js-option form-control">
        let optionInput = document.createElement('input');
        optionInput.setAttribute('type' ,'text');
        optionInput.setAttribute('id' ,`${inputId}`);
        optionInput.classList.add('js-option', 'form-control');
        addOptionRow.appendChild(optionInput);
        optionBox.appendChild(addOptionRow);
    });
    document.querySelector('#submit-options').addEventListener('click', function() {
        let optionValues = [];
        let optionInputs = document.querySelectorAll('.js-option');
        for (let index = 0; index < optionInputs.length; index++) {
            optionValues.push(optionInputs[index].value);
        }
        document.querySelector('#options').value = JSON.stringify(optionValues);
        document.querySelector('#add-option-form').submit();
    })
    document.querySelector('#add-option-form').addEventListener('submit', function () {
        let optionBox = document.querySelector('#options-box');
        if (optionBox.childElementCount > 10) {
            alert("This question can not has more than 10 options");
            return false;
        }
        let options = document.querySelector('#options').value;
        if (options == "") {
            return false;
        }
        let questionId = document.querySelector('#question-id').value;
        if (questionId == "") {
            return false;
        }
        return true;
    });
</script>

@endsection
