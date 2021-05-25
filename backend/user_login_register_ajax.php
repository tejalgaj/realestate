<?php 

session_start();

require_once "Auth.php";
require_once "Util.php";

$auth = new Auth();
$db_handle = new DBController();
$util = new Util();
$isAuthenticated = false;

require_once "authCookieSessionValidate.php";


if(isset($_GET)&&isset($_GET['check_property'])&&(!empty($_GET['check_property'] == 'true'))){
   if(!empty($_POST['property_name'])){
    $property_name = $_POST["property_name"];

    $property = $auth->getPropertyByname($property_name);
    
    if(!empty($property)){
        if($property[0]["street"] == $property_name){
            echo 0;
        }else{
            echo 1;
        }
    }else{
        echo 0;
    }

   }
}

if(isset($_GET)&&isset($_GET['email_validator'])&&(!empty($_GET['email_validator'] == 'true'))){
   if(!empty($_POST['email'])){
    $username = $_POST["email"];

    $user = $auth->getMemberByUsername($username);
    if(!empty($user)){
        if($user[0]["email_id"] == $username){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }

   }
}

if(isset($_GET)&&isset($_GET['formsubmit'])&&(!empty($_GET['formsubmit'] == 'true'))){
//echo '<pre>';print_r($_POST);echo '</pre>';
$username = trim($_POST["user_name"]);
$password = trim($_POST["user_password"]);

$user = $auth->getMemberByUsername($username);
//check password hash start
$encrypted_password= md5($password);
if (strcmp($encrypted_password, trim($user[0]["password"])) == 0)
{
    $isAuthenticated = true;
}
// $password_hash_user = password_hash(trim($user[0]["userPassword"]), PASSWORD_DEFAULT);
// //check password hash stopped
// if (password_verify($password, $password_hash_user)) {
//     $isAuthenticated = true;
// }
if ($isAuthenticated) {
    $_SESSION["user_id"] = $user[0]["id"];
    
    // Set Auth Cookies if 'Remember Me' checked
    if (! empty($_POST["user_remember"])) {
        setcookie("user_login", $username, $cookie_expiration_time);
        setcookie("user_password", $password, $cookie_expiration_time);
        
        $random_password = $util->getToken(16);
        setcookie("user_random_password", $random_password, $cookie_expiration_time);
        
        $random_selector = $util->getToken(32);
        setcookie("user_random_selector", $random_selector, $cookie_expiration_time);
        
        $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
        $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);
        
        $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);
        
        // mark existing token as expired
        $userToken = $auth->getTokenByUsername($username, 0);
        if (! empty($userToken[0]["id"])) {
            $auth->markAsExpired($userToken[0]["id"]);
        }
        // Insert new token
        $auth->insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
    } else {
        $util->clearAuthCookie();
    }
    echo 1;
   // $util->redirect("dashboard.php");
} else {
    echo 0;
 //   $message = "Invalid Login";
}


}
//User Register related Ajax requests
if(isset($_GET)&&isset($_GET['register_email_verify'])&&(!empty($_GET['register_email_verify'] == 'true'))){
    $email_id = $_POST['email'];
    if(!empty($email_id)){
        $userToken = $auth->getCheckEmailForRegister($email_id);
        if(!empty($userToken)){
           echo 1;
        }else{
            echo 0;
        }
        
    }
   

   
}

//Add data to register user start
if(isset($_GET)&&isset($_GET['register_user_data'])&&(!empty($_GET['register_user_data'] == 'true'))){
//echo '<pre>';print_R($_POST);echo '</pre>';
if(isset($_POST) && !empty($_POST)){
    $name= $_POST['first_name'];
    $phone= $_POST['phone'];
    $user_email= $_POST['user_email'];
    $user_password= md5($_POST['user_password']);
    $authentication_string =  random_strings(20);
    $active_user = 0; 
    $userType='agent';


    $result = $auth->insertUserRegisterData($name, $user_email, $phone,$user_password,$userType);
  if ($result === TRUE) {
      $conn = $auth->database_connection();
    $last_id = $conn->insert_id;
    $encoded_id =base64_encode($last_id);

    echo "successfully";

 }else{
     echo "data not inserted";
 }
   
}

   
}




function random_strings($length_of_string) 
{ 
  
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
} 
 
 die();
?>