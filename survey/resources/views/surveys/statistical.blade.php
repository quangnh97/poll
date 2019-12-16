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
  .question {
    margin-bottom: 30px;
  }

  .question-name {
    position: relative;
    font-size: 1.7em;
    font-weight: 400;
    max-width: 700px;
    padding-left: 20px;
    padding-right: 20px;
  }

  .survey_detail {
    background: #1B7B57;
    padding: 20px;
    margin-bottom: 10px;
    font-size: 1.7em;
    font-weight: 400;
    color: #fff;
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
                <div class="">
                  <div class="pr-3">
                      <a href="/home"><strong>My surveys</strong></a>
                  </div>
                  <div class="pr-3">
                        <a href="/surveys/another" ><strong>Another surveys</strong></a>
                  </div>  
              </div>
        </div>

        <div class="col-10 pt-2 col-right">
            <div class="col-lg-12 col-xs-12">
                <div class="survey_detail ">
                    <p class="">Survey name:   <span>{{$survey->name}}</span> </p>
                    <p class="">Description: <span>{{$survey->description }}</span></p>
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
            <script>
              let chosen;
              let options;
              let answer;
            </script>
            @foreach ($questions as $key => $question)            
                <script>
                    chosen = [];
                    options = [];
                </script>
                <div class="row question">
                  <div class="col-lg-5">
                      <p class="mt-2 question-name text-left">Question: {{ $question->content}}</p>
                  </div>
    
                  <div class="col-lg-7">

                    @if ($question->type == 1)
                        <div class="col-lg-8"><canvas id="doughnut-chart-{{$key}}" ></canvas></div>
                        <script>
                            answer = {!! json_encode($question->answer) !!};
                            for (let index = 0; index < answer.length; index++) {
                              chosen.push(answer[index].chosen);
                            }
                            new Chart(document.getElementById("doughnut-chart-"+{{$key}}), {
                            type: 'doughnut',
                            data: {
                              labels: ["true", "flase"],
                              datasets: [
                                {
                                  label: "",
                                  backgroundColor: ["#3e95cd", "#8e5ea2"],
                                  data: chosen,
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
                    @else
                        @if ($question->type == 4)
                        <canvas id="bar-chart-{{$key}}" width="800" height="450"></canvas>
                        <script>
                          answer = {!! json_encode($question->answer) !!};
                          for (let index = 0; index < answer.length; index++) {
                            options.push(answer[index].answer);
                            chosen.push(answer[index].chosen);
                          }
                          // for (let index = 0; index < answer.length; index++) {
                          //   chosen.push(answer[index].chosen);
                          // }
                          new Chart(document.getElementById("bar-chart-"+{{$key}}), {
                              type: 'bar',
                              data: {
                                labels: options,
                                datasets: [
                                  {
                                    label: "",
                                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#4A0E0E", "#E1E6EC", "#FC3F0D", "#F807C2","#05FBF2"],
                                    data: chosen,
                                  }
                                ]
                              },
                              options: {
                                legend: { display: false },
                                title: {
                                  display: true,
                                  text: ''
                                }
                              }
                          });
                        </script> 
                        @else
                            @if ($question->type == 3 || $question->type == 5)
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>User name</th>
                                  <th>Answer</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($question->answer as $answer)
                                  <tr>
                                    <td>{{ $answer->username }}</td>
                                    <td>{{ $answer->answer}}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @else
                               @if ($question->type == 2)
                               <canvas id="pie-chart-{{$key}}" width="800" height="450"></canvas>
                               <script>
                                 answer = {!! json_encode($question->answer) !!};
                                  for (let index = 0; index < answer.length; index++) {
                                    options.push(answer[index].answer);
                                    chosen.push(answer[index].chosen);
                                  }
                                 new Chart(document.getElementById("pie-chart-"+{{$key}}), {
                                   type: 'pie',
                                   data: {
                                     labels: options,
                                     datasets: [{
                                       label: "",
                                       backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#4A0E0E", "#E1E6EC", "#FC3F0D", "#F807C2","#05FBF2"],
                                       data: chosen,
                                     }]
                                   },
                                   options: {
                                     title: {
                                       display: true,
                                       text: ''
                                     }
                                   }
                               });
                               </script>
                               @endif 
                            @endif
                        @endif
                    @endif
                  </div>
                </div>
              
            @endforeach

        </div>
    </div>

</div>

@endsection