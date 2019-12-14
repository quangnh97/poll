@extends('layouts.app')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<style>
  .count-people  .count {
    font-size: 50px;
    font-weight: 800;
    position: relative;
    color: #ffffff;
    text-align: center;
    line-height: 92px;
    
  }

  .count-people {
    background-image: url("http://coquan.vn/upload/2000984/anh/h8-background-img.jpg");
  }

  .count-people  .name {
    font-size: 24px;
    color: #fff;
    text-align: center;
    padding-bottom: 20px;
  }

</style>
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-2 col-left">
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

        <div class="col-10 pt-2 col-right">
            <h1>POLLING - give us your opinion</h1>
            <div class="d-flex">
                <div class="pr-3">
                    <a href="/surveys/create"><strong>Create new survey</strong></a> | <a href="/surveys/another"><strong>Another surveys</strong></a>
                </div>
                
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="count-people">
                    <p class="count">{{$number_of_participants}}</p>
                    <p class="name">People who took part in the survey</p>
                </div>
            </div>
            <script>
                $('.count').each(function () {
                    $(this).prop('Counter',0).animate({
                        Counter: $(this).text()
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });
            </script>
            {{-- <canvas id="doughnut-chart" width="800" height="450"></canvas> --}}
            {{--  thống kê các loại câu hỏi --}}
            @foreach ($questions as $question)
            <tr>
                <td class="pl-5">
                    <div>
                        <p class="mt-2 text-primary text-left">Question: {{ $question->content}}</p>
                    </div>
                </td>
                <td class="pr-5" style="padding-top: 20px;">
                    @if ($question->type == 1)
                      <canvas id="doughnut-chart" width="300" height="200"></canvas>
                          <script>
                              new Chart(document.getElementById("doughnut-chart"), {
                              type: 'doughnut',
                              data: {
                                labels: ["true", "flase"],
                                datasets: [
                                  {
                                    label: "Population (millions)",
                                    backgroundColor: ["#3e95cd", "#8e5ea2"],
                                    data: [{{$number_of_participants}},4]
                                  }
                                ]
                              },
                              options: {
                                title: {
                                  display: true,
                                  text: ''
                                }
                              }
                          })
                          </script>
                    @endif
                    
                    @if ($question->type == 2) 
                          
                    @endif
                    
                    @if ($question->type == 3)
                        <input required class="border-primary form-control" type="text" name="{{ $question->id }}">
                    @endif
                    

                </td>
            </tr>
          @endforeach

        </div>
    </div>

</div>

@endsection
