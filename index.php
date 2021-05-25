<?php include('header.php');

if(isset($_COOKIE['visit']) && $_COOKIE['visit'] == "true"){
 
    $load = false;
  }else{
    $load = true;
    
    setcookie("visit", "true", time()+60*60*24*600);
  }



?>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Welcome User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h1>Hello....</h1>
       <h3>Have a nice day..!!</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="slider-detail">

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/images/slider/slide-02.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5 class=" bounceInDown">Find Best Home In Kitchener</h5>
                <p class=" bounceInLeft">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam justo neque, <br>
                    aliquet sit amet elementum vel, vehicula eget eros. Vivamus arcu metus, mattis <br>
                    sed sagittis at, sagittis quis neque. Praesent.</p>

                <div class="row vbh">

                <a href="contact_us.php"><div class="btn btn-success  bounceInUp"> Book an Appointment </div></a>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <img class="d-block w-100" src="assets/images/slider/slide-03.jpg" alt="Third slide">
            <div class="carousel-caption vdg-cur d-none d-md-block">
                <h5 class=" bounceInDown">Find Best Condo In Toronto</h5>
                <p class=" bounceInLeft">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam justo neque, <br>
                    aliquet sit amet elementum vel, vehicula eget eros. Vivamus arcu metus, mattis <br>
                    sed sagittis at, sagittis quis neque. Praesent.</p>

                <div class="row vbh">

                <a href="contact_us.php"><div class="btn btn-success  bounceInUp"> Book an Appointment </div></a>
                </div>
            </div>
        </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


</div>


<!-- ################# What We offer #######################--->


<section class="wat-we-offer">
<div class="container">
     <div class="inner-title row">
        <h2>What wo offer</h2>
        <p>Take a look at some of our key services</p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="offer-cover">
                <i class="fab fa-mixcloud"></i>
                <h5>Selling Property</h5>
                <p>Quisque non lacinia purus. Aenean massa metus, molestie in ex nec, elementum porttitor eros</p>
            </div>
        </div>
         <div class="col-md-4">
            <div class="offer-cover">
                <i class="fas fa-yen-sign"></i>
                <h5>Buying Property</h5>
                <p>At, rhoncus ut metus. In tristique magna ut turpis euismod, id fringilla enim scelerisque</p>
            </div>
        </div>
         <div class="col-md-4">
            <div class="offer-cover">
              <i class="fas fa-chart-pie"></i>
                <h5>Renting Property</h5>
                <p> Etiam dui tellus, sodales ac nunc id, pellentesque efficitur nibh. Sed efficitur pellentesque eros</p>
            </div>
        </div>
        
         
    </div>
</div>
</section>




<!-- ################# Blog Starts Here#######################--->

<section class="our-blog container-fluid">
<div class="container">
    <div class="session-title row">
        <h2>Properties</h2>
        <p>Not the answer you're looking for? Printing and typesetting inLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s Lorem</p>
    </div>
    <div class="col-sm-12 blog-cont">
        <div class="row no-margin">
            <div class="col-lg-4 col-md-6 blog-smk">
                <div class="blog-single">

                    <img src="assets/images/services/service-1.jpg" alt="">

                    <div class="blog-single-det">

                        <h6>Residential</h6>
                        <p>Residential properties include a single-family structure, available for occupation for non-business purposes.</p>
                        <a href="properties.php">
                            <button class="btn btn-success btn-sm">More Detail</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 blog-smk">
                <div class="blog-single">

                    <img src="assets/images/services/service-2.jpg" alt="">

                    <div class="blog-single-det">

                        <h6>Condominiums</h6>
                        <p>Condominiums (or condos for short) are single units within a larger building or community. Condos share a wall.</p>
                        <a href="properties.php">
                            <button class="btn btn-success btn-sm">More Detail</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 blog-smk">
                <div class="blog-single">

                    <img src="assets/images/services/service-3.jpg" alt="">

                    <div class="blog-single-det">

                        <h6>Commercial</h6>
                        <p>In commercial real estate, office buildings are typically placed in one of three categories: class A, class B, or class C.</p>
                        <a href="properties.php">
                            <button class="btn btn-success btn-sm">More Detail</button>
                        </a>
                    </div>
                </div>
            </div>






        </div>
    </div>

</div>
</section>
       <!--  *************************Testimonial Starts Here ************************** -->








</div>
<?php include('footer.php');?>
<script>
let cookiestatus = '<?php echo $load;?>';

if(cookiestatus ==1)
{
  jQuery('#myModal').modal('show');
}


</script>