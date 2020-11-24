<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8">
                <nav class="navbar" role="navigation">
                    <ul class="nav navbar-nav menu-effect">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="index.php#menu_movies">Movies</a></li>
                    </ul>
                </nav>
            </div>
            <div style="margin: 2%;" class="pull-right margin">
                <font style="font-size: 15px;" color="white">Developed by:</font>
                <a target="_blank" style="color:#d6b92c;font-size: 20px;" href="">Ali & Basil</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer --> 






<!-- ******************************************************************** -->
<!-- ************************* Javascript Files ************************* -->
<!-- jQuery -->
<!-- Respond.js media queries for IE8 -->
<script src="js/vendors/respond.min.js"></script>

<!-- Bootstrap-->
<script src="js/vendors/bootstrap.min.js" ></script>

<!-- One Page Scroll -->
<script src="js/vendors/jquery/jquery.nav.js" ></script>
<script src="js/vendors/jquery/jquery.sticky.js" ></script>

<!-- Isotope -->
<script src="js/vendors/jquery/jquery.isotope.min.js" ></script>

<!-- Carousel -->
<script src="js/vendors/owl-carousel/owl.carousel.js"></script>

<!-- Appear -->
<script src="js/vendors/jquery/jquery.appear.js" ></script>

<!-- Custom -->
<script src="js/script.js"  ></script>
<script>

</script>
<script>
    function getMoviesCount() {
        $.get("includes/handlers/home-handler.php" + "?getData=Movies", function (data) {
            $("#movies_count").html(data);
        });
    }
    function getLikes() {
        $.get("includes/handlers/home-handler.php" + "?getData=Likes", function (data) {
            $("#likes_count").html(data);
        });
    }


    setInterval(function () {
        getMoviesCount();
        getLikes();
    }, 2000);
</script>
<!-- *********************** End Javascript Files *********************** -->
<!-- ******************************************************************** -->
</body>
</html>
