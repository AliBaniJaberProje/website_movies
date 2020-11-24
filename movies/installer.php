<?php
session_start();
$flag = 0;
$db_schema_sucess = $db_create_success = "";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = '';
    $db_name = "movies4";
	setcookie("db_name", $db_name, time() + (10 * 365 * 24 * 60 * 60));
    setcookie("db_user", $db_user, time() + (10 * 365 * 24 * 60 * 60));
    setcookie("db_pass", $db_pass, time() + (10 * 365 * 24 * 60 * 60));
    setcookie("db_host", $db_host, time() + (10 * 365 * 24 * 60 * 60));
    $con = mysqli_connect($db_host, $db_user, $db_pass);
    if (!$con) {
        $db_con_error = "Failed to connect: " . mysqli_connect_error($con);
        die($db_con_error);
    } else {
        $flag = 1;
    }
    if ($flag == 1) {
        if (!mysqli_query($con, "create database " . $db_name)) {
            $db_create_error = "Failed to create the db " . mysqli_error($con);
        } else {
            $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            $db_create_success = "Database has been created successfully";
        }
        $sql = "
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
);
CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_Name` varchar(255) NOT NULL,
  `movie_URL` text NOT NULL,
  `movie_image` varchar(255) NOT NULL,
  `movie_director` varchar(255) NOT NULL,
  `movie_length` varchar(10) NOT NULL,
  `movie_release_date` date NOT NULL,
  `movie_language` varchar(255) NOT NULL,
  `movie_description` text NOT NULL,
  `movie_views` int(11) NOT NULL,
  `movie_added_by` varchar(255) NOT NULL,
  `movie_category_id` int(11) DEFAULT NULL
);
CREATE TABLE `movie_info` (
`movie_id` int(11)
,`movie_views` int(11)
,`movie_Name` varchar(255)
,`movie_image` varchar(255)
,`category_name` varchar(255)
);

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_author` varchar(255) NOT NULL,
  `review_on` int(11) NOT NULL,
  `review_type` enum('like','dislike') DEFAULT NULL
);

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_pic` text NOT NULL,
  `user_FName` varchar(255) NOT NULL,
  `user_LName` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_type` enum('Developer','Regular') DEFAULT 'Regular'
);
INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_pic`, `user_FName`, `user_LName`, `user_email`, `user_type`) VALUES
(1, 'root', '123456789', 'avatar5.png', 'Root1', 'Root2', 'root@gmail.com', 'Developer');
CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `vote_by` varchar(255) NOT NULL,
  `vote_on` int(11) NOT NULL,
  `vote_hit` int(11) NOT NULL,
  `vote_date` date NOT NULL
);


DROP TABLE IF EXISTS `movie_info`;
CREATE VIEW `movie_info`  AS  select `movies`.`movie_id` AS `movie_id`,`movies`.`movie_views` AS `movie_views`,`movies`.`movie_Name` AS `movie_Name`,`movies`.`movie_image` AS `movie_image`,`categories`.`category_name` AS `category_name` from (`movies` join `categories` on((`movies`.`movie_category_id` = `categories`.`category_id`))) ;
;
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `movie_added_by` (`movie_added_by`),
  ADD KEY `movie_category_id` (`movie_category_id`);
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_author` (`review_author`),
  ADD KEY `review_on` (`review_on`);
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `like_author_fk` (`vote_by`),
  ADD KEY `movie_id_fk` (`vote_on`);

ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`movie_added_by`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`movie_category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`review_author`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`review_on`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `votes`
  ADD CONSTRAINT `like_author_fk` FOREIGN KEY (`vote_by`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_id_fk` FOREIGN KEY (`vote_on`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;";
        if (!mysqli_multi_query($con, $sql)) {
            $db_schema_error = "Database objects have not been created successfully , " . mysqli_error($con);
        } else {
            $db_schema_sucess = "Database schema has been created successfully";
        }
		mysqli_close($con);
		$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $sql = "CREATE PROCEDURE `get_review`(IN `type` VARCHAR(255), IN `target` VARCHAR(10))
   NO SQL
BEGIN
declare
 result int;
if type LIKE 'like' THEN
 select count(review_id) into result from reviews where     review_on=target AND review_type='like';
ELSEIF type LIKE 'dislike' THEN
 select count(review_id) into result from reviews where     review_on=target AND review_type='dislike';
END IF;
select result;
END";
        if (!mysqli_multi_query($con, $sql)) {
            $db_schema_error = "Database objects have not been created successfully , " . mysqli_error($con);
        } else {
            $db_schema_sucess = "Database schema has been created successfully";
        }
		mysqli_close($con);
		$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $sql = "CREATE PROCEDURE `insert_review`(IN `author` VARCHAR(255), IN `target` VARCHAR(10), IN `type` VARCHAR(255))
   NO SQL
BEGIN
declare
 flag int;
if type LIKE 'like' THEN
 select count(review_id) into flag from reviews where     review_on=target AND review_author=author;
ELSEIF type LIKE 'dislike' THEN
 select count(review_id) into flag from reviews where     review_on=target AND review_author=author;
END IF;
if flag > 0 THEN
 select 'You already reviewed' as result;
else
 insert into reviews values (null, author, target, type);
 select 'Review added' as result;
end if;
END";
        if (!mysqli_multi_query($con, $sql)) {
            $db_schema_error = "Database objects have not been created successfully , " . mysqli_error($con);
        } else {
            $db_schema_sucess = "Database schema has been created successfully";
        }
		mysqli_close($con);
		$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $sql = "CREATE PROCEDURE `login`(IN `u_email` VARCHAR(255), IN `u_pass` VARCHAR(255))
   NO SQL
BEGIN
declare
 em varchar(255);
DECLARE
 pass varchar(255);
DECLARE
 role varchar(255);
DECLARE
 username varchar(255);
 
 select user_email, user_password, user_name, user_type INTO
 em, pass,username, role from users where user_email=u_email AND user_password=u_pass;
  if ISNULL(em) AND ISNULL(pass) THEN
     SET username = 'NAN';
  END IF;
         select username,role;
END";
        if (!mysqli_multi_query($con, $sql)) {
            $db_schema_error = "Database objects have not been created successfully , " . mysqli_error($con);
        } else {
            $db_schema_sucess = "Database schema has been created successfully";
        }
    }

?>

