@extends('layouts.app')

@section('content')
<style>
    .back {
        margin-left: 500px;
    }
</style>
<div class="container">
    <form action="/questions/{{$question_id}}" method="get">
        
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
                            <td>A :</td>
                            <td> <input name="a" type="text"> </td>
                        </tr>
                        <tr>
                            <td>B :</td>
                            <td> <input name="b" type="text"> </td>
                        </tr>
                        <tr>
                            <td>C :</td>
                            <td> <input name="c" type="text"> </td>
                        </tr>
                        <tr>
                            <td>D :</td>
                            <td> <input  name="d" type="text"> </td>
                        </tr>
                        
                </table>
                <br>
               
                </div>

                <div class="row">
                    <button class=" col-md-4 btn btn-outline-primary btn-block">Done!</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
      function quay_lai_trang_truoc(){
          history.back();
      }
  </script>

@endsection
