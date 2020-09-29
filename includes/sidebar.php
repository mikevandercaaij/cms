            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <!-- <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                     /.input-group 
                </div> -->

                <?php
                
                if(!isset($_SESSION['user_role'])) {?>
                                        
                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <?php $err_login = '';?>
                            <input class="form-control" type="text" name="username" placeholder="Enter Username">
                        </div>
                        
                        <div class="input-group">
                            <input class="form-control" type="password" name="password" placeholder="Enter Password">
                        
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="login">submit</button>
                        </span>
                        </div>
                    </form> <!-- /.search form -->
                    <!-- /.input-group -->
                </div>

                    <?php } ?>


                <!-- Blog Categories Well -->
                <div class="well">
                    <?php
                        $query = "SELECT * FROM categories"; //LIMIT 3
                        $select_categories_sidebar = mysqli_query($connection, $query);
                    ?>
                    <h4>Category Filter</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <li><a href="index.php">View All Categories</a></a>
                                <?php
                                    while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];

                                        echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Side Widget Well -->
                <?php //include 'includes/widget.php';?>

            </div>