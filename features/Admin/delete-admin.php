<?php

//include constants.php file
include('../config/constants.php'); 

//1. get the id of admin to be deleted
$id= $_GET['id'];

//2. sql query to delete the admin

$sql = "DELETE FROM tbl_admin WHERE id=$id";

// execute the query

$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//check whether the query is executed successfully or not
if($res==true)
{
    $_SESSION['delete'] = "Admin deleted successfully";
    header('location:'.SITEURL.'admin/manage.admin.php'); //redirect to manage admins page to see the updated list of admins
    exit; //to prevent further execution of the code after redirection
}
else{
   // echo "Failed to delete admin";
    $_SESSION['delete'] = "Failed to delete admin";
    header('location:'.SITEURL.'admin/manage.admin.php'); //redirect to manage admins page to see the updated list of admins
    exit; //to prevent further execution of the code after redirection
}
?>