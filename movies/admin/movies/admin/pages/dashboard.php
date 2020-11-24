<?php include './includes/head.php';
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include './includes/header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include './includes/side-nav.php';// current is deferant her ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-film"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="font-size: 13px;">Movies</span>
                                <span class="info-box-number" id="movies_count"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Users</span>
                                <span class="info-box-number" id="users_count"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->

                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Reviews</span>
                                <span class="info-box-number" id="likes_count"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- /.box -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- USERS LIST -->
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Latest Users</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                        <ul id="dash_info" class="users-list clearfix">
                                            <?php
                                            $result = mysqli_query($con, "select user_pic, user_name, user_email from users order by user_id DESC limit 10");
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <li>
                                                    <img width='50' height='50' src='../../img/profile/<?php echo $row['user_pic']; ?>' alt='User Image'>
                                                    <a class='users-list-name' href='#'><?php echo $row['user_name']; ?></a>
                                                    <span class='users-list-date'><?php echo $row['user_email']; ?></span>
                                                </li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
                                        <!-- /.users-list -->
                                    </div>
                                    <!-- /.box-body -->

                                        <div class="box-footer text-center">
                                            <a href="users.php" class="uppercase">View All Users</a>
                                        </div>
                                    <!-- /.box-footer -->
                                </div>
                                <!--/.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Movies</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Movie Name</th>
                                                <th>Movie Length</th>
                                                <th>Movie Added By</th>
                                                <th>Movie Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($con, "select movies.movie_name, movies.movie_length, movies.movie_added_by "
                                                    . ", categories.category_name from movies inner join categories on categories.category_id = movies.movie_category_id "
                                                    . "order by movies.movie_id DESC limit 10");
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <tr>
                                                    <th><?php echo $row['movie_name']; ?></th>
                                                    <th><?php echo $row['movie_length']; ?></th>
                                                    <th><?php echo $row['movie_added_by']; ?></th>
                                                    <th><?php echo $row['category_name']; ?></th>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="movies.php" class="btn btn-sm btn-default btn-flat pull-right">View All Movies</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>

                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>       
        <!-- /.content-wrapper -->

        <?php include './includes/footer.php'; ?>
