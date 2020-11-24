<?php
/*
 * This handler for control panel pages, to get details from db and to update records      TABLE HANDLER
 */
include '../../config/db.php';
include '../../function.php';

/* for searching */
if (isset($_GET['search_source']) && isset($_GET['key'])) {
    $source = validation_input($_GET['search_source']);
    $key = validation_input($_GET['key']);
    switch ($source) {
        case "users.php":
            $result = mysqli_query($con, "Select * from users where user_type != 'Developer' AND user_name like '%{$key}%'");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['user_id']; ?></th>
                    <th><a href="profile.php?target=<?php echo $row['user_name']; ?>"><?php echo $row['user_name']; ?></a></th>
                    <th><img src="../../img/profile/<?php echo $row['user_pic']; ?>" width="100" height="100"></th>
                    <th><?php echo $row['user_FName']; ?></th>
                    <th><?php echo $row['user_LName']; ?></th>
                    <th><?php echo $row['user_email']; ?></th>
                    <th><?php echo $row['user_email']; ?></th>
                    <th><?php echo $row['user_type']; ?></th>
                    <th>
                        <a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['user_id']; ?>')">Delete</a><br>
                    </th>

                </tr>
                <?php
            }
            break;
        case "movies.php":
            $result = mysqli_query($con, "Select * from movies "
                    . "inner join categories on movies.movie_category_id=categories.category_id where movies.movie_name like '%{$key}%'");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['movie_id']; ?></th>
                    <th><?php echo $row['movie_Name']; ?></th>
                    <th><?php echo substr($row['movie_URL'], 0, 20) . "..."; ?></th>
                    <th><img src="../../img/tv/<?php echo $row['movie_image']; ?>" width="100" height="100"></th>
                    <th><?php echo $row['movie_director']; ?></th>
                    <th><?php echo $row['movie_length']; ?></th>
                    <th><?php echo $row['movie_release_date']; ?></th>
                    <th><?php echo $row['movie_language']; ?></th>
                    <th><?php echo substr($row['movie_description'], 0, 40) . "..."; ?></th>
                    <th><?php echo $row['movie_views']; ?></th>
                    <th><?php echo $row['movie_added_by']; ?></th>
                    <th><?php echo $row['category_name']; ?></th>
                    <th>
                        <a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['movie_id']; ?>')">Delete</a><br>
                    </th>
                    <th>
                        <a href="<?php echo $source . "?id=" . $row['movie_id'] ?>">Edit</a><br>
                    </th>
                </tr>
                <?php
            }
            break;

        case "categories.php":
            $result = mysqli_query($con, "Select * from categories where category_name like '%{$key}%'");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['category_id']; ?></th>
                    <th><?php echo $row['category_name']; ?></th>
                    <th><a href="<?php echo $source . "?id={$row['category_id']}&name={$row['category_name']}"; ?>">Edit</a></th>
                    <th><a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['category_id']; ?>')">Delete</a></th>
                </tr>
                <?php
            }
            break;


        case "reviews.php":
            $result = mysqli_query($con, "Select reviews.review_id, reviews.review_author, reviews.review_type, movies.movie_name "
                    . "from reviews inner join movies on reviews.review_on=movies.movie_id where reviews.review_author like '%{$key}%'");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['review_id']; ?></th>
                    <th><?php echo $row['review_author']; ?></th>
                    <th><?php echo $row['movie_name']; ?></th>
                    <th><?php echo $row['review_type']; ?></th>
                    <th><a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['review_id']; ?>')">Delete</a></th>
                </tr>
                <?php
            }
            break;
    }
}
/* for getting data to tables*/
if (isset($_GET['getData'])) {
    $source = validation_input($_GET['getData']);
    switch ($source) {
        case "users.php":
            $result = mysqli_query($con, "Select * from users where user_type != 'Developer'");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['user_id']; ?></th>
                    <th><a href="profile.php?target=<?php echo $row['user_name']; ?>"><?php echo $row['user_name']; ?></a></th>
                    <th><img src="../../img/profile/<?php echo $row['user_pic']; ?>" width="100" height="100"></th>
                    <th><?php echo $row['user_FName']; ?></th>
                    <th><?php echo $row['user_LName']; ?></th>
                    <th><?php echo $row['user_email']; ?></th>
                    <th><?php echo $row['user_type']; ?></th>
                    <th>
                        <a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['user_id']; ?>')">Delete</a><br>
                    </th>
                </tr>
                <?php
            }
            break;
        case "movies.php":
            $result = mysqli_query($con, "Select * from movies "
                    . "inner join categories on movies.movie_category_id=categories.category_id");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['movie_id']; ?></th>
                    <th><?php echo $row['movie_Name']; ?></th>
                    <th><?php echo substr($row['movie_URL'], 0, 20) . "..."; ?></th>
                    <th><img src="../../img/tv/<?php echo $row['movie_image']; ?>" width="100" height="100"></th>
                    <th><?php echo $row['movie_director']; ?></th>
                    <th><?php echo $row['movie_length']; ?></th>
                    <th><?php echo $row['movie_release_date']; ?></th>
                    <th><?php echo $row['movie_language']; ?></th>
                    <th><?php echo substr($row['movie_description'], 0, 40) . "..."; ?></th>
                    <th><?php echo $row['movie_views']; ?></th>
                    <th><?php echo $row['movie_added_by']; ?></th>
                    <th><?php echo $row['category_name']; ?></th>
                    <th>
                        <a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['movie_id']; ?>')">Delete</a><br>
                    </th>
                    <th>
                        <a href="<?php echo $source . "?id=" . $row['movie_id'] ?>">Edit</a><br>
                    </th>
                </tr>
                <?php
            }
            break;
        case "categories.php":
            $result = mysqli_query($con, "Select * from categories");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['category_id']; ?></th>
                    <th><?php echo $row['category_name']; ?></th>
                    <th><a href="<?php echo $source . "?id={$row['category_id']}&name={$row['category_name']}"; ?>">Edit</a></th>
                    <th><a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['category_id']; ?>')">Delete</a></th>
                </tr>
                <?php
            }
            break;
        case "reviews.php":
            $result = mysqli_query($con, "Select reviews.review_id, reviews.review_author, reviews.review_type, movies.movie_name "
                    . "from reviews inner join movies on reviews.review_on=movies.movie_id");
            confirmQuery($result);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th><?php echo $row['review_id']; ?></th>
                    <th><?php echo $row['review_author']; ?></th>
                    <th><?php echo $row['movie_name']; ?></th>
                    <th><?php echo $row['review_type']; ?></th>
                    <th><a onclick="setUserChanges('delete', '<?php echo $source; ?>', '<?php echo $row['review_id']; ?>')">Delete</a></th>
                </tr>
                <?php
            }
            break;
    }
}
/*
 * perform actions on the source page could be users.php or movies.php etc    TABLE HANDLER
 */
