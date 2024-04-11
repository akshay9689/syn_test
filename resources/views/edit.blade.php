@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}  <a style="float:right" href="/dashboard">home</a></div>
               
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @php $user = auth()->user(); @endphp
                    <?php
                     if($user->user_type == 'employee'){ ?>

                        <form id="address" style="border:1px solid #ccc">

<div class="container">
  <h1>Address  </h1>
  <h6>user: {{ $data->email}} - {{ $data->first_name." ".$data->last_name}}</h6>
  <hr>

  <label for="state"><b>State</b></label>
  <input type="text" placeholder="Enter State" name="state" id="state" value="{{ $data->state }}" required>

  <label for="state"><b>City</b></label>
  <input type="text" placeholder="Enter City" name="city" id="city" value="{{ $data->city }}" required>

  <label for="zip"><b>Pincode</b></label>
  <input type="text" placeholder="Enter Zip" name="zip" id="zip" value="{{ $data->zip }}" required>
  <input type="hidden" name="id" id="id" value="{{ $data->id}}" required>

  <div class="clearfix">
    
  <button type="submit"  class="signupbtn">Update</button>
  
</div>
</div>
</form>


                    <?php } ?>
               
                        
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script>

    $(document).ready(function(){
           // adhar card status    
          //  $("#register").on("submit", function(){
            $("#address").submit(function(e){
              
                   e.preventDefault(); 
                   
                var state = $('#state').val();
                var city = $('#city').val();
                var zip = $('#zip').val();
                var id = $('#id').val();
                
                $.ajax({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url:"{{ route('address') }}",
                  method: 'post',
                  data: {state:state, city:city,zip:zip,id:id },
                  
                  success: function(response){
                  
                    if (response.errors) {
            var errorMsg = '';
            $.each(response.errors, function(field, errors) {
                $.each(errors, function(index, error) {
                    errorMsg += error + '<br>';
                });
            });
            iziToast.error({
                message: errorMsg,
                position: 'topRight'
            });
            
        } else {
           iziToast.success({
           message: response.success,
           position: 'topRight'
           
                 });
        }
                     
                  
                  }
                });
              
        });
            });
      
             </script>

@endsection
