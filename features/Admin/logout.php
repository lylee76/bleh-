<?php
//iinclude constants.php for siteurl
include('../config/constants.php'); 
//1.destroy the session
session_destroy();//unsets $_SESSION['user]

//2.redirect to login page

header('location:'.SITEURL.'admin/login.php');
?>

//Note: In real-world scenario, you should also delete all the session data stored in the database (tbl_admin_sessions) related to the logged-in admin.

