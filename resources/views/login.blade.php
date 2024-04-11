<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
</head>
<body>

<h2>Login <span class="psw">Not have account. <a href="{{ url('register') }}">Register?</a></span></h2>

<form>
  
  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
    <button type="submit">Login</button>
    
  </div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script>

    $(document).ready(function(){
           // adhar card status    
          //  $("#register").on("submit", function(){
            $("form").submit(function(e){
              
                e.preventDefault(); 
                   
               
                var email = $('#email').val();
                var password = $('#password').val();
               

               //  alert(user_type);
                
                function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
                }

               if( !isEmail(email)) { alert("wrong email"); }
                else {
                 //alert("email is ok"); 
                }

                $.ajax({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url:"{{ route('login') }}",
                  method: 'post',
                  data: {email:email, password:password },
                  
                  success: function(response){
                  
                    if (response.suc) {
           
            iziToast.success({
                message: "login success",
                position: 'topRight'
            });

            var delay = 3000; 
            setTimeout(function(){ window.location = '/dashboard'; }, delay);
            
        } else {
           iziToast.error({
           message: response.err,
           position: 'topRight'
           
                 });
        }
                     
                  
                  }
                });
              
        });
            });
      
             </script>
      




</body>
</html>
