<?php
include('../config/constants.php');

// Check whether the id and image_name values are set or not
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // Get the value and delete
    //echo "get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file if available
    if($image_name != "")
    {
        //image is available  so remove it
        $path = "../images/category/".$image_name;
        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if($remove==false)
        {
            //set session message
            $_SESSION['remove'] = "<div class= 'error'>Failed to remove category image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage.category.php');
            die(); //stop the process here and redirect to the page again with error message
        }

    }
    //sql query to delete the record from the database
    $sql = "DELETE FROM tbl_category WHERE id = $id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the data is deleted from database or not
    if($res==true)
    {
        //success message
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage.category.php');
    }
    else
    {
        //error message
        $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
        header('location:'.SITEURL.'admin/manage.category.php');

    }


} else
{
    header('location:'.SITEURL.'admin/manage.category.php');
}
?>

