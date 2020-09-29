<?php

include('delete_modal.php');

    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options){
                case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_to_published_status = mysqli_query($connection, $query);
                confirmQuery($update_to_published_status);
                break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    confirmQuery($update_to_draft_status);
                break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                    $delete_post_bulk = mysqli_query($connection, $query);
                    confirmQuery($delete_post_bulk);
                break;
            }
        }
    }

?>

<form action="" method='post'>
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4" style="padding:0 0 0 0 !important">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>        
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
            <tr>
                <th class='text-center'><input id="selectAllBoxes" type="checkbox"></th>
                <th class='text-center'>Id</th>
                <th class='text-center'>Author</th>
                <th class='text-center'>Title</th>
                <th class='text-center'>Category</th>
                <th class='text-center'>Status</th>
                <th class='text-center'>Image</th>
                <th class='text-center'>Tags</th>
                <th class='text-center'>Comments</th>
                <th class='text-center'>Date</th>
                <th class='text-center'>View Post</th>
                <th class='text-center'>Publish</th>
                <th class='text-center'>Draft</th>
                <th class='text-center'>Edit</th>
                <th class='text-center'>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM posts";
            $query_post_result = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($query_post_result)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];

                echo "<tr>";
                ?>

                <td class='text-center'><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id;?>"></td>

                <?php
                echo "<td class='text-center'>{$post_id}</td>";
                echo "<td class='text-center'>{$post_author}</td>";
                echo "<td class='text-center'>{$post_title}</td>";
                //echo title ipv id
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                $query_post_selecter = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($query_post_selecter)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<td class='text-center'>{$cat_title}</td>";
                }        
                echo "<td class='text-center'>{$post_status}</td>";
                echo "<td class='text-center'><img style='width:100px; height:auto;' src='../images/{$post_image}'</td>";
                echo "<td class='text-center'>{$post_tags}</td>";
                echo "<td class='text-center'>{$post_comment_count}</td>";
                echo "<td class='text-center'>{$post_date}</td>";
                echo "<td class='text-center'><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td class='text-center'><a class='btn btn-success' href='posts.php?publish={$post_id}'>Publish</a></td>";
                echo "<td class='text-center'><a class='btn btn-warning' href='posts.php?draft={$post_id}'>Draft</a></td>";
                echo "<td class='text-center'><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td class='text-center'><a class='btn btn-danger delete_link' rel='$post_id' href='javascript:void(0)'>Delete</a></td>";
                // echo "<td class='text-center'><a onClick=\" javascript: return confirm('Are you sure you want to delete this post(s)?'); \" class='btn btn-danger' href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
                    <?php deletePost(); ?>
                    <?php publishPost(); ?>
                    <?php draftPost(); ?>
                </tbody>
            </table>
        </form>


        <script>
                $(document).ready(function(){
                    $(".delete_link").on('click', function(){
                        var id = $(this).attr("rel");
                        var delete_url = "posts.php?delete="+ id +" ";

                        $(".modal_delete_link").attr("href", delete_url);
                        
                        $("#myModal").modal('show');
                    });
                });
            
        </script>