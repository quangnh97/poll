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
            font-size: 25px;">account management</p>
            <table class="table " style="background: #fff;width: 100%;">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                @foreach ($user as $user)

                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->role == 0)
                                User
                            @else
                                Admin
                            @endif
                        </td>
                        <td class="d-flex">
                            <button data-username="{{$user->username}}" data-id="{{$user->id}}" data-role="{{$user->role}}" data-target="edit-box" class="show-modal" style="cursor:pointer" >
                                <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 24px;"></i>
                            </button> 
                          &nbsp;
                            <button data-id="{{$user->id}}" data-role="{{$user->role}}" data-target="delete-box" class="show-modal" style="cursor:pointer" >
                                <i class="fa fa-trash" style="font-size: 24px;"></i>
                            </button> 
                        </td>
                      </tr>
                @endforeach
              </table>
        </div>
    </div>

{{-- edit --}}
<div id="edit-box" class="modal-box">
    <div class="modal-container">
        <div class="modal-title">
            <div class="modal-label">
                Edit role
            </div>
            <div class="close-modal">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </div>
        <div class="modal-content">    
            <form action="/acount-management/{userId}" method='POST' id="form-edit" style="padding: 20px;">
                @csrf
                @method('PUT')
                    <p>User name: <span id="edit-target-user"></span></p>
                    <p><span>Role:</span>
                        <input type="radio" name="role" id="role-{{ config('constants.ADMIN')['value'] }}" value="{{ config('constants.ADMIN')['value'] }}">
                        {{ config('constants.ADMIN')['name'] }}
                        <input type="radio" name="role" id="role-{{ config('constants.USER')['value'] }}" value="{{ config('constants.USER')['value'] }}">
                        {{ config('constants.USER')['name'] }}
                    </p>
                <div style="display: flex;justify-content: center;"><button type="submit" class="btn btn-primary col-4 btn-primary">Update</button></div>
            </form>
        </div>
    </div>

    <script>
        
    </script>
</div>

<!-- delete -->
<div id="delete-box" class="modal-box">
    <div class="modal-container">
        <div class="modal-title">
            <div class="modal-label">
                Delete user
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

        if (targetId == 'edit-box') {
            let currentRole = $(this).attr('data-role');
            $(`#role-${currentRole}`).attr('checked', 'checked');
            let username = $(this).attr('data-username');
            $('#edit-target-user').text(username);
            let userId = $(this).attr('data-id');
            $('#form-edit').attr('action', `/acount-management/${userId}`);
        }

        if (targetId == 'delete-box') {
            let userId = $(this).attr('data-id');
            $('#form-delete').attr('action', `/acount-management/${userId}`);
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
