<?php

if(isset($_POST['create_user'])) {
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_role = $_POST['user_role'];

// $post_image = $_FILES['post_image']['name'];
// $post_image_temp = $_FILES['post_image']['tmp_name'];

$username = $_POST['username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
// $post_date = date('d-m-y');
// $post_comment_count = 4;
// move_uploaded_file($post_image_temp, "../images/{$post_image}");

$query = "INSERT INTO users (user_firstname, user_lastname, user_role, username, user_email, user_password, user_image) ";
$query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', 
'{$user_email}', '{$user_password}', '') ";


$create_user_query = mysqli_query($connection, $query);

confirmQuery($create_user_query);
// header("Location: users.php");
echo "<div class='alert alert-success' role='alert'>User Created: <a href='users.php'>View Users</a></div>";
}

?>

<form action="" method="post" enctype="multipart/form-data">

  

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" id="">
            <option value="subscriber">Choose options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>  

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="username">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

</form>