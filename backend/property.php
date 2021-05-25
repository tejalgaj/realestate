<?php include('../inc/partials/header.php');

session_start();

use Phppot\DataSource;

require_once "authCookieSessionValidate.php";
$user = $auth->getMemberByUseId($_SESSION['user_id']);





if(!$isLoggedIn) {
  header("Location: ../");
} 
$currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));
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

if(isset($_GET) && !empty($_GET['property_id'])) {
  $property_id = $_GET['property_id'];
   $sqlSelect = "SELECT * FROM property_table WHERE property_id=".$property_id;
    $result = $db->select($sqlSelect);
    if (! empty($result)) {
      foreach ($result as $row) {

       

       $street_name= $row['street'];
$city_name= $row['city'];
$province_name= $row['province'];
$zipcode= $row['zipcode'];
$price_range= $row['price'];
$property_type= $row['property_type'];
$build_year= $row['year_built'];
$last_sold_year= $row['last_sold'];
$number_of_bathrooms= $row['bathrooms'];
$number_of_bedrooms= $row['bedrooms'];
$kitchen_area= $row['kitchen_area'];
$dinning_area= $row['dinning_area'];
$laundry_room= $row['laundry'];
$flooring= $row['flooring'];
$aminities= $row['amenities'];
$square_feet= $row['total_square_feet'];
$basement_type= $row['basement'];
$images =  $row['images'];


      }
    }
  
  ?>
<h1>Edit Property Details</h1>
<?php }else{?>
<h1>Add Property Details</h1>
<?php }

// onchange= "checkPropertyname(this.value);"


