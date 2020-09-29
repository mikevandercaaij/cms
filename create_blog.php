<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

if(!isset($_SESSION['user_role'])) {
    header("Location: index.php");
}

if(isset($_POST['create_post'])) {

    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = urlencode($_POST['post_content']);
    $post_date = date('d-m-y');

    if(!empty($post_title) && !empty($post_image) && !empty($post_content)){
        
        move_uploaded_file($post_image_temp, "images/{$post_image}");
        
        $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$_SESSION['username']}',now(), '{$post_image}', 
        '{$post_content}', '{$post_tags}', 0, 'draft') ";
        
        
        $create_post_query = mysqli_query($connection, $query);
        
        if(!$create_post_query) {
            die("Query failed: " . mysqli_error($connection));
        }
        
        // header("Location: posts.php");
        
        $the_post_id = mysqli_insert_id($connection);
        
        echo "<div style='margin: 0 15px 0 15px;' class='alert alert-success' role='alert'>Post Created succesfully: Wait for the administator to approve your post. In the meantime <a href='index.php'>check out</a> some other posts!</div>";
        
        } else {
            echo "<div style='margin: 0 15px 0 15px;' class='alert alert-danger' role='alert'>Fill in all fields!</div>";
        }
    } 
    
    ?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>
<div class="col-md-4 col-md-offset-4">
    <h2>Create your own post!</h2>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="post_title">Post Title</label>
            <input type="text" class="form-control" name="post_title">
        </div>


        <div class="form-group">
            <label for="post_category">Post Category</label><br>
            <select name="post_category" id="post_category">
                <?php
                    $query = "SELECT * FROM categories";
                    $query_post_selecter = mysqli_query($connection, $query);
    
                    while($row = mysqli_fetch_assoc($query_post_selecter)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
    
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="post_image">Post Image</label>
            <input type="file" name="post_image">
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags" placeholder="Divide the tags with ','">
        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_post" value="Create post">
        </div>
    </form>
</div>

<?php include "includes/footer.php";?>