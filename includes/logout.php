<?php 
// session_start();

// $_SESSION['username']  =  null;
// $_SESSION['firstname'] =  null;
// $_SESSION['lastname']  =  null;
// $_SESSION['user_role'] =  null;

// header("../index.php");


session_start();
session_unset();
session_destroy();

header("Location: ../index.php");
exit();

?>