?>

            
            <p>Click on image to remove image.</p>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div><!-- container-fluid -->
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
           <form method="post"  name="add_property_form" id="add_property_form" enctype="multipart/form-data">
              <div class="form-group">
                <label for="inputName">Street Name</label>
                <input type="text"  name="street_name" id="street_name" class="form-control" placeholder="Street Name" value="<?php  if(isset($street_name)){echo $street_name;}?>" />
                <span id="streetName-info" class="info" style="color:red"></span>
              </div>
        
              <div class="form-group">
                <label for="inputStatus">City Name</label>
                 <input type="text" name="city_name" id="city_name" class="form-control" placeholder="City Name" value="<?php  if(isset($city_name)){echo $city_name;}?>" />
                <span id="cityname-info" class="info" style="color:red"></span>
              </div>
             
               <div class="form-group">
                   <?php $province_data = array(
                       'AB'=>'Alberta',
                        'BC'=>'British Columbia',
                         'MB'=>'Manitoba',
                          'NB'=>'New Brunswick',
                           'NL'=>'Newfoundland and Labrador',
                            'NS'=>'Nova Scotia',
                             'ON'=>'Ontario',
                              'PE'=>'Prince Edward Island',
                               'QC'=>'Quebec',
                                'SK'=>'Saskatchewan',
                                'NT'=>'Northwest Territories',
                                'NU'=>'Nunavut',
                                'YT'=>'Yukon'
                   ) ?>
               <label>province name</label>
              <select id="province_name" name="province_name" class="form-control custom-select">
                
                <option value="">Select One Province</option>
                <?php 
                $selected = '';
                if(!empty($province_data)){
                    foreach($province_data as $k=>$v){?>
                     <?php  if(isset($province_name)){ if($k == $province_name ){ $selected = "selected";}else{$selected = " ";}}?>
                     <option value="<?php echo $k ?>" <?php echo $selected ?>  ><?php echo $v ?></option>
                  <?php  } ?>
               <?php  } ?>
                </select>	
                <span id="cityname-info" class="info" style="color:red"></span>
              </div>

       <div class="form-group">
         <label for="zipcode">Zipcode</label>
                <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode" value="<?php  if(isset($zipcode)){echo $zipcode;}?>" />
                <span id="zipcode-info" class="info" style="color:red"></span>
      </div>
       <!-- price range -->
              <div class="form-group">
                <label for="price_range">Price Range</label>
                <input type="text" name="price_range" id="price_range" class="form-control" placeholder="Price Range"  value="<?php  if(isset($price_range)){echo $price_range;}?>" />
                <span id="pricerange-info" class="info" style="color:red"></span>
              </div>
           <!-- property type -->
               <div class="form-group">
                <label for="property_type">Property type</label>
                <?php $property_type_array =  array('family_home','condominium','semi_detatch','detatch','row_house') ?>
                <select id="property_type" name="property_type" class="form-control custom-select">
                <option value="">Select property type</option>
                <?php if(!empty($property_type_array)){
                  foreach($property_type_array as $property_type_ar){
                    if($property_type_ar == $property_type ){ $selected='selected';
                    }else{  $selected='';
                    }?>
                    <option value="<?php echo $property_type_ar ?>" <?php echo $selected ?>><?php echo str_replace('_', ' ', ucfirst($property_type_ar))  ?></option>
                 <?php }
                }?>
                  
                </select>	
                <span id="property_type-info" class="info" style="color:red"></span>
              </div>
      <!-- primary region start -->
  <!-- Build year -->
                 <div class="form-group">
                <label for="build_year">Build year</label>
                <input type="text" name="build_year" id="build_year" class="form-control" placeholder="Build Year" value="<?php  if(isset($build_year)){echo $build_year;}?>" />
                <span id="buildyear-info" class="info" style="color:red"></span>
              </div>

               <!-- Build year -->

                          <!-- image upload start		 -->
           <!-- <input type='file' multiple/> -->
           <div class="form-group">
                <label for="image">Image Upload</label>
           <input type="file" name="file[]" id="file" multiple="true" accepts="image/*" />
           <div id="myImg">
            </div>
             <div class="row">
     <!-- image upload ends		 -->
    <?php if(!empty($images)){
  $myArray = explode(',', $images);
  $image_count = count($myArray);
  if($image_count>1){
      ?>
      
  <?php  foreach($myArray as $image){
      ?>
   
        <?php
        
        ?>
         <div class="column">
    <img src='<?php echo $image ?>' value="<?php echo $image ?>" width="50" height="60" class="remove-img" >
    
    </div>

   <?php }
   ?>
   
  <?php  }
   }
    ?>
    </div>

    <!-- last sold year -->
                 <div class="form-group">
                <label for="last_sold_year">Last sold</label>
                <input type="text" name="last_sold_year" id="last_sold_year" class="form-control" placeholder="Last Sold" value="<?php  if(isset($last_sold_year)){echo $last_sold_year;}?>" />
                <span id="lastsold-info" class="info" style="color:red"></span>
              </div>

               <!-- last sold year -->
                <!-- number of bathrooms -->
                 <div class="form-group">
                <label for="number_of_bathrooms">Number of Bathrooms</label>
                <input type="text" name="number_of_bathrooms" id="number_of_bathrooms" class="form-control" placeholder="Number of Bathrooms" value="<?php  if(isset($number_of_bathrooms)){echo $number_of_bathrooms;}?>" />
                <span id="numberofbathrooms-info" class="info" style="color:red"></span>
              </div>

               <!-- number of bathrooms -->

               <!-- number of bedrooms -->
                 <div class="form-group">
                <label for="number_of_bedrooms">Number of Bedrooms</label>
                <input type="text" name="number_of_bedrooms" id="number_of_bedrooms" class="form-control" placeholder="Number of Bedrooms" value="<?php  if(isset($number_of_bedrooms)){echo $number_of_bedrooms;}?>"/>
                <span id="numberofbedrooms-info" class="info" style="color:red"></span>
              </div>

               <!-- number of bedrooms -->

               <!-- kitchen -->
                 <div class="form-group">
                <label for="kitchen_area">Kitchen Area</label>
                <input type="text" name="kitchen_area" id="kitchen_area" class="form-control" placeholder="Kitchen Area" value="<?php  if(isset($kitchen_area)){echo $kitchen_area;}?>"/>
                <span id="kitchenarea-info" class="info" style="color:red"></span>
              </div>

               <!-- kitchen -->

                <!-- Dinning room -->
                 <div class="form-group">
                <label for="dinning_area">Dinning Area</label>
                <input type="text" name="dinning_area" id="dinning_area" class="form-control" placeholder="Dinning Area" value="<?php  if(isset($dinning_area)){echo $dinning_area;}?>" />
                <span id="dinning-info" class="info" style="color:red"></span>
              </div>

               <!-- Dinning room -->

                 <!-- laundry room -->
                 <div class="form-group">
                <label for="laundry_room">Exterior Finish</label>
                <input type="text" name="laundry_room" id="laundry_room" class="form-control" placeholder="Exterior Finish" value="<?php  if(isset($laundry_room)){echo $laundry_room;}?>" />
                <span id="laundry_room-info" class="info" style="color:red"></span>
              </div>

               <!-- Laundry room -->

                <!-- flooring  -->
                 <div class="form-group">
                <label for="flooring">Flooring</label>
                <input type="text" name="flooring" id="flooring" class="form-control" placeholder="Flooring" value="<?php  if(isset($flooring)){echo $flooring;}?>" />
                <span id="flooring-info" class="info" style="color:red"></span>
              </div>

               <!-- Flooring -->

                <!-- aminities  -->
                 <div class="form-group">
                <label for="aminities">Aminities</label>
                <textarea name="aminities" id="aminities" class="form-control" rows="4" ><?php  if(isset($aminities)){echo $aminities;}?></textarea>
                <span id="aminities-info" class="info" style="color:red"></span>
              </div>

               <!-- aminities -->

               <!-- total square feet  -->
                 <div class="form-group">
                <label for="square_feet">Total Square feet</label>
                <input type="text" name="square_feet" id="square_feet" class="form-control" placeholder="Total Square feet" value="<?php  if(isset($square_feet)){echo $square_feet;}?>" />
                <span id="square_feet-info" class="info" style="color:red"></span>
              </div>

               <!-- total square feet -->

               <!-- number of bedrooms -->
                <!-- property type -->
               <div class="form-group">
                <label for="basement_type">Basement </label>
                <?php $property_type_array =  array('finished','unfinished','not_applicable') ?>
                <select id="basement_type" name="basement_type" class="form-control custom-select">
                <option value="">Select Basement</option>
                <?php if(!empty($property_type_array)){
                  foreach($property_type_array as $property_type_ar){
                    if($property_type_ar == $basement_type ){ $selected='selected';
                    }else{  $selected='';
                    }?>
                    <option value="<?php echo $property_type_ar ?>" <?php echo $selected ?>><?php echo str_replace('_', ' ', ucfirst($property_type_ar))  ?></option>
                 <?php }
                }?>
                   
                </select>	
                <span id="propertybasement_type-info" class="info" style="color:red"></span>
              </div>

      
            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
       
      </div>
      <div class="row">
        <div class="col-12">
            <?php if(isset($_GET) && !empty($_GET['property_id'])) { ?>
        <input type="hidden" name="edit_value" id="edit_value" value="<?php echo $_GET['property_id'] ?>">
        <?php } ?>
          <input type="hidden" name="property_iamge_remove" id="property_iamge_remove" value="0">
           <input type="hidden" name="form_submit_valid" id="form_submit_valid" value ="1">
          <button type="submit" id="submit" name="register" class="btn btn-success float-right" value="register">Save</button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <script type="text/javascript">
