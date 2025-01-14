<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Category</h2>
        <br><br>

        <?php

        //check whether the id is set or not
        if(isset($_GET['id']))
        {
        //echo "getting the data";
        //get the id
            $id = $_GET['id'];
            
            //query to get the data from the database
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            
            //execute the query
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //fetch the data
                $rows = mysqli_fetch_assoc($res);
                //display the data in form fields
                $title = $rows['title'];
                $current_image = $rows['image_name'];
                $featured = $rows['featured'];
                $active = $rows['active'];
            }
            else
            {
                //redorect to manage category with session message
                $_SESSION['no-category-found'] ="<div class = 'error'> Category not found</div>";
                header('location:'.SITEURL.'admin/manage.category.php');
            }
        }
        else
        {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage.category.php');
        }

            ?>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image != '')
                        {
                            //display current image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px"> 

                            <?php
                        }
                        else
                        {
                            //display the message
                            echo "<div class='error'>Image not Added.</div>";
                        }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes"> Yes
                        <input <?php if($featured=="no"){echo "checked";} ?> type="radio" name="featured" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit']))
{
    //get the values from form
    //echo "Form submitted!";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //update the image if selected
    if(isset($_FILES['image']['name']))
    {
        //get the image details
        $image_name = $_FILES['image']['name'];

        //image available
        if($image_name != "")
        {
            //image available
            //1.upload the new image

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
                
                header('Location:'.SITEURL.'admin/manage.category.php');
                 die(); //stop the process here and redirect to the page again with error message
            }

             //2.remove the current image
            if($current_image!= "")
            {
                 //remove the current image from the folder
        
                $remove_path = "../images/category/".$current_image;

                $remove = unlink($remove_path);

                //check whether the image is removed or not
                //and if the image is not removed then we will stop the process and redirect with the error message
                if($remove==false)
                {
                    //set message
                    $_SESSION['remove'] = "<div class= 'error'>Failed to remove current image.</div>";
                    header('location:'.SITEURL.'admin/manage.category.php');
                    die(); //stop the process here and redirect to the page again with error message
                }
            }
        }
        else
        {
            $image_name = $current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }


    $sql2 = "UPDATE tbl_category SET 
    title = '$title',
    image_name = '$image_name', 
    featured = '$featured',
    active = '$active' 
    WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);
    
    //check whether the query is executed or not
    if ($res2 == true) {
        $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
        header('location:' . SITEURL . 'admin/manage.category.php');
    }
    else{
        $_SESSION['update'] ="<div class='success'>Failed to update admin</div>";
        header('location:'.SITEURL.'admin/manage.category.php?id='.$id);
    }

}
?>


<?php include('partials/footer.php'); ?>