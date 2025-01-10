<?php include('partials/header.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h2>Add Category</h2>
        <br>

    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing session messages
        }

        if(isset($_SESSION['uplaod']))
        {
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing session messages
        }
    ?>
        
<!--Add category form starts here-->
<form action="" method="post" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" placeholder="Enter category title">
            </td>
        </tr>
        <tr>
            <td>Select Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <input type="radio" name="featured" value="yes">Yes
                <input type="radio" name="featured" value="no">No
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name="Active" value="yes">Yes
                <input type="radio" name="Active" value="no">No
            </td>
        </tr>
        <br><br>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>
    </table>
</form>

<!--Add category form ends here-->

<?php

// check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    $title = $_POST['title'];

    //for radio input type, we need to check whether the button is selected or not
    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
    else
    {
        $featured = "no";
    }
    
    if(isset($_POST['Active']))
    {
        $active = $_POST['Active'];
    }
    else
    {
        $active = "no";
    }

    //check whether is selected or not and set value for the image name accordingly
    //print_r($_FILES['image']);

    //die();//break the code here

    if(isset($_FILES['image']['name']))
    {
        //upload the image
        //to upload the image we need image name,source path and destination path
        $image_name = $_FILES['image']['name'];

        //auto rename the image
        $ext = end(explode(':',$image_name));

        //rename the image
        $image_name = "category_".rand(000,999).'.'.$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/".$image_name;

        //upload the image
        $upload = move_uploaded_file($source_path,$destination_path);

        //check whether the image is uploaded or not
        //and if the image is not uploaded then we will stop the process and redirect with the error message
        if($upload == false)
        {
            //set message
            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
            header('Location:'.SITEURL.'admin/add.category.php');
            die(); //stop the process here and redirect to the page again with error message
        }
    }
    else
    {
        $image_name = "";

    }
    //sql query to save the data into the database
    $sql = "INSERT INTO tbl_category(title, image_name, featured, active) VALUES('$title', '$image_name', '$featured', '$active')";

    //execute the query and save the data into the database
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        //category add sccessful
        $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
        header('Location:'.SITEURL.'admin/manage.category.php');
    }
    else
    {
        //failed to add category
        $_SESSION['add'] = "<div class='error'>Failed to category.</div>";
        header('Location:'.SITEURL.'admin/add.category.php');
    }
}
?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

