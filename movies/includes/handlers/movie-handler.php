<?php
include '../../config/db.php';
include '../../config/function.php';
if (isset($_GET['target'])) {
    $id = validation_input($_GET['target']);
    $result = mysqli_query($con, "SELECT round(avg(vote_hit),1) as rating FROM votes WHERE vote_on = $id;");
    $row = mysqli_fetch_array($result);
    if ($row['rating'] == "") {
        echo 0;
    } else {
        echo $row['rating'];
    }
}
if (isset($_GET['val']) && isset($_GET['name']) && isset($_GET['on'])) {
    if (empty($_GET['name'])) {
        echo "You need to login";
        return;
    }
    $val = validation_input($_GET['val']);
    $on = validation_input($_GET['on']);
    $by = validation_input($_GET['name']);
    if (!userRated($by, $on, $con)) {
        $result = mysqli_query($con, "INSERT INTO `votes` VALUES (null,'$by','$on','$val',NOW())");
        confirmQuery($result);
        echo "yes";
    } else {
        echo "You rated already. You can't rate twice";
    }
}

// TO get reviews count for movie
if (isset($_GET['type']) && isset($_GET['mov_id'])) {
    switch ($_GET['type']) {
        case "dislike":
            $result = mysqli_query($con, "call get_review('dislike','{$_GET['mov_id']}');");
            confirmQuery($result);
            $row = mysqli_fetch_array($result);
            echo $row['result'];
            mysqli_close($con);
            break;
        case "like":
            $result = mysqli_query($con, "call get_review('like','{$_GET['mov_id']}');");
            confirmQuery($result);
            $row = mysqli_fetch_array($result);
            echo $row['result'];
            mysqli_close($con);
            break;
    }
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}
if (isset($_GET['action']) && isset($_GET['name'])) {
    $name = validation_input($_GET['name']);
    $id = validation_input($_GET['mov_id']);
    switch ($_GET['action']) {
        case "dislike":
            $result = mysqli_query($con, "call insert_review('$name', '$id','dislike')");
            confirmQuery($result);
            $row = mysqli_fetch_array($result);
            if ($row['result'] == "You already reviewed") {
                echo "You can't review twice";
            } else {
                echo "Review has been added";
            }
            mysqli_close($con);
            break;
        case "like":
            $result = mysqli_query($con, "call insert_review('$name', '$id','like')");
            confirmQuery($result);
            $row = mysqli_fetch_array($result);
            if ($row['result'] == "You already reviewed") {
                echo "You can't review twice";
            } else {
                echo "Review has been added";
            }
            mysqli_close($con);
            break;
    }
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}

if (isset($_GET['q'])) {

    $name = $_GET['q'];
    $movies = mysqli_query($con, "select * from movie_info where movie_Name like '%$name%'");
    confirmQuery($movies);
    //Use 225 px width x 315 px height for movie
    if ($row = mysqli_fetch_array($movies)) {
        ?>
        <div class="premium-tv-item">
            <figure class="item-thumbnail">
                <img src="img/tv/<?php echo $row['movie_image'] ?>" alt="//">
                <span class="overthumb"></span>
                <div class="icons"><a href="movie_profile.php?id=<?php echo $row['movie_id'] ?>" data-toggle="modal"><i class="icon-play"></i></a></div>
            </figure>
            <h3><?php echo $row['movie_Name'] ?></h3>
            <p><?php echo $row['category_name'] ?></p>
            <p><span><?php echo $row['movie_views']; ?></span> views</p>
            <?php
            $rating = mysqli_query($con, "SELECT round(avg(vote_hit),1) as rating FROM votes WHERE vote_on = '{$row['movie_id']}'");
            $row = mysqli_fetch_array($rating);
            if ($row['rating'] == "") {
                ?>
                <strong><em><i class="icon-star"></i></em></strong>
                <?php
            }
            else {
                echo "<strong>";
                $count = $row['rating'];
                for ($i = 1; $i <= $row['rating']; $i++) {
                    ?>
                    <em><i class="icon-star"></i></em>
                        <?php
                    }
                    echo "</strong>";
                }
                ?>
        </div>
        <?php
    }
    else {
        echo "Movie doesn't exist";
    }
}

//checking if user rated or not
function userRated($username, $movie_id, $con) {
    $result = mysqli_query($con, "select vote_id from votes where vote_by='$username' AND vote_on='$movie_id'");
    confirmQuery($result);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        return true;
    } else {
        return false;
    }
}
