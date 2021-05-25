<?php
$currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$domain_url = substr($currentPageUrl, 0, strrpos( $currentPageUrl, '/'));?>
<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <h2>About Us</h2>
                    <p>
                        Real Estate is a leading propert management services. Our dedicated employees offer strategic insights, real trend suggestions and industry experience.
                    </p>
                    <p>We focus on customer satisfaction by our strong quality processes and rich experience managing global... </p>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h2>Useful Links</h2>
                    <ul class="list-unstyled link-list">
                        <li><a ui-sref="contact" href="contact_us.php">Contact us</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="contact" href="<?php echo $domain_url.'/backend/user_register.php'?>">Register</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="contact" href="<?php echo $domain_url.'/backend/user_login.php'?>">Login</a><i class="fa fa-angle-right"></i></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-12 map-img">
                    <h2>Contact Us</h2>
                    <address class="md-margin-bottom-40">
                        Real Estate <br>
                        Toronto <br>
                        Ontario, CA <br>
                        Phone: +1 123 456 7890 <br>
                        Email: <a href="mailto:info@realestate.com" class="">info@realestate.com</a><br>
                        Web: <a href="index.html" class="">www.realestate.in</a>
                    </address>

                </div>
            </div>
        </div>


    </footer>
    <div class="copy">
        <div class="container">
            <a href="#">2020 &copy; All Rights Reserved | Real Estate</a>

            <span>
                <a><i class="fab fa-github"></i></a>
                <a><i class="fab fa-google-plus-g"></i></a>
                <a><i class="fab fa-pinterest-p"></i></a>
                <a><i class="fab fa-twitter"></i></a>
                <a><i class="fab fa-facebook-f"></i></a>
            </span>
        </div>

    </div>
    
</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/slider/js/owl.carousel.min.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/plugins/testimonial/js/owl.carousel.min.js"></script>
<script src="assets/js/script.js"></script>



</html>