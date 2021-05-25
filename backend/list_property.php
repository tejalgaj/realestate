<?php include('../inc/partials/header.php');

session_start();

use Phppot\DataSource;
require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

require_once "authCookieSessionValidate.php";
$user = $auth->getMemberByUseId($_SESSION['user_id']);


$currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));


if(!empty($user)){
  $user_role =$user[0]['usertype'];
  $user_id = $user[0]['id'];
  if($user_role == 'agent' || $user_role == 'user' ){
    
     
    $sql = "SELECT user.name,user.email_id,user.phone, property_table.* FROM user INNER JOIN property_table ON (user.id = property_table.user_id) WHERE user.id = {$user_id}";
  }elseif($user_role == 'admin'){
$sql = "SELECT user.name,user.email_id,user.phone, property_table.* FROM user INNER JOIN property_table ON (user.id = property_table.user_id)";

  }
}


if(!$isLoggedIn) {
  header("Location: ../");
} 
if(isset($_SESSION) && !empty($_SESSION['user_id'])){


?>
<div class="wrapper">
<?php   include('../inc/partials/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Property List</h3>

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                     <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
              <div class="outer-scontainer" id="list_property_data">
               <?php
            
$result = $db->select($sql);
            if (! empty($result)) {
                ?>
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                    <!-- <th>Property ID</th> -->
                    <th>Street</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Zipcode</th>
                    <th>price</th>
                    <th>user name</th>
                    <th>property Type</th>
                    <th>yesr Build</th>
                    <th>Last sold</th>
                    <th>bathrooms</th>
                    <th>bedrooms</th>
                    <th>kitchen area</th>
                    <th>dinning area</th>
                    <th>Exterior Finish</th>
                    <th>Flooring</th>
                    <th>Aminities</th>
                    <th>Square feet</th>
                    <th>Basement</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                
               $province_data = array(
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
               );
                foreach ($result as $row) {
                    ?>
                     <tr>
                    <!-- <td><?php  echo $row['property_id']; ?></td> -->
                    <td><?php  echo $row['street']; ?></td>
                    <td><?php  echo $row['city']; ?></td>
                    <td><?php if(!empty($province_data[$row['province']])){ echo $province_data[$row['province']];}else{ echo 'NULL';} ?></td>
                    <td><?php  echo $row['zipcode']; ?></td>
                    <td><?php  echo $row['price']; ?></td>
                    <td><?php  echo $row['email_id'];?></td>
                    <td><?php echo str_replace('_', ' ', ucfirst($row['property_type']))  ?></td>
                    <td><?php  echo $row['year_built']; ?></td>
                    <td><?php  echo $row['last_sold']; ?></td>
                    <td><?php  echo $row['bathrooms']; ?></td>
                    <td><?php  echo $row['bedrooms']; ?></td>
                    <td><?php  echo $row['kitchen_area']; ?></td>
                    <td><?php  echo $row['dinning_area']; ?></td>
                    <td><?php  echo $row['laundry']; ?></td>
                    <td><?php  echo $row['flooring']; ?></td>
                    <td><?php  echo $row['amenities']; ?></td>
                    <td><?php  echo $row['total_square_feet']; ?></td>
                    <td><?php  echo str_replace('_', ' ', ucfirst($row['basement'])); ?></td>
                    <td><a href="<?php echo $domain_url.'/property.php?property_id='.$row['property_id']; ?>" >Edit</a></td>
                    <td><a href="javascript://" onClick="delete_user('<?php  echo $row['property_id']; ?>')">Delete</a></td>
                </tr>
                     <?php
                }
                ?>
                  </tbody>
                </table>
                  <?php }else{
                  echo "No Propery found.";
                } ?>
            </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </section>

    <!-- Main content -->
 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2020 Real Estate.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
}else{
  echo 'Do not show the page';
}?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
function delete_user(property_id){


    if (confirm('Are you sure you want to delete this Property?')) {
     $.ajax({
        url: "ajax_backend_submit.php?delete_property=true",
        data: {'property_id':property_id},
        type: 'POST',
        success: function (dataofconfirm) {
           if(dataofconfirm == '1'){
            
             $("#list_property_data").load(" #list_property_data");
           }else{
              alert("data not Deleted successfully");
           }
        }
    });
} else {
 
}

   

}
</script>

<?php include('../inc/partials/footer.php') ?>