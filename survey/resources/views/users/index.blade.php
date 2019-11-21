@extends('layouts.app')
@section('css')

<style>

    .col-left{
        border: 1px solid #EDEDED;
        background: #fff;
        padding-right: 0px;
    }

    .col-right{
        padding: 30px !important;
    }

    .header-col-left {
        height: 80px;
        padding-top: 32px;
        padding-bottom: 16px;
        padding-left: 24px;
        padding-right: 24px;
        border-bottom: 1px solid #EDEDED;
        
    }

    .bold {
        color: rgb(38, 38, 39);
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
        font-weight: 500;
    }

    .button-add-survey {
        border: 1px solid;
        width: 200px;
        height:200px;
        text-align: center;
        padding: 50px 5px !important;
        background: #4FB0AE;
        color: #fff;
        border-radius: 10px;
        border: 1px solid #4FB0AE;
    }

    .one-survey {
        box-shadow: rgba(0, 0, 0, 0.8) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 2px 12px;
    }

    .c-btn {
        background-color: transparent;
        border-color: #fff;
        color: #898989;
        border: none;
    }

    .c-btn:hover {
        background: #EDEDED;
        color: #898989;

    }

    .function-box {
        background: #fff;
        box-shadow: rgba(0, 0, 0, 0.8) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 2px 12px;
        border-radius: 10px;
        width: 100px;
        height: 100px;
        display: block;
        padding: 10px;
    }
    .delete-survey {
        color: red;
    }

</style>
@endsection

@section('content')
<div class="">
    <div class="row">
        <div class="col-3 col-left">
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
        <div class="col-9 col-right pt-2">
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
                                <p class="created-at">Created at: {{$survey->first()->created_at}}</p>
                                <p class="name-survey">Title: {{$survey->first()->name}}</p>
                                <p class="description-survey">Description: {{$survey->first()->description}}</p>
                                {{-- <a href="/surveys/{{$survey->first()->id}}">Setting</a> 
                                | <a href="/surveys/{{ $survey->first()->id }}/statistical">Statistical</a> 
                                | <a href="/surveys/{{ $survey->first()->id }}/detail">Detail</a> --}}

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
        const deleteSurveyBtn = document.querySelectorAll('.delete-survey');
        const deleteSurveyForm = document.querySelector("#delete-survey-form");
        for (let index = 0; index < deleteSurveyBtn.length; index++) {
            deleteSurveyBtn[index].addEventListener('click', function () {
                let surveyId = this.getAttribute('data-value');
                deleteSurveyForm.setAttribute("action", `/surveys/${surveyId}`);
                deleteSurveyForm.submit();
            });
        }
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
</div>
@endsection
