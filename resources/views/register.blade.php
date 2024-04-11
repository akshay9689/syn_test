<!DOCTYPE html>
<html>
    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}


/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<body>

<form id="register" style="border:1px solid #ccc">

  <div class="container">
    <h1>Register</h1>
    
    <hr>

    <label for="first_name"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="first_name" id="first_name" required>

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="last_name" id="last_name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="password" name="password" required>

    <label for="user_type">User Type</label>
    <select id="user_type" name="user_type" name="user_type">
      <option value="employee">Employee</option>
      <option value="dealer">Dealer</option>
    </select>
       
    <p>Already have a account <a href="{{ url('/') }}" style="color:dodgerblue">Login</a>.</p>

    <div class="clearfix">
      
    <button type="submit"  class="signupbtn">Sign Up</button>
    
 </div>
  </div>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script>

    $(document).ready(function(){
           // adhar card status    
          //  $("#register").on("submit", function(){
            $("form").submit(function(e){
              
                   e.preventDefault(); 
                   
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var user_type = $('#user_type').val();

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
                  url:"{{ route('register') }}",
                  method: 'post',
                  data: {first_name:first_name, last_name:last_name, email:email, password:password, user_type: user_type },
                  
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
      


</body>
</html>
