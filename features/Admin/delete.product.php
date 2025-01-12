<?php

    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //process to delete

        //1. get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. remove the image if available
        //check whether the image is available or not and delete only if availabe
        if($image_name!= "")
        {
            $path = "../images/products/".$image_name;

            //remove the image file from the folder
            $remove = unlink($path);

            //check whether the image is removed or not
            //and if the image is not removed then we will stop the process and redirect with the error message
            if($remove==false)
            {
                //set message
                $_SESSION['remove'] = "<div class='error'>Failed to remove image.</div>";
                header('location:'.SITEURL.'admin/manage.product.php');
                die(); //stop the process here and redirect to the page again with error message
            }
        }
        //3. remove the record from the database
        //sql query to delete the record from the database
        $sql = "DELETE FROM tbl_product WHERE id = $id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is deleted from database or not
        if($res==true)
        {
            //success message
            $_SESSION['delete'] = "<div class='success'>Product deleted successfully.</div>";
            header('location: '.SITEURL.'admin/manage.product.php');
        }
        else
        {
            //error message
            $_SESSION['delete'] = "<div class='error'>Failed to delete product.</div>";
            header('location: '.SITEURL.'admin/manage.product.php');
        }
    }
    else
    {
        //redirect to manage product page
        $_SESSION['unauthorized']="<div class='error'>Unauthorized Access.</div>";
        header('location: '.SITEURL.'admin/manage.product.php');
    }



?>