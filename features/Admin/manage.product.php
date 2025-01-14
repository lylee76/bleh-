<?php include('partials/header.php'); ?>

<!-- Main content section starts here-->
<div class="Main-content">
    <div class="wrapper" >
    <h2>Manage product</h2>
    <br><br>
    <!-- button to add admin-->
    <a href="<?php echo SITEURL;?>admin/add.product.php" class="btn-primary">Add Product</a>
    <br><br><br>

    <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);//removing session messages
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];//displaying session message
                unset($_SESSION['delete']);//removing session messages
            }

            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];//displaying session message
                unset($_SESSION['upload']);//removing session messages
            }

            if(isset($_SESSION['unauthorized']))
            {
                echo $_SESSION['unauthorized'];//displaying session message
                unset($_SESSION['unauthorized']);//removing session messages
            }

            if(isset($_SESSION['remove-failed']))
            {
                echo $_SESSION['remove-failed'];//displaying session message
                unset($_SESSION['remove-failed']);//removing session messages
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//displaying session message
                unset($_SESSION['update']);//removing session messages
            }

        ?>
        <br>
    
    <table class="tbl-full">
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>

            <?php 
            //query to get all products from database
            $sql = "SELECT * FROM tbl_product";

            //execute query
            $res = mysqli_query($conn, $sql);
            
            //check if any product exists in the database
            $count = mysqli_num_rows($res);

            //create serial number
            $sn = 1;

            if($count > 0)
            {
                //get the product from database
                while($rows = mysqli_fetch_assoc($res))
                {
                    //get individual product data
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $price = $rows['price'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];

                    ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php 
                                //check if image exists or not
                                    if($image_name == "")
                                    {
                                        //we dont have image display error message
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                    else
                                    {
                                        //we have image so disp;ay the image
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/products/<?php echo $image_name;?>" width="100px">

                                        <?php

                                    }
                                        
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update.product.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Product</a>
                                <a href="<?php echo SITEURL; ?>admin/delete.product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Product</a>
                            
                            </td>
                        </tr>

                    <?php
                }

            }
            else
            {
                echo "<tr><td colspan='7' class ='error'>No products found.</td></tr>";         
            }

        ?>

        
    </table>
    </div>
</div>
<!-- Main Content section ends here-->

<?php include('partials/footer.php');?>