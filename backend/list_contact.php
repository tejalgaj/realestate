<?php include('../inc/partials/header.php');

session_start();

use Phppot\DataSource;
require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
$sql = " ";
require_once "authCookieSessionValidate.php";
$user = $auth->getMemberByUseId($_SESSION['user_id']);
if(!empty($user)){
  $user_role =$user[0]['usertype'];
  $user_id = $user[0]['id'];
  if($user_role == 'admin'){
$sql = "SELECT * FROM contact_us_details";

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
                <h3 class="card-title">Contact List</h3>

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
              <div class="outer-scontainer" id="list_contact_data">
               <?php
            
$result = $db->select($sql);
            if (! empty($result)) {
                ?>
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Message</th>
                    <th>Added On</th>
                    <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                
               
                foreach ($result as $row) {
                    ?>
                     <tr>
                    <td><?php  echo $row['id']; ?></td>
                    <td><?php  echo $row['name']; ?></td>
                    <td><?php  echo $row['email']; ?></td>
                    <td><?php  echo $row['number']; ?></td>
                    <td><?php  echo $row['message']; ?></td>
                    
                    <td><?php  echo date("d-m-Y", strtotime($row['timestamp'])) ?></td>
                   
                    <td><a href="javascript://" onClick="delete_property('<?php  echo $row['id']; ?>')">Delete</a></td>
                </tr>
                     <?php
                }
                ?>
                  </tbody>
                </table>
                  <?php }else{
                    echo "No Contact found";
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
function delete_property(contact_id){


    if (confirm('Are you sure you want to delete this Contact?')) {
     $.ajax({
        url: "ajax_backend_submit.php?delete_contact=true",
        data: {'contact_id':contact_id},
        type: 'POST',
        success: function (dataofconfirm) {
           if(dataofconfirm == '1'){
            
             $("#list_contact_data").load("#list_contact_data");
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