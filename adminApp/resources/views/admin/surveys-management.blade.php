@extends('layouts.app')
@section('script')
    <script src="{{asset('/js/modal.js')}}"></script>
@endsection
@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<link href="{{ asset('css/modal.css') }}" rel="stylesheet">
<style>
    .modal-box {
        height: 500px;
    }

    .modal-content {

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
            <p style="    text-transform: uppercase;
            text-align: center;
            font-weight: bold;
            font-size: 25px;">Surveys management</p>
            <table class="table " style="background: #fff;width: 100%;">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Survey name</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Action</th>
                    </tr>
                @foreach ($surveys as $survey)

                      <tr>
                        <td>{{$survey->id}}</td>
                        <td>{{$survey->name}}</td>
                        <td>{{$survey->username}}</td>
                        <td class="d-flex">
                            <button class="show-modal" style="cursor:pointer">
                                <a href="/surveys/{{ $survey->id }}/statistical" style="color: #000;"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 24px;"></i> </a> 
                            </button>   
                            &nbsp;
                            <button class="show-modal" style="cursor:pointer">
                            <a href="/surveys/{{ $survey->id }}/detail" style="color: #000;"><i class="fa fa-eye" aria-hidden="true" style="font-size: 24px;"></i> </a> 
                            </button>   
                            &nbsp;
                            <button data-id="{{$survey->id}}" data-target="delete-box" class="show-modal" style="cursor:pointer" >
                                <i class="fa fa-trash" style="font-size: 24px;"></i>
                            </button> 
                        </td>
                      </tr>
                @endforeach
              </table>
        </div>
    </div>


<!-- delete -->
<div id="delete-box" class="modal-box">
    <div class="modal-container">
        <div class="modal-title">
            <div class="modal-label">
                Delete surveys
            </div>
            <div class="close-modal">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </div>
        <div class="modal-content">  
            <form action="" method='POST' id="form-delete" style="padding: 20px;">
                @csrf
                <h4 class="modal-title" style="text-align: center;">Are you sure?</h4>
                <button  type="button" class="btn btn-info close-delete-box"  aria-hidden="true" style="margin-left: 60px;margin-top: 20px;">Cancel</button>
                @csrf
                @method("DELETE")
                <button type="submit" class="btn col-4 btn-danger" style="margin-top: 20px;">Delete</button>
            </form>
        </div>
    </div>
</div>
<script>
    $('.show-modal').click(function () {
        let targetId = $(this).attr('data-target');
        $(`#${targetId}`).show();

        if (targetId == 'delete-box') {
            let userId = $(this).attr('data-id');
            $('#form-delete').attr('action', `/surveys-management/${userId}`);
        }

        let closeDelBoxs = document.querySelectorAll('.close-delete-box');
        for (let index = 0; index < closeDelBoxs.length; index++) {
            closeDelBoxs[index].addEventListener('click', function () {
                document.querySelector('#delete-box').style.display = 'none';
            });
        }
    });
</script>

@endsection
