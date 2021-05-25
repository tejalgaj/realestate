<?php
require "DBController.php";
class Auth {
    function getMemberByUsername($username) {
        $db_handle = new DBController();
        $query = "Select * from user where email_id = ?";
        $result = $db_handle->runQuery($query, 's', array($username));
        return $result;
    }

    function getCheckEmailForRegister($email) {
        $db_handle = new DBController();
        $query = "Select * from user where email_id = ?";
        $result = $db_handle->runQuery($query, 's', array($email));
        return $result;
    }


       function getMemberByUseId($user_id) {
        $db_handle = new DBController();
        $query = "Select * from user where id = ?";
        $result = $db_handle->runQuery($query, 'i', array($user_id));
        return $result;
    }
      function getPropertyByname($username) {
        $db_handle = new DBController();
        $query = "Select * from property_table where street = ?";
        $result = $db_handle->runQuery($query, 's', array($username));
        return $result;
    }
    
	function getTokenByUsername($username,$expired) {
	    $db_handle = new DBController();
	    $query = "Select * from tbl_token_auth where username = ? and is_expired = ?";
	    $result = $db_handle->runQuery($query, 'si', array($username, $expired));
	    return $result;
    }
    
    function markAsExpired($tokenId) {
        $db_handle = new DBController();
        $query = "UPDATE tbl_token_auth SET is_expired = ? WHERE id = ?";
        $expired = 1;
        $result = $db_handle->update($query, 'ii', array($expired, $tokenId));
        return $result;
    }
    
    function insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date) {
        $db_handle = new DBController();
        $query = "INSERT INTO tbl_token_auth (username, password_hash, selector_hash, expiry_date) values (?, ?, ?,?)";
        $result = $db_handle->insert($query, 'ssss', array($username, $random_password_hash, $random_selector_hash, $expiry_date));
        return $result;
    }

    
     function insertUserRegisterData($name, $user_email,$phone, $user_password,$userType) {
        $db_handle = $this->database_connection();
        $sql = "INSERT INTO user (name, email_id, phone,password,userType)
        VALUES ('".$name."','". $user_email."', '".$phone."','".$user_password."','".$userType."')";
       $result =  $db_handle->query($sql);
        return $result;
    }
    
    function update($query) {
        mysqli_query($this->conn,$query);
    }


    function database_connection(){
        //temporary connection strat

        $servername = "localhost";
        $username = "root";
        $password = "";

        // Create connection
        $conn = new mysqli($servername, $username, $password,'realestate_management');
        return $conn;
    }

    function getPropertList() {
        
        $db_handle = $this->database_connection();
        $sql = "select * from property_table";
       $result =  $db_handle->query($sql);
        return $result;
    }

    function getPropertyDetail($prop_id) {
        
        $db_handle = $this->database_connection();
        $sql = "select * from property_table where property_id=".$prop_id;
       $result =  $db_handle->query($sql);
        return $result;
    }


    

    function getPropertyCount() {
        
        $db_handle = $this->database_connection();
        $sql = "select count(*) AS propertycount from property_table";
       $result =  $db_handle->query($sql);
       $value = $result->fetch_object();
        return $value->propertycount;
    }

    function getUserCount() {
        
        $db_handle = $this->database_connection();
        $sql = "select count(*) as USERCOUNT from user";
       $result =  $db_handle->query($sql);
       $value = $result->fetch_object();
        return $value->USERCOUNT;
    }
}
?>