if (isset($_GET['action'])) {
    $source = validation_input($_GET['source']);
    switch ($source) {
        case "users.php":
            switch ($_GET['action']) {
                case "delete":
                    $id = validation_input($_GET['id']);
                    confirmQuery(mysqli_query($con, "delete from users where user_id={$id}"));
                    break;
            }
            break;


        case "categories.php":
            switch ($_GET['action']) {
                case "delete":
                    $id = validation_input($_GET['id']);
                    confirmQuery(mysqli_query($con, "delete from categories where category_id={$id}"));
                    break;
            }
            break;

        case "movies.php":
            switch ($_GET['action']) {
                case "delete":
                    $id = validation_input($_GET['id']);
                    confirmQuery(mysqli_query($con, "delete from movies where movie_id={$id}"));
                    break;
            }
            break;



        case "reviews.php":
            switch ($_GET['action']) {
                case "delete":
                    $id = validation_input($_GET['id']);
                    confirmQuery(mysqli_query($con, "delete from reviews where review_id={$id}"));
                    break;
            }
            break;


    }
}

/*
 * FORM HANDLER
 */
if (isset($_POST['cat_name'])) {
    $id = validation_input($_POST['cat_id']);
    $name = validation_input($_POST['cat_name']);
    $sql = "";
    if ($id == "") {
        $sql = "insert into categories values (null, '$name')";
    } else {
        $sql = "update categories set category_name='$name' where category_id='$id'";
    }
    if (ctype_alpha($name)) {
        confirmQuery(mysqli_query($con, $sql));
    } else {
        echo "Only characters are allowed";
    }
}
