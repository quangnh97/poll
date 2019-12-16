@extends('layouts.app')
@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<link href="{{ asset('css/modal.css') }}" rel="stylesheet">
<style>
    .one-survey a p {
        font-size: 16px;
        color: #000;
    }

    .one-survey a:hover {
        text-decoration: none;
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
                      <a href="/surveys/another" ><strong>Another surveys</strong></a>
                </div>
                <div class="pr-3">
                    <a href="/surveys-management" ><strong>Survey management </strong></a>
                </div>
                <div class="pr-3">
                    <a href="/acount-management" ><strong>Account management </strong></a>
                </div>
                <div class="pr-3">
                    <a href="/system-review" ><strong>Review management</strong></a>
                </div>

                
            </div>
        </div>
        <div class="col-10 col-right pt-2">
            <!-- <h1>POLLING - give us your opinion</h1> -->

            <div class="your-surveys">
                <div class="row">
                    <h3 style="margin-left: 20px; margin-bottom: 20px;">My workspace</h3>
                </div>
                
                <div class="button-add-survey mb-4 p-2">
                    <a style=" color: #fff; font-size: 20px;" href="/surveys/create">   
                        <div style="padding-bottom: 20px;">
                            <i class="fa fa-plus" style="font-size: 25px;"></i>
                        </div>
                        <strong>New survey</strong>
                    </a>
                </div>
             
                <div class="list-survey">
                    @if(isset($surveys))
                        @foreach ($surveys as $key => $survey)
                        
                            <div class="one-survey mb-4 p-2" style="border: 1px solid #fff; width: 300px;">
                                <a href="/surveys/{{$survey->first()->id}}">
                                    <p class="created-at">Created at: {{$survey->first()->created_at}}</p>
                                    <p class="name-survey">Title: {{$survey->first()->name}}</p>
                                    <p class="description-survey">Description: {{$survey->first()->description}}</p>
                                    {{-- <a href="/surveys/{{$survey->first()->id}}">Setting</a> 
                                    | <a href="/surveys/{{ $survey->first()->id }}/statistical">Statistical</a> 
                                    | <a href="/surveys/{{ $survey->first()->id }}/detail">Detail</a> --}}
                                </a>
                                <div style="position: relative;">
                                        <div class="row" style="position: absolute; top: -120px; left: 270px;">
                                        <button type="button" class="btn c-btn" id="c-btn" data-key="{{$key}}">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <div class="function-box box-{{$key}} d-none">
                                                <div data-value="{{$survey->first()->id}}" class="delete-survey">
                                                    Delete
                                                </div>
                                                <div>
                                                    <a href="/surveys/{{$survey->first()->id}}">Setting</a>
                                                </div>
                                                <div>
                                                    <a href="/surveys/{{ $survey->first()->id }}/statistical">Statistical</a> 
                                                </div>
                                                <div>
                                                    <a href="/surveys/{{ $survey->first()->id }}/detail">Detail</a> 
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                
                            </div>
                        
                        @endforeach
                    <form action="/surveys/" id="delete-survey-form" method="post">
                        @csrf
                        @method("DELETE")
                    </form>
                    @endif
                </div>
            </div>
            
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
        // const deleteSurveyForm = document.querySelector("#delete-survey-form");

        // for (let index = 0; index < deleteSurveyBtn.length; index++) {
        //     // bắt sự kiện nhấn nút xóa
        //     deleteSurveyBtn[index].addEventListener('click', function () {
        //         // id của survey can xóa đặt trong attribute data-value
        //         // lấy giá trị data-value vào trong biến surveyId
        //         let surveyId = this.getAttribute('data-value');
        //         // thay đổi action của form
        //         deleteSurveyForm.setAttribute("action", `/surveys/${surveyId}`);
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

<!-- delete -->
<div id="delete-box" class="modal-box" > 
    <div style="background-color:#fff;width:400px;height:200px;position:relative">
        <i class="fa fa-times close-delete-box" aria-hidden="true" style="color: #e3342f;position:absolute;right:4px;top:2px;font-size: x-large;"></i>
        <div style="background-color: #FAFAFA;color:#000;font-weight:600;padding:5px 15px" id="edit-ietm-title">
            Delete the survey
        </div>
        <div id="edit-ietm-content">
            <form action="/surveys/" id="delete-question-form" method="post" style="padding:20px">
                <h4 class="modal-title" style="text-align: center;">Are you sure?</h4>
                <button  type="button" class="btn btn-info close-delete-box"  aria-hidden="true" style="margin-left: 60px;margin-top: 20px;">Cancel</button>
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
                let surveyId = this.getAttribute('data-value');
                document.querySelector('#delete-question-form').setAttribute('action',`/surveys/${surveyId}`)
            });
        }
        
        let closeDelBoxs = document.querySelectorAll('.close-delete-box');
        for (let index = 0; index < closeDelBoxs.length; index++) {
            closeDelBoxs[index].addEventListener('click', function () {
                document.querySelector('#delete-box').style.display = 'none';
            });
        }
        
    
    </script>
</div>



@endsection
