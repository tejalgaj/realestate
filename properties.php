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
?>
<!--  ************************* Page Title Starts Here ************************** -->
 <div class="page-nav no-margin row">
                   <div class="container">
                       <div class="row">
                           <h2>Properties</h2>
                           <ul>
                               <li> <a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                               <li><i class="fas fa-angle-double-right"></i> Properties</li>
                           </ul>
                       </div>
                   </div>
               </div>
       
    <!-- ######## Page  Title End ####### -->
       
    
     
     
       
         <!-- ################# Services Starts Here#######################--->
     
         <section class="wat-we-offer">
        <div class="container">
             
            <div class="row">
            
<?php
 $propertyList = $auth->getPropertList();

 if ($propertyList->num_rows > 0) {
    // output data of each row
    while($row = $propertyList->fetch_assoc()) {
      //  echo '<pre>';print_r($row);echo '</pre>';

$province_name = "";

      if(!empty($province_data[$row['province']]) && array_key_exists($row['province'],$province_data)){ 
          $province_name= $province_data[$row['province']];
        }

      else { $province_name= $row['province'];}
      


       ?>
      <div class="card-deck m-3">

       <div class="card" style="width: 18rem;">
       <?php if ($row['images']=='')
                        {
$img_src=$domain_url.'/backend/images/No_Image_Available.jpg';
                        }else{
                            $pieces = explode(",", $row['images']);

                            $url = filter_var($pieces[0], FILTER_SANITIZE_URL);

                            // Validate url
                            if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                                $img_src=$url;
                            } else {
                                $img_src=$domain_url.'/backend/images/'.$pieces[0];
                            }

                            
                        }?>
                        <a href="property_detail.php?id=<?php echo $row['property_id'];?>">
                        <img class="card-img-top" src="<?php echo $img_src;?>" alt="Card image cap">
                        </a>
  
  <div class="card-body">
  <h5 class="card-title"><?php echo '$ '.$row['price'];?></h5>











    <p class="card-text"><?php echo $row['street'].','.$row['city'].','.$province_name.','.$row['zipcode']?></p>
    
  </div>
</div>
</div>          
    <?php }
} else {
    echo "No Results Found";
}

?>


                
                 
                 
                 
            </div>
        </div>
    </section>
    <?php include('footer.php');?>