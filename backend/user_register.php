<?php 
include('../inc/partials/header.php');
$currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../propertyManagement/"><b>Real</b>Estate</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new User</p>

      <form method="post" name="signup-form" id="affiliate_signup_form">
        <div class="input-group mb-3">
          <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <span id="userFirstName-info" class="info"></span>
        <div class="input-group mb-3">
          <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <span id="userPhone-info" class="info"></span>

        
        <div class="input-group mb-3">
          <input type="email"  name="user_email" id="user_email"  class="form-control" placeholder="Email"  onchange= "emailExists(this.value);">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <span id="userEmail-info" class="info"></span>
        <div class="input-group mb-3">
          <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span id="userPassword-info" class="info"></span>
       
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <span id="userTerms-info" class="info"></span>
          <!-- /.col -->
          <div class="col-4">
              <input type="hidden" name="email_exists_field" id="email_exists_field" value="0">
            <button type="submit" id="submit" name="register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="<?php echo $domain_url ?>/user_login.php" class="text-center">I already have an Account</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<script type="text/javascript">
  $(document).ready(function() {
      $('#submit').click(function(e){
        e.preventDefault();

        var first_name = $("#first_name").val();
        first_name_result = firstNameValid(first_name);

        var phone = $("#phone").val();
        phone_result = phoneValid(phone);
        
        /*var email = $("#user_email").val();
        emailExists(email);*/
        var email_result_val = $("#email_exists_field").val();
        if(email_result_val == '1'){
         var   email_result = true;
        }else if(email_result == '0'){
          var  email_result = false;
        }
        var password =  $("#user_password").val();
        password_result =  isPasswordValid(password);

        //checkbox validation
        var checkbox_terms_result = false;
        if (document.getElementById('agreeTerms').checked) {
            $("#userTerms-info").html("");
            document.getElementById("agreeTerms").setAttribute("style","border-color: ");
            checkbox_terms_result = true;
        } else {
            $("#userTerms-info").html("Please check the terms and conditions");
            document.getElementById("agreeTerms").setAttribute("style","border-color: red");
            checkbox_terms_result = false;
        }

if(first_name_result && phone_result && email_result && password_result&& checkbox_terms_result){
    var myform = document.getElementById("affiliate_signup_form");
    var fd = new FormData(myform );

    $.ajax({
        url: "user_login_register_ajax.php?register_user_data=true",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
           // alert(dataofconfirm);
           if(dataofconfirm=='successfully')
           {
             alert( 'Thank you for registration');
            window.location.replace('<?php echo $domain_url ?>/user_login.php');
           }
           
        }
    });
}else{
   // alert("Do not enter user data");
}

      });
  });

//Validation for first Name
function firstNameValid(first_name){
    var valid = false;
    if(!first_name) {
        $("#userFirstName-info").html("Name Required");
        document.getElementById("first_name").style.borderColor = "red";
        valid = false;
    }else if(!first_name.match(/^(?=.{1,50}$)[a-z]+(?:['_.\s][a-z]+)*$/i)){
        $("#userFirstName-info").html("Invalid Name");
        document.getElementById("first_name").style.borderColor = "red";
     valid = false;
    }else{
        $("#userFirstName-info").html("");
        document.getElementById("first_name").style.borderColor = "";
        valid = true;
    }
    return valid;
}
//Validation for phone
function phoneValid(phone){
    var valid = false;
    if(!phone) {
        $("#userPhone-info").html("Phone Required");
        document.getElementById("phone").style.borderColor = "red";
        valid = false;
    }
    else if(!phone.match(/^\d{3}-?\d{3}-?\d{4}$/)){
        $("#userPhone-info").html("Invalid Phone");
        document.getElementById("phone").style.borderColor = "red";
        valid = false;
    }else{
         $("#userPhone-info").html("");
        document.getElementById("phone").style.borderColor = "";
        valid = true;

}
return valid;
}
//validation for email field
function emailExists(email){
   var valid = false ; 
      if(email == ''){
        document.getElementById("user_email").style.borderColor = "red";
        $("#userEmail-info").html("Plese Enter Email Address");
        $("#email_exists_field").val('0');
          valid = false ;
      }else{
          $.post('user_login_register_ajax.php?register_email_verify=true',
      { 
        'email': email
      },
      function (response, status) {
         
       if(response == '1'){
        document.getElementById("user_email").style.borderColor = "red";
        $("#userEmail-info").html("Email Already exists");
        $("#email_exists_field").val('0');
        valid = false;
       }else if(response == '0'){
        document.getElementById("user_email").style.borderColor = "";
        $("#userEmail-info").html("");
       // $("#userEmail-info").html("continue enter");
        $("#email_exists_field").val('1');
        valid = true;
       }
      }
    );
      }
 // alert(valid);
      return valid;
  }
  //Validation for password field
  function isPasswordValid(input) {
    var valid = false;
  if (!hasUpperCase(input)) {
    $("#userPassword-info").html("The password requires a capital letter.");
    console.log('The password requires a capital letter.');
    valid = false;
  }
  else if (!hasLowerCase(input)) {
    $("#userPassword-info").html("The password requires a lower case letter.");
    console.log('The password requires a lower case letter.');
    valid = false;
  }
  else if (!isLongEnough(input)) {
    $("#userPassword-info").html("The password is not long enough.");
    console.log('The password is not long enough.');
    valid = false;
  }
  else if (!hasSpecialCharacter(input)) {
    $("#userPassword-info").html("The password requires a special character.");
    console.log('The password requires a special character.');
    valid = false;
  }   
  else if (hasUpperCase(input) && hasLowerCase(input) && isLongEnough(input) && hasSpecialCharacter(input)){
    $("#userPassword-info").html("");
    console.log('The password is valid.');
    valid = true;
  } 
  return valid;
}

function hasUpperCase(input) {
 for(var i = 0; i < input.length; i++){
   if(input[i] === input[i].toUpperCase()){
     return true;
// How do we validate that it's not a number or a special Character?
   }
 } 
}

function hasLowerCase(input) {
 for(var i = 0; i < input.length; i++){
   if(input[i] === input[i].toLowerCase()){
     return true;
   }
 } 
}

function isLongEnough(input) {
    var minLength = 8;
  if(input.length >= minLength){
    return true;
  }
}

function hasSpecialCharacter(input){
var specialCharacters = "!@#$%^&*,()-+%";
  for(var i =0; i < input.length; i++){
    for(var j = 0; j < specialCharacters.length; j++){
      if(input[i] === specialCharacters[j]){
        return true;
      }
    }
  }
}
</script>
<style>
  .info{
    color:red;
  }
  </style>

<?php include('../inc/partials/footer.php') ?>