<?php include('partials/header.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h2>Add Product</h2>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; // Display session message
            unset($_SESSION['upload']); // Remove session message
        }
        ?>

        <!-- Add Product Form Starts Here -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Product Name" required>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
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
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Product Category:</td>
                    <td>
                        <select name="category" required>
                            <?php
                            // Query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
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
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check if the submit button is clicked
        if (isset($_POST['submit'])) {
            // Get all form data
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            $featured = isset($_POST['featured']) ? $_POST['featured'] : "no";
            $active = isset($_POST['active']) ? $_POST['active'] : "no";

            // Check if an image is uploaded
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];

                // Rename the image
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "product_" . rand(0000, 9999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/products/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                // If upload fails, set error message and stop process
                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location:' . SITEURL . 'admin/add.product.php');
                    die();
                }
            } else {
                // No image uploaded
                $image_name = "";
            }

            // Insert product into database
            $sql2 = "INSERT INTO tbl_product SET 
                title='$title', 
                description='$description', 
                price=$price, 
                image_name='$image_name', 
                category_id='$category', 
                featured='$featured', 
                active='$active'";

            $res2 = mysqli_query($conn, $sql2);

            // Check if query was successful
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Product added successfully.</div>";
                header('location:' . SITEURL . 'admin/manage.product.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add product.</div>";
                header('location:' . SITEURL . 'admin/add.product.php');
            }
        }
        ?>
        <!-- Add Product Form Ends Here -->
    </div>
</div>
