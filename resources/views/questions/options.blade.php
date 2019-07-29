@extends('layouts.app')

@section('content')
<style>
    .back {
        margin-left: 500px;
    }
</style>
<div class="container">
    <form action="/questions/{{$question_id}}" method="get">
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
                            <td></td>
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
    </form>

</div>
<script>
      function quay_lai_trang_truoc(){
          history.back();
      }
</script>

@endsection
