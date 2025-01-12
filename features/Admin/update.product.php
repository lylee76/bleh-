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
                    <textarea name="description" cols="30" rows="5"></textarea>
                </td>
            </tr>
            
            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" >
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    Display the image if available
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
                                    echo "<option value='$category_id'>$category_title</option>";    
                                }
                            } else { 
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
                    <input type="radio" name="featured" value="yes"> Yes
                    <input type="radio" name="featured" value="no"> No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="yes"> Yes
                    <input type="radio" name="active" value="no"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="submit" value="Update Product" class="btn-secondary">
                </td>
            </tr>


        </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>