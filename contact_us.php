<?php include('header.php');

$nameErr = $emailErr =$phoneErr = $messageErr ="";
$name=$email=$phone=$message="";
$successStatus = 'false';

$dbSetup = new PDO(
    "mysql:host=localhost;dbname=realestate_management", "root", "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    if (empty($_POST["name"])) {
        $nameErr = "First Name is required";
      } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
          $nameErr = "Only letters and white space allowed";
        }
      }
      
      


      if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
      } else {
        $phone = test_input($_POST["phone"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^\d{3}-?\d{3}-?\d{4}$/",$phone)) {
          $phoneErr = "Only digits and - allowed with length of 10 digits";
        }
      }
      

      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
      }



  if (empty($_POST["message"])) {
    $messageErr = "Message is required";
  } else {
    $message = test_input($_POST["message"]);
    
  }
  
  
 

  if($nameErr =="" && $emailErr =="" && $messageErr =="" && $phoneErr == "" )
  {
    //$timestamp = date("Y-m-d H:i:s");
      //insert data into database
    $contact_add = "INSERT INTO contact_us_details(name,email,number,message) VALUES(?, ?, ?, ?)";
    $sqlStatement = $dbSetup->prepare($contact_add);
    $params = [$name, $email,$phone, $message];
    $result = $sqlStatement->execute($params);
   //  print $sqlStatement->errorCode();die();
     
    $successStatus = 'true';
    $name=$email=$phone=$message="";
   }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<style>
    .error
{

   color: red;
}
    </style>
 <!--  ************************* Page Title Starts Here ************************** -->
 <div class="page-nav no-margin row">
                   <div class="container">
                       <div class="row">
                           <h2>Contact Us</h2>
                           <ul>
                               <li> <a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                               <li><i class="fas fa-angle-double-right"></i> Contact Us</li>
                           </ul>
                       </div>
                   </div>
               </div>
       
    <!-- ######## Page  Title End ####### -->
       
      <div style="margin-top:0px;" class="row no-margin">
     
        <iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d369106.7267949492!2d-79.65824079514913!3d43.71789901030551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cb90d7c63ba5%3A0x323555502ab4c477!2sToronto%2C%20ON!5e0!3m2!1sen!2sca!4v1606407984523!5m2!1sen!2sca"  height="450" frameborder="0" style="border:0" allowfullscreen></iframe>


      </div>

      <div class="row contact-rooo no-margin">
        <div class="container">
           <div class="row">
               <?php if($successStatus=="true")
               {?>
<div class="alert alert-success" role="alert">
  Thank you for contacting us. We will contact you soon.
</div>
              <?php  }?>
          
            <div style="padding:20px" class="col-sm-7">
            <h2 style="font-size:18px">Contact Form</h2>
            <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' >
                <div class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Enter Name :</label></div>
                    <div class="col-sm-8"><input type="text" placeholder="Enter Name" name="name" class="form-control input-sm" value="<?php if(isset($name))echo $name?>" ><span class="error"><?php echo $nameErr?></span></div>
                   
                </div>
                <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Email Address :</label></div>
                    <div class="col-sm-8"><input type="text" name="email" placeholder="Enter Email Address" class="form-control input-sm" value="<?php if(isset($email))echo $email?>"  ><span class="error"><?php echo $emailErr?></span></div>
                </div>
                 <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Mobile Number:</label></div>
                    <div class="col-sm-8"><input type="text" name="phone" placeholder="Enter Mobile Number" class="form-control input-sm" value="<?php if(isset($phone))echo $phone?>" ><span class="error"><?php echo $phoneErr?></span></div>
                </div>
                 <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Enter  Message:</label></div>
                    <div class="col-sm-8">
                      <textarea rows="5" name="message" placeholder="Enter Your Message" class="form-control input-sm"><?php if(isset($message))echo $message?></textarea><span class="error"><?php echo $messageErr?></span>
                    </div>
                </div>
                 <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label></label></div>
                    <div class="col-sm-8">
                    <input type="submit" name="register" value="Send Message" class="btn btn-info btn-sm"> 
                     
                    </div>
                </div>
                </form>
            </div>
             <div class="col-sm-5">
                    
                  <div style="margin:50px" class="serv"> 
                
               
             
                              
              
          <h2 style="margin-top:10px;">Address</h2>

          Real Estate <br>
                        Toronto <br>
                        Ontario, CA <br>
                        Phone: +1 123 456 7890 <br>
                        Email: <a href="mailto:info@anybiz.com" class="">info@realestate.in</a><br>
                        Web: <a href="smart-eye.html" class="">www.realestate.in</a>
              
           </div>    
                
             
         </div>

            </div>
        </div>
        
      </div>
      <?php include('footer.php');?>