<?php include('../inc/partials/header.php');

session_start();

use Phppot\DataSource;

require_once "authCookieSessionValidate.php";
$user = $auth->getMemberByUseId($_SESSION['user_id']);

if(!$isLoggedIn) {
  header("Location: ../");
} 
if(isset($_SESSION) && !empty($_SESSION['user_id'])){


?>
<style>
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!-- Site wrapper -->
<div class="wrapper">
<?php   include('../inc/partials/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
              <?php


require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
$user_exists_data = array();
$property_exists_data =array();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            // $userId = "";
            // if (isset($column[0])) {
            //     $userId = mysqli_real_escape_string($conn, $column[0]);
            // }
            $userName = "";
            if (isset($column[1])) {
                $userName = mysqli_real_escape_string($conn, $column[1]);
            }
          
            $email_id = "";
            if (isset($column[2])) {
                $email_id = mysqli_real_escape_string($conn, $column[2]);
            }

              //PHP check if the email exists in database or not
            $sqlSelect = "SELECT email_id  FROM user WHERE email_id='".$email_id."'";
            $result = $db->select($sqlSelect);
            if(isset($result) && !empty($result)){
                array_push($user_exists_data,$email_id);
              
                
                $result_id = $conn->query("SELECT id FROM user WHERE email_id='".$email_id."'")->fetch_object()->id;


                $insertId = $result_id;
            }else{
                 $phone = "";
            if (isset($column[3])) {
                $phone = mysqli_real_escape_string($conn, $column[3]);
            }
            $password = "";
            if (isset($column[4])) {
                $password = mysqli_real_escape_string($conn, $column[4]);
            }
            $usertype = "";
            if (isset($column[5])) {
                $usertype = mysqli_real_escape_string($conn, $column[5]);
            }
            
            $sqlInsert = "INSERT into user (name, email_id, phone, password, usertype)
                   values (?,?,?,?,?)";
            $paramType = "sssss";
            $paramArray = array(
                $userName,
                $email_id,
                $phone,
                md5($password),
                $usertype
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            }


           
            
            if (! empty($insertId)) {

                //Start inserting data for property into database 

                 $streetName = "";
            if (isset($column[6])) {
                $streetName = mysqli_real_escape_string($conn, $column[6]);
            }

              //PHP check if the email exists in database or not
            $sqlSelect = "SELECT street FROM property_table WHERE street='".$streetName."'";
            $result = $conn->query($sqlSelect);
           
            // while($row = $result->fetch_assoc()) {
            //      $street_name_data = $row['street'];
            //        if (strcmp(strtolower($street_name_data), strtolower($streetName)) !== 0) {
            //          $fail_upload = '1';
            //            }else{
            //          $fail_upload = '0';
            //            }
            // }
          
            if($result->num_rows > 0) {
                 

                 array_push($property_exists_data,$streetName);
            }else{
                            $cityName = "";
            if (isset($column[7])) {
                $cityName = mysqli_real_escape_string($conn, $column[7]);
            }
            $province = "";
            if (isset($column[8])) {
                $province = mysqli_real_escape_string($conn, $column[8]);
            }
            $zipcode = "";
            if (isset($column[9])) {
                $zipcode = mysqli_real_escape_string($conn, $column[9]);
            }
            $price_range = "";
            if (isset($column[10])) {
                $price_range = mysqli_real_escape_string($conn, $column[10]);
            }
            $property_type = "";
            if (isset($column[11])) {
                $property_type = mysqli_real_escape_string($conn, $column[11]);
            }

             $build_year = "";
            if (isset($column[12])) {
                $build_year = mysqli_real_escape_string($conn, $column[12]);
            }

             $images = "";
            if (isset($column[13])) {
             //  $images = explode (",", $column[13]);
               $images = mysqli_real_escape_string($conn, $column[13]);
            }

             $last_sold = "";
            if (isset($column[14])) {
               $last_sold =  mysqli_real_escape_string($conn, $column[14]);
            }

           

             $number_of_bathrooms = "";
            if (isset($column[15])) {
               $number_of_bathrooms =  mysqli_real_escape_string($conn, $column[15]);
            }

             $number_of_bedrooms = "";
            if (isset($column[16])) {
               $number_of_bedrooms =  mysqli_real_escape_string($conn, $column[16]);
            }

              $kitchen_area = "";
            if (isset($column[17])) {
               $kitchen_area =  mysqli_real_escape_string($conn, $column[17]);
            }

             $dinning_area = "";
            if (isset($column[18])) {
               $dinning_area =  mysqli_real_escape_string($conn, $column[18]);
            }

             $exterior_finish = "";
            if (isset($column[19])) {
               $exterior_finish =  mysqli_real_escape_string($conn, $column[19]);
            }

            $wooden_flooring = "";
            if (isset($column[20])) {
               $wooden_flooring =  mysqli_real_escape_string($conn, $column[20]);
            }

             $amenities = "";
            if (isset($column[21])) {
              // $amenities =  explode (",", $column[21]);
               $amenities = mysqli_real_escape_string($conn, $column[21]);
            }

            $square_foot = "";
            if (isset($column[22])) {
               $square_foot =  mysqli_real_escape_string($conn, $column[22]);
            }

             $basement = "";
            if (isset($column[23])) {
               $basement =  mysqli_real_escape_string($conn, $column[23]);
            }
            $my_date = date("Y-m-d H:i:s");
            
            $last_id_fetch_query = 'select * from property_table ORDER BY property_id DESC LIMIT 1';
            $result = $conn->query($last_id_fetch_query);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            $property_id = $row["property_id"];
            }
            } else {
            echo "0 results";
            }
            if(empty($property_id)){
                $incrementted_id = 1;
            }else{
                $incrementted_id = intval($property_id+1);
            }
            //echo $incrementted_id;die;

$sql= "INSERT INTO `property_table` (`property_id`,`street` , `city` , `province`, `zipcode`, `price`, `user_id`, `property_type`, `year_built`, `images`, `last_sold`, `bathrooms`, `bedrooms`, `kitchen_area`, `dinning_area`, `laundry`, `flooring`, `amenities`, `total_square_feet`, `basement`, `created_at`) VALUES ( $incrementted_id,'".$streetName."','".$cityName."','".$province."','".$zipcode."','".$price_range."',$insertId,'".$property_type."','".$build_year."','".$images."','".$last_sold."','".$number_of_bathrooms."','".$number_of_bedrooms."','".$kitchen_area."','".$dinning_area."','".$exterior_finish."','".$wooden_flooring."', '".$amenities."','".$square_foot."','".$basement."','".$my_date."')";


	if ($conn->query($sql) === TRUE) {
// echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}


            }
          

            

           


           

           
        }
        
    }
    $text_message="";
    $errorStatus=false;
     if(isset($user_exists_data) && !empty($user_exists_data)){
   
     
                $datacount = count($user_exists_data);
                
                if($datacount>0){
                    foreach($user_exists_data as $dc){
                      $text_message.= '<p>'.$dc.'</p>';
                    }
                    $text_message.=  "<p>users already exists</p>";
                    $errorStatus=true;
                }
                 // die("first");
            }
            
            if(isset($property_exists_data) && !empty($property_exists_data)){
             
                $datacount_property = count($property_exists_data);
                if($datacount_property>0){
                    foreach($property_exists_data as $dc){
                      $text_message.= '<p>'.$dc.'</p>';
                    }
                    $text_message.= "<p>Properties already exists</p>";
                }
                $errorStatus=true;
               // die("second");
            }

            if($errorStatus==false)
            {
              echo "data added successfully";
            }else{
              echo $text_message;
            }
           
}
}
?>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>

 <p></p>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">CSV</a></li>
              <li class="breadcrumb-item active">CSV upload</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <!-- Start developing affilate form -->


            <div class="card-body">
                 <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
</div>

            </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
}else{
  echo 'Do not show the page';
}?>

<?php include('../inc/partials/footer.php') ?>