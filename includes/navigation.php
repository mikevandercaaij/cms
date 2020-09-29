    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="https://www.mikevandercaaij.nl/cms/index.php">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right"> 
                <?php

                    if(isset($_GET['p_id'])){
                        if(isset($_SESSION['user_role'])){
                            $the_get_id = $_GET['p_id'];
                            if($_SESSION['user_role'] === 'admin' && $the_get_id){
                                echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_get_id}'>Edit Post</a></li>"; 
                            } else {
                                echo "";
                            }
                        }    
                    }

                    if(isset($_SESSION['user_role'])){
                        if($_SESSION['user_role'] === 'admin') {
                            echo "<li><a href='admin'>Admin</a></li>";
                            echo "<li><a href='create_blog.php'>Create Blog</a></li>";
                            //dropdown
                            echo "<li style='margin-right:15px;' class='dropdown'>";
                            echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'></i> {$_SESSION['firstname']}<b class='caret'></b></a>";
                            echo "<ul class='dropdown-menu'>";
                            echo "<li>";
                            echo "<a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>";
                            echo "</li>";
                            echo "</ul>";
                            echo "</li>";
                            //dropdown end
                        } elseif($_SESSION['user_role'] === 'subscriber') {
                            //dropdown
                            echo "<li><a href='create_blog.php'>Create Blog</a></li>";
                            echo "<li style='margin-right:15px;' class='dropdown'>";
                            echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'></i> {$_SESSION['firstname']}<b class='caret'></b></a>";
                            echo "<ul class='dropdown-menu'>";
                            echo "<li>";
                            echo "<a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>";
                            echo "</li>";
                            echo "</ul>";
                            echo "</li>";
                            //dropdown end
                        } else {
                            echo "";
                        }
                    } else {
                        echo "<li style='margin-right:15px;'><a href='registration.php'>Register</a></li>";
                    }
                ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
    </nav>
