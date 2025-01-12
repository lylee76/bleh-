<?php include('partials/header.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h2>Add Product</h2>
        <br><br>
        <?php
            if(isset($_SESSION['uplaod']))
            {
                echo $_SESSION['upload'];//displaying session message
                unset($_SESSION['upload']);//removing session messages
            }
        ?>

        <!-- Add product form starts here-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="Title" placeholder="Enter Product name" required>
                    </td>
                </tr>
                <tr>
                    <td>description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the product." required></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>
                <tr>
                    <td>Product Image:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>Product Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                // Create SQL query to get all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                                // Execute the query and store the result in $res variable
                                $res = mysqli_query($conn, $sql);

                                // Count the rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                // If count is greater than zero, we have categories
                                if($count > 0) {
                                    // Fetch and display all categories
                                    while($rows = mysqli_fetch_assoc($res))
                                    {
                                        // Get individual category data
                                        $id = $rows['id'];
                                        $title = $rows['title'];

                                        // Display each category as an option in the dropdown
                                        echo "<option value='$id'>$title</option>";
                                    }
                                }
                                else
                                {
                                    // We don't have categories
                                    echo "<option value='0'>No category found</option>";
                                }
                            ?>
                        </select>
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

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product " class="btn-secondary">
                    </td>
                </tr>

        </form>

        <?php
            //check whether the submit button is clicked or not
            if(isset($_POST['submit']))
                {
                    //get all form data
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $image = $_FILES['image']['name'];
                    $category = $_POST['category'];

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

                    //check whether the select image is clicked or not and upload the image if the image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image details
                        $image_name = $_FILES['image']['name'];

                        //upload the image only if the image is selected
                        if($image_name!= "")
                        {
                            //image available
                            //1.upload the new image
                            $ext = end(explode(':', $image_name));

                            //rename the image
                            $image_name = "product_".rand(0000,9999).'.'.$ext;

                            //upload image
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/products/".$image_name;

                            $upload = move_uploaded_file($source_path, $destination_path);

                            //if failed to upload image then add an error message and stop the process
                            if($upload == false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                header('location:'.SITEURL.'admin/add.product.php');
                                die();
                            }

                        }
                    }
                    else
                    {
                        $image_name ="";
                    }
                    
                    //create sql query to insert product data into the database
                    $sql2 = "INSERT INTO tbl_product SET title='$title', description='$description', price=$price, image_name='$image_name', category_id='$category', featured='$featured', active='$active'";
                    
                    //execute the query and save the data into the database
                    $res2 = mysqli_query($conn, $sql2);
                    
                    //check whether the query is executed or not
                    if($res2==true)
                    {
                        $_SESSION['add'] = "<div class='success'>Product added successfully.</div>";
                        header('location:'.SITEURL.'admin/manage.product.php');
                    
                    }
                    else
                    {
                        $_SESSION['add'] = "<div class='error'>Failed to add product.</div>";
                        header('location:'.SITEURL.'admin/manage.product.php');
                        die();
                    }
                }
        ?>
        <!-- Add product form ends here-->
    </div>
</div>





