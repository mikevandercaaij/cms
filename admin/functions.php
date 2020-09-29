<?php

function confirmQuery($result) {
global $connection;
    if(!$result) {
        die("QUERY FAILED <br>" . mysqli_error($connection));
    }
}

function insert_categories() {
    global $connection;
    if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)) {
            echo "<p style='color:red; font-weight:bold;'>This field should not be empty!</p>";
        } 
        // elseif(strlen($cat_title) < 3) {
        //     echo "<p style='color:red; font-weight:bold;'>Category title has to be longer than 3 characters!</p>";
        //  }
         else {
            $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}')";
            $query_insert_category = mysqli_query($connection, $query);

            if(!$query_insert_category) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }   
}

function findAllCategories() {
    global $connection;
// FIND ALL CATEGORIES QUERY
    $query = "SELECT * FROM categories";
    $query_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($query_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td class='text-center'>{$cat_id}</td>";
        echo "<td class='text-left'>{$cat_title}</td>";
        echo "<td class='text-center'><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td class='text-center'><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function deleteCategories() {
global $connection;

    if(isset($_GET['delete'])) {
        $get_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}


function findAllPosts() {
global $connection;
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

<td class='text-center'><input id="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id;?>">
</td>

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
        echo "<td class='text-center'><a class='btn btn-danger' href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function publishPost() {
    global $connection;
    
        if(isset($_GET['publish'])) {
            $post_id = $_GET['publish'];
    
        $query = "UPDATE posts SET post_status = 'published' WHERE post_id = {$post_id}";
        $publish_post_query = mysqli_query($connection, $query);
        header("Location: posts.php");
        }
    }

function draftPost() {
    global $connection;
    
        if(isset($_GET['draft'])) {
            $post_id = $_GET['draft'];
    
        $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$post_id}";
        $draft_post_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
}

function deletePost() {
global $connection;

    if(isset($_GET['delete'])) {
        $post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$post_id}";
    $delete_post_query = mysqli_query($connection, $query);
    header("Location: posts.php");
    }
}

function findAllComments() {
    global $connection;
        $query = "SELECT * FROM comments ORDER BY comment_id DESC";
        $query_comment_result = mysqli_query($connection, $query);
    
        while($row = mysqli_fetch_assoc($query_comment_result)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

    
            echo "<tr>";
            echo "<td class='text-center'>{$comment_id}</td>";
            echo "<td class='text-center'>{$comment_author}</td>";
            echo "<td class='text-center'>{$comment_content}</td>";     
            echo "<td class='text-center'>{$comment_email}</td>"; 
            echo "<td class='text-center'>{$comment_status}</td>";

            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_id_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td class='text-center'><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            }
            echo "<td class='text-center'>{$comment_date}</td>";
            echo "<td class='text-center'><a class='btn btn-success' href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td class='text-center'><a class='btn btn-warning' href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td class='text-center'><a class='btn btn-danger' href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }
    
    function deleteComment() {
    global $connection;
    
        if(isset($_GET['delete'])) {
            $get_comment_id = $_GET['delete'];
    
        $query = "DELETE FROM comments WHERE comment_id = {$get_comment_id}";
        $delete_post_query = mysqli_query($connection, $query);
        header("Location: comments.php");
        }
    }

    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $get_post_id ";

    function unapproveComment() {
        global $connection;
        
            if(isset($_GET['unapprove'])) {
                $get_comment_id = $_GET['unapprove'];
        
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $get_comment_id";
            $unapprove_comment_query = mysqli_query($connection, $query);
            header("Location: comments.php");
            }
        }

        function approveComment() {
            global $connection;
        
            if(isset($_GET['approve'])) {
                $get_comment_id = $_GET['approve'];
        
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $get_comment_id";
            $approve_comment_query = mysqli_query($connection, $query);
            header("Location: comments.php");
            }
        }


        function findAllUsers() {
            global $connection;
                $query = "SELECT * FROM users";
                $query_user_result = mysqli_query($connection, $query);
            
                while($row = mysqli_fetch_assoc($query_user_result)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_role = $row['user_role'];
                    
            
                    echo "<tr>";
                    echo "<td class='text-center'>{$user_id}</td>";
                    echo "<td class='text-center'>{$username}</td>";
                    echo "<td class='text-center'>{$user_firstname}</td>";
                    echo "<td class='text-center'>{$user_lastname}</td>";      
                    echo "<td class='text-center'>{$user_email}</td>";
                    echo "<td class='text-center'>{$user_role}</td>";
                    echo "<td class='text-center'><a class='btn btn-primary' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                    echo "<td class='text-center'><a class='btn btn-primary' href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                    echo "<td class='text-center'><a class='btn btn-info' href='users.php?source=edit_user&edit_user_values={$user_id}'>Edit</a></td>";
                    echo "<td class='text-center'><a class='btn btn-danger' href='users.php?delete={$user_id}'>Delete</a></td>";
                    echo "</tr>";
                }
            }

            function deleteUsers() {
                global $connection; 

                if(isset($_GET['delete'])) {
                    $get_user_id = $_GET['delete'];
            
                $query = "DELETE FROM users WHERE user_id = {$get_user_id}";
                $delete_post_query = mysqli_query($connection, $query);
                header("Location: users.php");
                }
            }

            
    function makeUserAdmin() {
        global $connection;
        
            if(isset($_GET['change_to_admin'])) {
                $get_user_id = $_GET['change_to_admin'];
        
                $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $get_user_id";
                $make_user_admin_query = mysqli_query($connection, $query);
                header("Location: users.php");
            }
        }

        function makeUserSub() {
            global $connection;
        
            if(isset($_GET['change_to_sub'])) {
                $get_user_id = $_GET['change_to_sub'];
        
            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $get_user_id";
            $make_user_sub_query = mysqli_query($connection, $query);
            header("Location: users.php");
            }
        }