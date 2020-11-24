<script>
    window.onload = function () {
        document.getElementById("autoClick").click(); //hide premium
    }
</script>
<article class="premium-tv" id="menu_movies">
    <div class="container">
        <h2 class="animated" data-animation="fadeInUp" data-animation-delay="200">Movies List</h2>
        <h6 class="animated" data-animation="fadeInUp" data-animation-delay="400">You will find almost all the movies you might look for below. ENJOY</h6>
        <div class="filters">
            <?php
            //show premium movies to specifc users
                $sql = "select * from categories";


            $result = mysqli_query($con, $sql);
            confirmQuery($result);
            ?>
            <a id="autoClick" href="#" class="btn btn-filter active animated" data-animation="bounceIn" data-animation-delay="200" data-filter=".common">Show All</a>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <a href="#" class="btn btn-filter animated" data-animation="bounceIn" data-animation-delay="300" data-filter=".<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></a>
                <?php
            }
            ?>
        </div>
        <div class = "premium-tv-grid">
            <?php
            $movies = mysqli_query($con, "select * from movie_info");//
            confirmQuery($movies);
            //Use 225 px width x 315 px height for movie
            while ($row = mysqli_fetch_array($movies)) {
                ?>
                <div class="<?php echo ($row['category_name'] !== "") ? "common" : "" ?> premium-tv-item <?php echo $row['category_name'] ?>">
                    <figure class="item-thumbnail">
                        <img src="img/tv/<?php echo $row['movie_image'] ?>" alt="//">
                        <span class="overthumb"></span>
                        <div class="icons"><a href="movie_profile.php?id=<?php echo $row['movie_id'] ?>" data-toggle="modal"><i class="icon-play"></i></a></div>
                    </figure>
                    <h3><?php echo $row['movie_Name'] ?></h3>
                    <p><?php echo $row['category_name'] ?></p>
                    <p><span><?php echo $row['movie_views']; ?></span> views</p>

                </div>
                <?php
            }
            ?>
        </div>

        <div class="form-group has-feedback has-search" style="width: 30%;">
            <span class="fa fa-search form-control-feedback"></span>
            <input onkeyup="showResult(this.value);" type="text" class="form-control" placeholder="Search">
        </div>
        <div id="movies_list">

        </div>
        <script>
            function showResult(str) {
                if (str.length === 0) {
                    $("#movies_list").html("");
                     return
                } else {
                    $.get("includes/handlers/movie-handler.php?q=" + str, function (data) {
                        $("#movies_list").html(data);
                });
                }
            }
        </script>
    </div>
</article>


<script>

</script>
