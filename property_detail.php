<?php include('header.php');
require_once "backend/Auth.php";
$auth = new Auth();
$currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));
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
$id=$_REQUEST['id'];

if(!empty($id) && $id!=0)
{



    $propertyDetail = $auth->getPropertyDetail($id);
  
    if (!$propertyDetail) {
        
        header("Location: properties.php");
        exit();
    }


    
}else{
    header("Location: properties.php");
        exit();
}
?>
<div class="page-nav no-margin row">
                   <div class="container">
                       <div class="row">
                           <h2>Property Details</h2>

                       </div>
                   </div>
               </div>
<?php
if ($propertyDetail && $propertyDetail->num_rows > 0 ) {
    // output data of each row
    while($row = $propertyDetail->fetch_assoc()) {
        $province_name = "";

      if(!empty($province_data[$row['province']]) && array_key_exists($row['province'],$province_data)){ 
          $province_name= $province_data[$row['province']];
        }

      else { $province_name= $row['province'];}
?>



             
               <section class="with-medical">
        <div class="container">
        <div class="card">
            <div class="card-body txtr">
                <h4><span><?php echo $row['street'].','.$row['city'].','.$province_name.','.$row['zipcode']?></span></h4>
            </div>
        </div>
        </div>
    </section>
<section class="with-medical">
<div class="container">
            <div class="row">
<div class="col-lg-6 col-md-12">
            <?php if($row['images']=='') {?>

            <img class="d-block w-100" src="<?php echo $domain_url.'/backend/images/No_Image_Available.jpg'?>" alt="First slide">
        <?php    }else{
                
                $pieces = explode(",",$row['images']);
                
                ?>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

<?php
$i=0;
foreach ($pieces as $values)
{
    
    $url = filter_var(trim($values), FILTER_SANITIZE_URL);

    // Validate url
    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
        $img_src=$url;
    } else {
        if(!empty($values))
        $img_src=$domain_url.'/backend/images/'.trim($values);
        else
        $img_src=$domain_url.'/backend/images/No_Image_Available.jpg';
    }
    
    
    
    
    
    
    
    ?>
    <div class="carousel-item <?php if($i==0) echo 'active'?>">
      <img class="d-block w-100" src="<?php echo $img_src;?>" alt="First slide">
    </div>
    <?php
    $i++;
//
}
?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<?php } ?>
</div>
<div class="col-lg-6 col-md-12 txtr">
<h4>$ <?php echo $row['price'];?> <br>
                     <span><?php echo str_replace('_', ' ', ucfirst($row['property_type']))  ?></span>   
                    </h4>
                    
                    <p><span class="font-weight-bold mr-4">Posted On: </span><?php echo date("Y-m-d", strtotime( $row['created_at']));?></p></br>
                    <p><span class="font-weight-bold mr-4">Year Built:</span> <?php echo $row['year_built'];?></p></br>
                    <p><span class="font-weight-bold mr-4">Last Sold:</span> <?php echo $row['last_sold'];?></p>
                   
</div>
               </div>
            </div>

    </section>

    <section class="faq">
        <div class="container">
            
            <div class="row">
            <div class="col-md-12">
            <div class="card">
            <div class="card-title ml-4 mt-4">
                <h4>Home Information</h4>
            </div>
            <div class="card-body">
            <div class="col-lg-12 col-md-12">
               <ul class="list-group list-group-flush">
  <li class="list-group-item"><span class="font-weight-bold mr-4">Bathrooms:</span> <?php echo $row['bathrooms'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Bedrooms:</span> <?php echo $row['bedrooms'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Kitchen Area:</span> <?php echo $row['kitchen_area'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Dinning Area:</span> <?php echo $row['dinning_area'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Exterior Finish:</span> <?php echo $row['laundry'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Flooring: </span><?php echo $row['flooring'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Amenities:</span> <?php echo $row['amenities'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Total Sq Ft:</span> <?php echo $row['total_square_feet'];?></li>
  <li class="list-group-item"><span class="font-weight-bold mr-4">Basement:</span> <?php echo str_replace('_', ' ', ucfirst($row['basement']));?></li>

</ul>
                </div>
                </div>
            </div>
        </div>
               
                
                
            </div>
        </div>
    </section>
    <section class="with-medical">
        <div class="container">
            
            <div class="row">
               <div class="col-lg-6 col-md-12">
                    <img src="assets/images/about.jpg" alt="">
                </div>
                <div class="col-lg-6 col-md-12 txtr">
                    <h4>Why choos Peole Care for your <br>
                     <span>Next Charity Donation</span>   
                    </h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer neque libero, pulvinar et elementum quis, facilisis eu ante. Mauris non placerat sapien. Pellentesque tempor arcu non odio scelerisque ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam varius eros consequat auctor gravida. Fusce tristique lacus at urna sollicitudin pulvinar. Suspendisse hendrerit ultrices mauris.</p>
                    <p>Ut ultricies lacus a rutrum mollis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed porta dolor quis felis pulvinar dignissim. Etiam nisl ligula, ullamcorper non metus vitae, maximus efficitur mi. Vivamus ut ex ullamcorper, scelerisque lacus nec, commodo dui. Proin massa urna, volutpat vel augue eget, iaculis tristique dui. </p>
                </div>
                
            </div>
        </div>
    </section>
<?php
    }
}else{?>
    <div class="card">
            <div class="card-body txtr ml-5">
                <h4><span>No Property Found</span></h4>
            </div>
        </div>
  
<?php }
?>
 <!-- ################# About Us Starts Here#######################--->
 




 
    


    
       <!-- ################# FAQ #######################--->
      
      <section class="faq">
          <div class="container">
              
              <div class="bus-count row">
                  <div class="col-lg-10 bus-coo col-md-12">
                     <div class="inner-title row">
                        <h2>We help you to find your dream house</h2>
                        <p>We are here to acclerate your dreams and find a way</p>
                    </div>
                      <div class="row">
                          <div class="col-3 ccv">
                              <b>1+</b>
                              <p>Months of Experiance</p>
                          </div>
                          <div class="col-3 ccv">
                               <b><?php echo $auth->getUserCount();?></b>
                              <p>Happy Customer</p>
                          </div>
                          <div class="col-3 ccv">
                               <b><?php echo $auth->getPropertyCount();?></b>
                              <p>Properties</p>
                          </div>
                          <div class="col-3 ccv">
                               <b>100%</b>
                              <p>Satisfied Customers</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
    
     <!-- ################# Our Team Starts Here#######################--->


    <?php include('footer.php');?>