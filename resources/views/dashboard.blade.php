@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @php $user = auth()->user(); @endphp
                    <?php
                     if($user->user_type == 'dealer'){ ?>

                        <form id="address" style="border:1px solid #ccc">

<div class="container">
  <h1>Address</h1>
  
  <hr>

  <label for="state"><b>State</b></label>
  <input type="text" placeholder="Enter State" name="state" id="state" value="{{ $user->state }}" required>

  <label for="state"><b>City</b></label>
  <input type="text" placeholder="Enter City" name="city" id="city" value="{{ $user->city }}" required>

  <label for="zip"><b>Pincode</b></label>
  <input type="text" placeholder="Enter Zip" name="zip" id="zip" value="{{ $user->zip }}" required>
  <input type="hidden" name="id" id="id" value="{{ $user->id}}" required>

  <div class="clearfix">
    
  <button type="submit"  class="signupbtn">Update</button>
  
</div>
</div>
</form>


                    <?php } else { ?>
               
                        <div class="container">
    @if(isset($data))

    <div class="container">
        <form action="/search" method="POST" role="search">
         @csrf
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Search users" value="{{ $sdata }}"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                       search
                    </button>
                </span>
            </div>
        </form>
        <a href="{{'dashboard'}}">clear filter</a>
</div>
    <h2>Sample User details</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $dummy)
                <tr>
                    <td>{{$dummy->first_name}}</td>
                    <td>{{$dummy->last_name}}</td>
                    <td>{{$dummy->email}}</td>
                    <td>{{$dummy->city}}</td>
                    <td>{{$dummy->state}}</td>
                    <td>{{$dummy->zip}}</td>
                    <td>
                    <a type="button" class="btn btn-primary" href="{{url('edit', $dummy->id)}}">Edit</a>
                       
                </td>
                </tr>

                

                
                @endforeach
 
            </tbody>
        </table>
        {!! $data->render() !!}@endif
    </div>


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
