@extends('layouts.app')
@section('script')
    <script src="{{asset('/js/modal.js')}}"></script>

@endsection
@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<link href="{{ asset('css/modal.css') }}" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<style>


* {
  -webkit-box-sizing:border-box;
  -moz-box-sizing:border-box;
  box-sizing:border-box;
}

*:before, *:after {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}

.clearfix {
  clear:both;
}

.text-center {text-align:center;}

a {
  color: tomato;
  text-decoration: none;
}

a:hover {
  color: #2196f3;
}

pre {
display: block;
padding: 9.5px;
margin: 0 0 10px;
font-size: 13px;
line-height: 1.42857143;
color: #333;
word-break: break-all;
word-wrap: break-word;
background-color: #F5F5F5;
border: 1px solid #CCC;
border-radius: 4px;
}

.header {
  padding:20px 0;
  position:relative;
  margin-bottom:10px;
  
}

.header:after {
  content:"";
  display:block;
  height:1px;
  background:#eee;
  position:absolute; 
  left:30%; right:30%;
}

.header h2 {
  font-size:3em;
  font-weight:300;
  margin-bottom:0.2em;
}

.header p {
  font-size:14px;
}



#a-footer {
  margin: 20px 0;
}

.new-react-version {
  padding: 20px 20px;
  border: 1px solid #eee;
  border-radius: 20px;
  box-shadow: 0 2px 12px 0 rgba(0,0,0,0.1);
  
  text-align: center;
  font-size: 14px;
  line-height: 1.7;
}

.new-react-version .react-svg-logo {
  text-align: center;
  max-width: 60px;
  margin: 20px auto;
  margin-top: 0;
}





.success-box {
  margin:2 0px 0;
  padding:10px 10px;
  border:1px solid #eee;
  background:#f9f9f9;
}

.success-box img {
  margin-right:10px;
  display:inline-block;
  vertical-align:top;
}

.success-box > div {
  vertical-align:top;
  display:inline-block;
  color:#888;
}



/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:2.5em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}

</style>
@endsection

@section('content')
<div class=" content">
    <div class="row">
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
        <div class="col-10 pt-2 col-right">
            <h1>POLLING - give us your opinion</h1>
            <div class="d-flex">
                <div class="pr-3">
               <a href="/surveys/another"><strong>Another surveys</strong></a>
                </div>
            </div>
            <div class="mt-5 border border-primary p-5">
                <div class="survey mb-4 p-2 border border-info mx-auto" style="width: 400px;">
                    <h1 class="name-survey text-primary text-center">{{$survey->name}}</h1>
                    <p class="description-survey">Description: {{$survey->description}}</p>
                    <p class="author">Created by: <strong class="p-1 rounded text-light bg-dark">{{$survey->user->username}}</strong></p>
                    <p class="created-at">Created at: <time>{{$survey->created_at}}</time></p>
                </div>
                <div class="list-question row">
                    <table class="table">
                        <form action="/responses" method="post">
                            @csrf
                            @foreach ($questions as $question)
                                <tr>
                                    <td class="pl-5" style="width: 50%">
                                        <div>
                                            <p class="mt-2 text-primary text-left">Question: {{ $question->content}}</p>
                                        </div>
                                    </td>
                                    <td class="pr-5" style="padding-top: 20px;width: 50%;">
                                        @if ($question->type == 1)
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="{{ $question->id }}" value="true"> True
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="{{ $question->id }}" value="false"> False
                                                </label>
                                            </div>
                                        @endif
                                        
                                        @if ($question->type == 2)
                                        @foreach($question->options as $key => $value)
                                            <input type="checkbox" class="q_options" data-value="{{ $value->id }}" value="{{$value->id}}" /> 
                                            {{$value->content_op}} <br>
                                        @endforeach
                                        @endif
                                        
                                        @if ($question->type == 3)
                                            <input required class="border-primary form-control" type="text" name="{{ $question->id }}">
                                        @endif

                                        @if ($question->type == 4)
                                            <section class='rating-widget' style=" width: 100%">
              
                                            <!-- Rating Stars Box -->
                                            <div class='rating-stars text-center'>
                                                
                                              <ul id='stars'>
                                                <li class='star' title='Poor' data-value='1'>
                                                  <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Fair' data-value='2'>
                                                  <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Good' data-value='3'>
                                                  <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Excellent' data-value='4'>
                                                  <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Great' data-value='5'>
                                                  <i class='fa fa-star fa-fw'></i>
                                                </li>
                                              </ul>
                                            </div>
                                            
                                            <div class='success-box'>
                                              <div class='clearfix'></div>
                                              <img alt='tick image' width='32' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K'/>
                                              <div class='text-message'></div>
                                              <div class='clearfix'></div>
                                            </div>
                                          </section>

                                          <input  name="{{ $question->id }}" id="rating" type="hidden" value="">
                                        @endif
                                        @if ($question->type == 5)
                                            <input type="date" id="start" name="{{ $question->id }}"
                                            value="2018-07-22"
                                            min="1000-01-01" max="2050-12-31">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <input type="hidden" id="q-as" name="q_as">
                                <td colspan="2">
                                    <button class="btn btn-block btn-outline-primary">Answer</button>
                                </td>
                            </tr>
                        </form>
                    </table>
                    
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let options = document.querySelectorAll('.q_options');
    for (let index = 0; index < options.length; index++) {
        options[index].addEventListener('click', function () {
            document.querySelector('#q-as').value = document.querySelector('#q-as').value+"_"+this.getAttribute('data-value');
        });
    }
</script>

<script>
    $(document).ready(function(){
      
      /* 1. Visualizing things on Hover - See next part for action on click */
      $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
          if (e < onStar) {
            $(this).addClass('hover');
          }
          else {
            $(this).removeClass('hover');
          }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
          $(this).removeClass('hover');
        });
      });
      
      
      /* 2. Action to perform on click */
      $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
        }
        
        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "You rated this " + ratingValue + " stars.";
            $('#rating').val(ratingValue);
        }
        else {
            msg = "You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);
        
      });
      
      
    });
    
    
    function responseMessage(msg) {
      $('.success-box').fadeIn(200);  
      $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }
    </script>

@endsection