function checkPropertyname(property_name){ 
  var valid = false;
    $.post('user_login_register_ajax.php?check_property=true',
      { 
        'property_name': property_name
      },
      function (response, status) {
        if(response == '1'){
          document.getElementById("street_name").style.borderColor = "";
          $("#streetName-info").html("");
           $("#form_submit_valid").val('1');
          
          valid= true;
        }else if(response == '0'){
          document.getElementById("street_name").style.borderColor = "red";
          $("#streetName-info").html("PropertyAlready Exists");
          $("#form_submit_valid").val('0');
          valid= false;
        }
      
  return valid;
      }
    );


}
function logoutFunction(){
  window.location.replace("http://localhost/tejal_php_project/logout.php");
}
var image_array = [];
$('.remove-img').click(function(e) {
  image_array.push($( this ).attr('value')); 
  $("#property_iamge_remove").val(image_array)
    $( this ).parent().remove();
});
$(document).ready(function(){
    $('#submit').click(function(e){
        e.preventDefault();
        
        // var form_data = new FormData(document.querySelector("form"));
          
          var street_name =  $("#street_name").val();
          var valid_street_name = false;
          if(street_name == ''){
            valid_street_name = false;
            document.getElementById("street_name").style.borderColor = "red";
          }else{
             document.getElementById("street_name").style.borderColor = "";
             valid_street_name = true;
          }
           var city_name =  $("#city_name").val();
           var valid_city_name = false;
          if(city_name == ''){
            valid_city_name = false;
            document.getElementById("city_name").style.borderColor = "red";
          }else{
             document.getElementById("city_name").style.borderColor = "";
             valid_city_name = true;
          }
         
          var province_name=  $("#province_name").val();
           var valid_province_name = false;
          if(province_name == ''){
            valid_province_name = false;
            document.getElementById("province_name").style.borderColor = "red";
          }else{
             document.getElementById("province_name").style.borderColor = "";
             valid_province_name = true;
          }

          //Zipcode validation
          var zipcode =  $("#zipcode").val();
           var valid_zipcode = false;
          if(province_name == ''){
            valid_zipcode = false;
            document.getElementById("zipcode").style.borderColor = "red";
          }else if(zipcode.match(/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/)){
            document.getElementById("zipcode").style.borderColor = "";
             valid_zipcode = true;
            }else{
             document.getElementById("zipcode").style.borderColor = "";
             valid_zipcode = true;
          }
          

          
           var price_range =  $("#price_range").val();
           var valid_price_range = false;
          if(price_range == ''){
            valid_price_range = false;
            document.getElementById("price_range").style.borderColor = "red";
          }else{
             document.getElementById("price_range").style.borderColor = "";
             valid_price_range = true;
          }
           
          // var price_range_validation = CheckDecimal(price_range);
          var property_type =  $("#property_type").val();
        
           var valid_property_type = false;
          if(property_type == ''){
            valid_property_type = false;
            document.getElementById("property_type").style.borderColor = "red";
          }else{
             document.getElementById("property_type").style.borderColor = "";
             valid_property_type = true;
          }


          var build_year =  $("#build_year").val();
          var valid_build_year = false;
          if(build_year == ''){
            valid_build_year = false;
            document.getElementById("build_year").style.borderColor = "red";
          }else{
             document.getElementById("build_year").style.borderColor = "";
             valid_build_year = true;
          }


          var last_sold_year =  $("#last_sold_year").val();
           var valid_last_sold_year = false;
          if(last_sold_year == ''){
            valid_last_sold_year = false;
            document.getElementById("last_sold_year").style.borderColor = "red";
          }else{
             document.getElementById("last_sold_year").style.borderColor = "";
             valid_last_sold_year = true;
          }

          var number_of_bathrooms =  $("#number_of_bathrooms").val();
            var valid_number_of_bathrooms = false;
          if(number_of_bathrooms == ''){
            valid_number_of_bathrooms = false;
            document.getElementById("number_of_bathrooms").style.borderColor = "red";
          }else{
             document.getElementById("number_of_bathrooms").style.borderColor = "";
             valid_number_of_bathrooms = true;
          }

          var number_of_bedrooms =  $("#number_of_bedrooms").val();
             var valid_number_of_bedrooms = false;
          if(number_of_bedrooms == ''){
            valid_number_of_bedrooms = false;
            document.getElementById("number_of_bedrooms").style.borderColor = "red";
          }else{
             document.getElementById("number_of_bedrooms").style.borderColor = "";
             valid_number_of_bedrooms = true;
          }
          var kitchen_area =  $("#kitchen_area").val();
           var valid_kitchen_area = false;
          if(kitchen_area == ''){
            valid_kitchen_area = false;
            document.getElementById("kitchen_area").style.borderColor = "red";
          }else{
             document.getElementById("kitchen_area").style.borderColor = "";
             valid_kitchen_area = true;
          }


          var dinning_area =  $("#dinning_area").val();
            var valid_dinning_area = false;
          if(dinning_area == ''){
            valid_dinning_area = false;
            document.getElementById("dinning_area").style.borderColor = "red";
          }else{
             document.getElementById("dinning_area").style.borderColor = "";
             valid_dinning_area = true;
          }
          var laundry_room =  $("#laundry_room").val();
           var valid_laundry_room = false;
          if(laundry_room == ''){
            valid_laundry_room = false;
            document.getElementById("laundry_room").style.borderColor = "red";
          }else{
             document.getElementById("laundry_room").style.borderColor = "";
              valid_laundry_room = true;
          }
          var flooring =  $("#flooring").val();
           var valid_flooring = false;
          if(flooring == ''){
            valid_flooring = false;
            document.getElementById("flooring").style.borderColor = "red";
          }else{
             document.getElementById("flooring").style.borderColor = "";
             valid_flooring = true;
          }
          var aminities =  $("#aminities").val();
           var valid_aminities = false;
          if(flooring == ''){
            valid_aminities = false;
            document.getElementById("aminities").style.borderColor = "red";
          }else{
             document.getElementById("aminities").style.borderColor = "";
             valid_aminities = true;
          }
          var square_feet =  $("#square_feet").val();
          var valid_square_feet = false;
          if(flooring == ''){
            valid_square_feet = false;
            document.getElementById("square_feet").style.borderColor = "red";
          }else{
             document.getElementById("square_feet").style.borderColor = "";
             valid_square_feet = true;
          }
          var basement_type =  $("#basement_type").val();
          var valid_basement_type = false;
          if(basement_type == ''){
            valid_basement_type = false;
            document.getElementById("basement_type").style.borderColor = "red";
          }else{
             document.getElementById("basement_type").style.borderColor = "";
             valid_basement_type = true;
          }
          var street_prop_hidden_valid = false;
          var street_valid = $("#form_submit_valid").val();
    if(street_valid == '1'){
      street_prop_hidden_valid = true;
    }else{
street_prop_hidden_valid = true;
    }

          var myform = document.getElementById("add_property_form");
          var fd = new FormData(myform );
         // var files = $('#file')[0].files;

          if(valid_basement_type&&valid_square_feet&&valid_aminities&&valid_flooring&&valid_laundry_room&&valid_dinning_area&&valid_kitchen_area&&valid_number_of_bedrooms&&valid_number_of_bathrooms&&valid_last_sold_year&&valid_build_year&&valid_property_type&&valid_province_name&&valid_city_name&&valid_street_name&&valid_price_range&&valid_zipcode&&street_prop_hidden_valid){
$.ajax({
        url: "ajax_backend_submit.php?form_submit=true",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
           if(dataofconfirm == '1'){
            var site_url ='<?php echo $domain_url ?>';
            window.location.replace(site_url+"/list_property.php");
           }else{
              alert("data not added successfully");
           }
        }
    });
          }else{
             
          }
      
       
          
    });

});


$('#build_year').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

   });

   $('#last_sold_year').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

   });

// function CheckDecimal(inputtxt) 
// { 
// var decimal=  /^[-+]?[0-9]+\.[0-9]+$/; 
// if(inputtxt.value.match(decimal)) 
// { 
// alert('Correct, try another...')
// return true;
// }
// else
// { 
// alert('Wrong...!')
// return false;
// }
// }

$(function() {
  $(":file").change(function() {
    if (this.files && this.files[0]) {
      for (var i = 0; i < this.files.length; i++) {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[i]);
      }
    }
  });
});

function imageIsLoaded(e) {
  $('#myImg').append('<img src=' + e.target.result + '>');
};

</script>
<?php
}else{
  echo 'Do not show the page';
}?>
<?php include('../inc/partials/footer.php') ?>