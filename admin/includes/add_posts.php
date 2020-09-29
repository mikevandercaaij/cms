<?php

if(isset($_POST['create_post'])) {

$post_title = $_POST['post_title'];
$post_author = $_POST['post_author'];
$post_category_id = $_POST['post_category'];
$post_status = $_POST['post_status'];

$post_image = $_FILES['post_image']['name'];
$post_image_temp = $_FILES['post_image']['tmp_name'];

$post_tags = $_POST['post_tags'];
$post_content = $_POST['post_content'];
$post_date = date('d-m-y');
// $post_comment_count = 4;

move_uploaded_file($post_image_temp, "../images/{$post_image}");

$query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
$query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}',now(), '{$post_image}', 
'{$post_content}', '{$post_tags}', 0, '{$post_status}') ";


$create_post_query = mysqli_query($connection, $query);

confirmQuery($create_post_query);
// header("Location: posts.php");

$the_post_id = mysqli_insert_id($connection);

echo "<div class='alert alert-success' role='alert'>Post Created: <a href='../post.php?p_id={$the_post_id}'>View Posts</a> or <a href='posts.php'>See All Posts</a></div>";

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>


    <div class="form-group">
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
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="post_status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish post">
    </div>
</form>