<?php   
    if(isset($_GET['edit'])){ 
    $get_cat_id = $_GET['edit'];

    $query = "SELECT * FROM categories WHERE cat_id = {$get_cat_id}";
    $query_categories = mysqli_query($connection, $query);
                                        
    while($row = mysqli_fetch_assoc($query_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];  
    ?>  
<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <input class="form-control" type="text" name="cat_title" value="<?php if(isset($cat_title)){ echo $cat_title;} ?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit_edit_category" value="Edit Category">
    </div>
</form> 
<?php }}?>
<?php //UPDATE QUERY
    if(isset($_POST['submit_edit_category'])){
    $the_cat_title = $_POST['cat_title'];

    $query_edit = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$get_cat_id}";
    $query_edit_category = mysqli_query($connection,$query_edit);
    header("Location: categories.php");
    }

?>