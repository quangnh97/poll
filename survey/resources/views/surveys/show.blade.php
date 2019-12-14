@extends('layouts.app')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <style>

        .detail-survey {
            background: #1B7B57;
            padding: 20px;
        }

        .button-creat-options {
            border: none;
            background: unset;
        }

        .button-add-question {
            border: 1px solid;
            width: 280px;
            height: 133px;
            text-align: center;
            padding: 30px 5px !important;
            background: #4FB0AE;
            color: #fff;
            border-radius: 10px;
            border: 1px solid #4FB0AE;
            box-shadow: rgba(0, 0, 0, 0.8) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 2px 12px;
        }

        .one-survey {
            height: 133px;
        }

        .function-box {
            z-index: 20;
        }

    </style>
@endsection

@section('content')
    <div class=" content row">
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

    <div class="col-10 pt-2 col-right">
        <form action="/surveys/{{ $survey->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="row detail-survey">
                <div class="col-8 offset-2 ">
                    <div class="form-group row">
                        <label for="name" style="color: #fff;" class="col-md-4 col-form-label ">Name of this survey</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $survey->name }}" required autocomplete="name" autofocus>
                            {{-- @error('name') is-invalid @enderror --}}
                            {{-- @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" style="color: #fff;" class="col-md-4 col-form-label ">Description:</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ $survey->description }}" required autocomplete="description" autofocus>
                            {{-- @error('description') is-invalid @enderror  --}}
                            {{-- @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-6"><button class="btn btn-block col-6 btn-primary " style="color: #fff; ">Change this survey</button></div>
                        
                    </div>
                </div>
            </div>
        </form>
        <div class="list-question mt-5 d-flex row">
                @foreach ($survey->questions as $key => $question)
                    <div class="col-3 a-question mr-5 p-4 alert alert-success one-survey" role="alert" style="border: 1px solid;">
                        Content: <span class="alert-heading qc-{{$question->id}}">{{ $question->content }}</span>
                        <p class="mb-0">Type: <?php if($question->type == 1 ) echo "True-False";  
                            else if($question->type == 2) echo "Multichoice";
                                else echo "Comment"; ?>
                       </p>

                        <div style="position: relative;">
                                <div class="row" style="position: absolute; top: -70px; left: 240px;">
                                    <button type="button" class="btn c-btn" id="c-btn" data-key="{{$key}}">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="function-box box-{{$key}} d-none">
                                        <div data-value="{{$question->id}}" class="delete-survey" style="cursor:pointer">
                                            Delete
                                        </div>
                                        <div class="edit-question" data-id="{{ $question->id }}" style="cursor:pointer">
                                            <!--edit needed--> Edit
                                        </div>
                                    </div>
                                </div>
                        </div>

                        @if($question->type == 2)
        
                            <form action="/questions/{{ $question->id }}/options" method="post">
                                @csrf
                                <input  name="content" type="hidden" value="{{ $question->content }}">
                                <input  name="survey_id" type="hidden" value="{{ $survey->id }}">
                                <button class="btn btn-block btn-primary ">Create options</button>
                            </form>
                        @endif 


                        {{-- <div class="mt-2">
                            <form action="/questions/{{ $question->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary btn-block" >X</button>
                            </form>
                        </div> --}}
                    </div>
                @endforeach
            
                <div class="button-add-question mb-4 p-2">
                        <a style=" color: #fff; font-size: 20px;" href="/questions/create?survey={{ $survey->id }}">   
                            <div style="padding-bottom: 20px;">
                                <i class="fa fa-plus" style="font-size: 25px;"></i>
                            </div>
                            <strong>Create new question</strong>
                        </a>
                    </div>
        
            </div>
            <div>   
                <form action="/surveys/{{ $survey->id }}/detail" method="get">
                    <button class="btn btn-primary btn-block col-3" style="margin-left: 400px;">Done!</button>
                </form>
            </div>
    </div>

    <script>
            let boxInDisplay = -1;
            const customBtn = document.querySelectorAll(".c-btn");
            for (let index = 0; index < customBtn.length; index++) {
                customBtn[index].addEventListener('click', function (e) {
                    let functionBox = document.querySelector(`.box-${this.getAttribute('data-key')}`);
                    let isHidden = functionBox.classList.contains('d-none');
                    if (isHidden) {
                        if (boxInDisplay == -1) {
                            boxInDisplay = this.getAttribute('data-key');
                        } else {
                            document.querySelector(`.box-${boxInDisplay}`).classList.add('d-none');
                            boxInDisplay = this.getAttribute('data-key');
                        }
                        functionBox.classList.remove('d-none');
                    } else {
                        functionBox.classList.add('d-none');
                    }
                    e.stopPropagation();
                });
            }
            // const deleteSurveyBtn = document.querySelectorAll('.delete-survey');
            // const deleteSurveyForm = document.querySelector("#delete-question-form");
            // for (let index = 0; index < deleteSurveyBtn.length; index++) {
            //     deleteSurveyBtn[index].addEventListener('click', function () {
            //         let surveyId = this.getAttribute('data-value');
            //         deleteSurveyForm.setAttribute("action", `/questions/${surveyId}`);
            //         deleteSurveyForm.submit();
            //     });
            // }
            document.querySelector("#app").addEventListener('click', function (e) {
                for (let index = 0; index < customBtn.length; index++) {
                    let functionBox = document.querySelector(`.box-${customBtn[index].getAttribute('data-key')}`);
                    let isHidden = functionBox.classList.contains('d-none');
                    if (!isHidden) {
                        functionBox.classList.add('d-none');
                    }
                }
            });
        </script>

<div id="edit-box" style="position:absolute;width:100%;height:100%;background-color:#a8a8a896;display:none;justify-content:center;align-items:center;left:0px;z-index:20">
    <div style="background-color:#fff;width:400px;height:400px;position:relative">
        <i class="fa fa-times" id="close-edit-box" aria-hidden="true" style="color:#000;position:absolute;right:4px;top:2px;font-size: x-large;"></i>
        <div style="background-color: #FAFAFA;color:#000;font-weight:600;padding:5px 15px" id="edit-ietm-title">
            Edit the question
        </div>
        <div id="edit-ietm-content">    
            <form action="/questions/" method='POST' id="form-edit-question">
                <br> <br>
                @csrf
                @method('PUT')
                <div class="">
                    <label for="name" class="col-10 col-form-label ">Question name</label>

                    <div class="col-11">
                        <input type="text" class="form-control" id="e-question-content" name="content" value="" autofocus>
                    </div>
                </div>
                {{-- <input type="hidden" id="e-question-id" name="question_id" value=""> --}}
                
                <button type="submit" class="btn btn-block col-4 btn-primary" style="margin-left: 15px;
                margin-top: 15px;">Update</button>
            </form>
        </div>
    </div>
    <script>
        // lấy tất cả các nút edit có class là edit-question
        let editQuestionBtns = document.querySelectorAll('.edit-question');
        for (let index = 0; index < editQuestionBtns.length; index++) {
            editQuestionBtns[index].addEventListener('click', function () {
                document.querySelector('#edit-box').style.display = 'flex';
                document.querySelector('#form-edit-question').setAttribute('action', `/questions/${this.getAttribute('data-id')}`);
                // document.querySelector('#e-question-id').value= this.getAttribute('data-id');
                let contentPlaceClass = '.qc-'+this.getAttribute('data-id');
                console.log(contentPlaceClass);
                document.querySelector('#e-question-content').value=document.querySelector(contentPlaceClass).innerText;
            });
        }
        document.querySelector('#close-edit-box').addEventListener('click', function () {
            document.querySelector('#edit-box').style.display = 'none';
        });

    </script>
</div>


<!-- delete -->
<div id="delete-box" style="position:absolute;width:100%;height:100%;background-color:#a8a8a896;display:none;justify-content:center;align-items:center;left:0px;z-index:20"> 
    <div style="background-color:#fff;width:400px;height:200px;position:relative">
        <i class="fa fa-times" id="close-delete-box" aria-hidden="true" style="color: #e3342f;position:absolute;right:4px;top:2px;font-size: x-large;"></i>
        <div style="background-color: #FAFAFA;color:#000;font-weight:600;padding:5px 15px" id="edit-ietm-title">
            Delete the question
        </div>
        <div id="edit-ietm-content">
            <form action="/questions/" id="delete-question-form" method="post" style="padding:20px">
                <h4 class="modal-title" style="text-align: center;">Are you sure?</h4>
                <button  type="button" class="btn btn-info" id="close-delete-box"  aria-hidden="true" style="margin-left: 60px;margin-top: 20px;">Cancel</button>
                @csrf
                @method("DELETE")
                <button type="submit" class="btn col-4 btn-danger" style="margin-top: 20px;">Delete</button>
            </form>
        </div>
    </div>
    
    <script>
        // nut delete
        let deleteQuestionBtns = document.querySelectorAll('.delete-survey');
        for (let index = 0; index < deleteQuestionBtns.length; index++) {
            deleteQuestionBtns[index].addEventListener('click', function () {
                document.querySelector('#delete-box').style.display = 'flex';
                let questionId = this.getAttribute('data-value');
                document.querySelector('#delete-question-form').setAttribute('action',`/questions/${questionId}`)
            });
        }
        document.querySelector('#close-delete-box').addEventListener('click', function () {
            document.querySelector('#delete-box').style.display = 'none';
        });
    
    </script>
</div>
@endsection
