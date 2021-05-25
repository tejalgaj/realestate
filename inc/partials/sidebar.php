  <?php

  $currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));

$page_name=  basename($_SERVER['PHP_SELF']);
require_once "authCookieSessionValidate.php";
$user = $auth->getMemberByUseId($_SESSION['user_id']);
if(!empty($user)){
  $user_role =$user[0]['usertype'];
  $user_id = $user[0]['id'];
  $adminOnly = "";
  if($user_role == 'agent' ||  $user_role == 'user'){
    
     
    $adminOnly = "hide";
  }elseif($user_role == 'admin'){
    $adminOnly = "show";

  }
}




  ?>
  <script>
    function logoutFunction(){
      var site_url ='<?php echo $domain_url ?>';
  window.location.replace(site_url+"/logout.php");
}
    </script>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  

    <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" style="height: 18px;width: 150%;font-size: 15px" onclick="logoutFunction();">Logout</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $domain_url.'/list_property.php' ?>" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Real Estate</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <?php $user_name = $user[0]['name'] ?>
          <a href="#" class="d-block"><?php if(!empty($user_name)){ echo $user_name;}?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?php echo $domain_url.'/list_property.php' ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if($page_name == 'property.php'){
                  $active="active";
                }else{
                   $active="";
                } ?>
                <a href="<?php echo $domain_url.'/property.php' ?>" class="nav-link <?php echo $active ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Property</p>
                </a>
              </li>
              <li class="nav-item">
                 <?php if($page_name == 'list_property.php'){
                  $active="active";
                }else{
                   $active="";
                } ?>
                <a href="<?php echo $domain_url.'/list_property.php' ?>" class="nav-link <?php echo $active ?>" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Property</p>
                </a>
              </li>
              <?php if($adminOnly == 'show'){?>
              <li class="nav-item">
                 <?php if($page_name == 'upload_csv.php'){
                  $active="active";
                }else{
                   $active="";
                } ?>
                <a href="<?php echo $domain_url.'/upload_csv.php' ?>" class="nav-link <?php echo $active ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload CSV</p>
                </a>
              </li>
              
              <li class="nav-item">
                 <?php if($page_name == 'list_contact.php'){
                  $active="active";
                }else{
                   $active="";
                } ?>
                <a href="<?php echo $domain_url.'/list_contact.php' ?>" class="nav-link <?php echo $active ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Contact</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>