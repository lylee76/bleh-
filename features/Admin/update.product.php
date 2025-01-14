<?php include('partials/header.php'); ?>

<?php

    //check whethet the id is set or not
    if(isset($_GET['id']))
    {
        //get the id
        $id = $_GET['id'];

        //query to get the data from the database
        $sql2 = "SELECT * FROM tbl_product WHERE id=$id";

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //fetch the data
        $row2 = mysqli_fetch_assoc($res2);

        //get individual product
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image= $row2['image_name'];
        $current_category= $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //redirect to the products page
        header('location:'.SITEURL.'admin/product.php');
    }

?>



<div class="main-content">
    <div class="wrapper">
        <h2>Update Product</h2>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                </td>
            </tr>
            
            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price;?>" >
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php 
                        // Check if current image exists
                        if($current_image =="")
                        {
                            //image not available
                            echo "<div class='error'>Image not available.</div>";
                    
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL;?>images/products/<?php echo $current_image;?>" width="100px">

                            <?php
                        }

                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                        <?php 
                            // Query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                            // Execute the query and store the result in $res variable
                            $res = mysqli_query($conn, $sql);

                            // Count the rows to check whether categories are available or not
                            $count = mysqli_num_rows($res);

                            // Check whether categories are available
                            if ($count > 0) {
                                // Categories available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    
                                    // Display the category in dropdown menu
                                    // echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    
                                    <option <?php if($current_category==$category_id) {echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                    
                                    <?php
                                }
                            }
                            else
                            { 
                                // Categories not available
                                echo "<option value='0'>No Category Available</option>";    
                            }
                        ?>
                    </select>
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
                <td>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="submit" name="submit" value="Update Product" class="btn-secondary">
                </td>
            </tr>


        </table>
        </form>

        <?php
        // check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //1.get all form data
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. upload the image if selected

                // check whether the new image is uploaded or not
                if(isset($_FILES['image']['name']))
                {
                    //upload button clicked
                    $image_name = $_FILES['image']['name'];//new image name

                    //check whether the file is available or not
                    if($image_name!= "")
                    {
                        //image available
                        //A. uploading new image

                        //rename the image

                        //a. get the extension of the image
                        $ext = end(explode('.', $image_name));
                        
                        //b. rename the image
                        $image_name = "product_".rand(0000,9999).'.'.$ext;
                        
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/products/".$image_name;
                        
                        //upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //check whether the image is upload or not
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            //redirect to the update page
                            header('location:'.SITEURL.'admin/manage.product.php');
                            die();
                        }
                        //3.remove the image if new image is uploaded and current image exists
                        //B. remove current image if available
                        if($current_image!= "")
                        {
                            //remove the current image
                            $remove_path = "../images/products/".$current_image;
                            $remove = unlink($remove_path);

                            //check whether the image is removed or not
                            if($remove==false)
                            {   
                                //failed to remove the image
                                //set message
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                //redirect to the update page
                                header('location:'.SITEURL.'admin/manage.product.php');
                                die();

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
                    //use the current image
                    $image_name = $current_image;
                } 
                
                //update the product in the database
                $sql3 = "UPDATE tbl_product SET title='$title', description='$description', price=$price, image_name='$image_name', category_id='$category', featured='$featured', active='$active' WHERE id=$id";

                //execute the query
                $res3 = mysqli_query($conn, $sql3);

                //check whether the query is executed or not
                if($res3==true)
                {
                    //set message
                    $_SESSION['update'] = "<div class='success'>Product updated successfully.</div>";
                    //redirect to the manage products page
                    header('location:'.SITEURL.'admin/manage.product.php');
                    die();
                }
                else
                {
                    //set message
                    $_SESSION['update'] = "<div class='error'>Failed to update product.</div>";
                    //redirect to the update page
                    header('location:'.SITEURL.'admin/update.product.php?id='.$id);
                    die();
                }
            }           
            
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?> 