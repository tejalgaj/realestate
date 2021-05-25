<?php

$currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));
session_start();
$user_id = $_SESSION['user_id'];
use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if(isset($_GET)&&isset($_GET['form_submit'])&&(!empty($_GET['form_submit'] == 'true'))){


$street_name= $_POST['street_name'];
$city_name= $_POST['city_name'];
$province_name= $_POST['province_name'];
$zipcode= $_POST['zipcode'];
$price_range= $_POST['price_range'];
$property_type= $_POST['property_type'];
$build_year= $_POST['build_year'];
$last_sold_year= $_POST['last_sold_year'];
$number_of_bathrooms= $_POST['number_of_bathrooms'];
$number_of_bedrooms= $_POST['number_of_bedrooms'];
$kitchen_area= $_POST['kitchen_area'];
$dinning_area= $_POST['dinning_area'];
$laundry_room= $_POST['laundry_room'];
$flooring= $_POST['flooring'];
$aminities= $_POST['aminities'];
$square_feet= $_POST['square_feet'];
$basement_type= $_POST['basement_type'];
if(isset($_POST['edit_value'])&&!empty($_POST['edit_value'])){
  $property_id =$_POST['edit_value'];
  $sqlSelect = "SELECT * FROM property_table WHERE property_id=".$property_id;
  $result = $db->select($sqlSelect);
  $images_result = $result[0]['images'];



   if(isset($_POST['property_iamge_remove'])&&!empty($_POST['property_iamge_remove'])){
      $images_result =explode(",",$images_result);
   $result=array_values(array_diff($images_result,explode(",",$_POST['property_iamge_remove'])));
   $image_val = implode(', ', $result);

   print_r($result);
   }else{
       $image_val = $images_result;
   }

//   
//    $images_result=explode(",",$images_result);
//    if(isset($_POST['property_iamge_remove'])&&!empty($_POST['property_iamge_remove'])){
//        foreach($images_result as $images){
//          foreach(explode(",",$_POST['property_iamge_remove']) as $img)
//          {
//              if($img == $images){

//              }
//          }
//    }
    
// }
   
}



//echo '<pre>';print_r($_POST);echo'</pre>';


if(isset($_POST)&&(!empty($_POST))){



   // image upload code
    // File upload configuration 
   // $domain_url
    $targetDir = "images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['file']['name']); 
    $image_array = array();
    if(!empty($fileNames)){ 
        foreach($_FILES['file']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['file']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            $store_image_data = $domain_url.'/'.$targetDir . $fileName;
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                   // $insertValuesSQL .= "'".$fileName."',"; 
                    $image_array[]=$store_image_data;
                }else{ 
                    $errorUpload .= $_FILES['file']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['file']['name'][$key].' | '; 
            } 
        } 
         
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
    $insertId = $user_id;

    if(!empty($image_array)){
        if(isset($image_val)&&!empty($image_val)){
    $existing_images = explode(",",$image_val);
   $arr_merge =  array_merge($image_array, $existing_images);
   $images = implode(', ', $arr_merge);

}else{
    $images = implode(', ', $image_array);
}

    }else{
        
           if(isset($image_val)&&!empty($image_val)){
                // $images = implode(', ', $arr_merge);
                $images = $image_val;
           }else{
                  $images = '';
           }
        
    }
   
     $my_date = date("Y-m-d H:i:s");
    if(isset($_POST['edit_value'])&&!empty($_POST['edit_value'])){
        $property_id =$_POST['edit_value'];
        $sql= "UPDATE  `property_table` SET `street` =  '".$street_name."', `city` = '".$city_name."', `province`='".$province_name."', `zipcode`='".$zipcode."', `price`='".$price_range."', `user_id`= $insertId, `property_type`='".$property_type."', `year_built`='".$build_year."', `images`='".$images."', `last_sold`='".$last_sold_year."', `bathrooms`='".$number_of_bathrooms."', `bedrooms`='".$number_of_bedrooms."', `kitchen_area`='".$kitchen_area."', `dinning_area`='".$dinning_area."', `laundry`='".$laundry_room."', `flooring`='".$flooring."', `amenities`='".$aminities."', `total_square_feet`='".$square_feet."', `basement`='".$basement_type."', `created_at`='".$my_date."' WHERE property_id=".$property_id;
       

    }else{
        $sql= "INSERT INTO `property_table` (`street` , `city` , `province`, `zipcode`, `price`, `user_id`, `property_type`, `year_built`, `images`, `last_sold`, `bathrooms`, `bedrooms`, `kitchen_area`, `dinning_area`, `laundry`, `flooring`, `amenities`, `total_square_feet`, `basement`, `created_at`) VALUES ('".$street_name."','".$city_name."','".$province_name."','".$zipcode."','".$price_range."',$insertId,'".$property_type."','".$build_year."','".$images."','".$last_sold_year."','".$number_of_bathrooms."','".$number_of_bedrooms."','".$kitchen_area."','".$dinning_area."','".$laundry_room."','".$flooring."', '".$aminities."','".$square_feet."','".$basement_type."','".$my_date."')";

    }




if ($conn->query($sql) === TRUE) {
  echo '1';
} else {
  echo '0';
}

    // Display status message 
   


}
}

if(isset($_GET)&&isset($_GET['delete_property'])&&(!empty($_GET['delete_property'] == 'true'))){
if(isset($_POST)&&(!empty($_POST['property_id']))){
    $sql = 'DELETE FROM property_table WHERE property_id ='.$_POST['property_id'];
    
 if ($conn->query($sql) === TRUE) {
  echo "1";
} else {
  echo "0";
}
}
}
 
if(isset($_GET)&&isset($_GET['delete_contact'])&&(!empty($_GET['delete_contact'] == 'true'))){
    if(isset($_POST)&&(!empty($_POST['contact_id']))){
        $sql = 'DELETE FROM contact_us_details WHERE id ='.$_POST['contact_id'];
        
     if ($conn->query($sql) === TRUE) {
      echo "1";
    } else {
      echo "0";
    }
    }
    }




 die;