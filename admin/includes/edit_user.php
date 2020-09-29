<?php

if(isset($_GET['edit_user_values'])){
    $get_user_id = $_GET['edit_user_values'];
}
        $query = "SELECT * FROM users WHERE `user_id` = $get_user_id";
        $select_users_by_id = mysqli_query($connection, $query);
    
        while($row = mysqli_fetch_assoc($select_users_by_id)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        } 

        if(isset($_POST['edit_user'])) {
            $fuser_firstname = $_POST['user_firstname'];
            $fuser_lastname = $_POST['user_lastname'];
            $fuser_role = $_POST['user_role'];
            $fusername = $_POST['username'];
            $fuser_email = $_POST['user_email'];
            $fuser_password = $_POST['user_password'];

            $query = "SELECT randSalt FROM users";
            $select_randSalt_query = mysqli_query($connection, $query);
            if(!$select_randSalt_query) {
                die("Query failed: " . mysqli_error($connection));
            }
            
            $row = mysqli_fetch_array($select_randSalt_query);
            $salt = $row['randSalt'];
            $hashed_password = crypt($fuser_password, $salt);

            $query = "UPDATE users SET ";
            $query .="username = '{$fusername}', ";
            $query .="user_password = '$hashed_password', ";
            $query .="user_firstname = '{$fuser_firstname}', ";
            $query .="user_lastname = '{$fuser_lastname}', ";
            $query .="user_email = '{$fuser_email}', ";
            $query .="user_role = '{$fuser_role}' ";
            $query .="WHERE user_id = {$get_user_id} ";

            $update_user = mysqli_query($connection, $query);

            confirmQuery($update_user);
            // header("Location: users.php");
        }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        
        <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" id="user_role">
        <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
        <?php

            if($user_role == 'admin') {
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
        ?>
        </select>
    </div>  

    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username;?>" type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email;?>" type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="username">Password</label>
        <input value="<?php echo $user_password;?>" type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>