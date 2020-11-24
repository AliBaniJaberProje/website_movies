<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../../img/profile/<?php echo $moderator->getUserPic(); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $moderator->getUserName(); ?></p>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php
        $current = basename($_SERVER['PHP_SELF']);
        ?>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview menu-open">
            <li>
                <a href="../../index.php">
                    <i class="fa fa-dashboard"></i> <span>Back to website</span>
                </a>
            </li>
            <li class="<?php echo ($current == "dashboard.php") ? 'active' : '' ?>">
                <a href="../index.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <?php
            if (is_Developer($moderator->getUserName())) {
                ?>

                <li class="<?php echo ($current == "users.php") ? 'active' : '' ?>">
                    <a href="users.php"><i class="fa fa-circle-o"></i>
                        Users
                    </a>
                </li>
                <li class="<?php echo ($current == "categories.php") ? 'active' : '' ?>">
                    <a href="categories.php"><i class="fa fa-circle-o"></i> 
                        Categories
                    </a>
                </li>

                <?php
            }
            ?>
            <li class="<?php echo ($current == "movies.php") ? 'active' : '' ?>">
                <a href="movies.php"><i class="fa fa-circle-o"></i> 
                    Movies
                </a>
            </li>

            <li class="<?php echo ($current == "reviews.php") ? 'active' : '' ?>">
                <a href="reviews.php"><i class="fa fa-circle-o"></i> 
                    Reviews
                </a>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
