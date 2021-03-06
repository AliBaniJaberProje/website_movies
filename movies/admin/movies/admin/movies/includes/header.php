<header>
    <nav class="navbar sticky" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="//"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav menu-effect">

                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="index.php#menu_movies">Movies</a></li>
                    <?php
                    if (!isset($_SESSION['username']) && !isset($_SESSION['role'])) {
                        ?>
                        <li><a href="register.php">Register</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle exclude" data-toggle="dropdown">Login <span class="caret"></span></a>
                            <form action="index.php" method="POST" class="dropdown-menu form-login" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="login-name">User Email</label>
                                    <input name='user-email' type="text" class="form-control" id="login-name" placeholder="User Email" required="">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="login-pass">Password</label>
                                    <input name='user-pass' type="password" class="form-control" id="login-pass" placeholder="Password" required="">
                                </div>
                                <button name='signIn' type='submit' class="btn">Login</button>
                            </form>

                        </li>
                        <?php
                    }
                    else if (is_Developer($loggedIn)) {
                        ?>
                        <li><a href="admin/pages/dashboard.php">Control Panel</a></li>
                        <li><a href="logout.php">Log out</a></li>
                        <?php
                    } else {//reguler
                        ?>
                        <li><a href="logout.php">Log out</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</header>
