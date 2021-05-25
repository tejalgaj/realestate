<?php include('../inc/partials/header.php');
$currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../propertyManagement/"><b>Real</b>Estate</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form  method="post" id="frmUserLogin" name="frmUserLogin">
      <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
        <div class="input-group mb-3">
          <input type="email" id="user_name" name="user_name" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" class="form-control" placeholder="Email" onchange= "checkUsername(this.value);">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <span id="username_error_message" class="info"></span>
        <div class="input-group mb-3">
          <input type="password" name="user_password" id="user_password" value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>" class="form-control" placeholder="Password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="user_remember" id="user_remember" value="remeber_me" style="display:none" >
              <label for="remember" style="display:none">
                Remember Me
              </label>

              <input type="checkbox" id="user_remember" name="user_remember" value="remeber_me" <?php if(isset($_COOKIE["user_login"])) { ?> checked
                <?php } ?> >
<label for="vehicle1">  Remember Me</label><br>
            </div>
          </div>
          <span id="login_error_message" class="info"></span>
          <!-- /.col -->
          <div class="col-4">
         <input type="hidden" name="form_submit_valid" id="form_submit_valid" value ="0">
            <button type="submit" id="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
              </form>
      

      
      <p class="mb-0">
        <a href="<?php echo $domain_url ?>/user_register.php" class="text-center">Register a new User</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script type="text/javascript">
$(document).ready(function() {
  $('#submit').click(function(e){
    e.preventDefault();

    var myform = document.getElementById("frmUserLogin");
    var fd = new FormData(myform );

    //var entered_email = $("#user_name").val();
    //checkUsername(entered_email);



    var username_valid = $("#form_submit_valid").val();
    if(username_valid == '1'){
      $.ajax({
        url: "user_login_register_ajax.php?formsubmit=true",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
          if( dataofconfirm == '1'){
            var redirect_url = '<?php echo $domain_url ?>';
window.location.replace(redirect_url+"/list_property.php");
          }else{
            document.getElementById("user_name").style.borderColor = "red";
            document.getElementById("user_password").style.borderColor = "red";
          $("#login_error_message").html("Invalid User name or Password");
          }
        }
    });
    }else{
      document.getElementById("user_name").style.borderColor = "red";
            document.getElementById("user_password").style.borderColor = "red";
          $("#login_error_message").html("Invalid User name or Password");
    }



  });
});
function checkUsername(email){ 

  var valid = false;
    $.post('user_login_register_ajax.php?email_validator=true',
      { 
        'email': email
      },
      function (response, status) {
        if(response == '1'){
          document.getElementById("user_name").style.borderColor = "";
          $("#username_error_message").html("");
          $("#form_submit_valid").val('1');
          
          valid= true;
        }else if(response == '0'){
          document.getElementById("user_name").style.borderColor = "red";
          $("#username_error_message").html("Invalid User name");
          $("#form_submit_valid").val('0');
          valid= false;
        }
      
  return valid;
      }
    );


}
</script>
<style>
  .info{
    color:red;
  }
  </style>

<?php include('../inc/partials/footer.php') ?>