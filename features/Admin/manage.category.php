<<<<<<< HEAD
<?php include('partials/header.php'); ?>

<!-- Main content section starts here-->
<div class="Main-content">
    <div class="wrapper" >
    <h2>Manage Category</h2>

    <br><br>
    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing session messages
        }

        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];//displaying session message
            unset($_SESSION['remove']);//removing session messages
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];//displaying session message
            unset($_SESSION['delete']);//removing session messages
        }

        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];//displaying session message
            unset($_SESSION['no-category-found']);//removing session messages
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];//displaying session message
            unset($_SESSION['update']);//removing session messages
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing session messages
        }


        ?>
        <br><br>
    <!-- button to add admin-->
    <a href="<?php echo SITEURL;?>admin/add.category.php" class="btn-primary">Add Categtory</a>
    <br><br><br>
    
    <table class="tbl-full">
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>

        <?php
            //query to get all categories from database
            $sql = "SELECT * FROM tbl_category";

            //execute query
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            //create serial number and assign the value 1
            $sn = 1;

            //check whether we have data in databasse or not
            if($count>0)
            {
                //we have data in databasse
                //get the data and display it
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title;?></td>

                        <td>
                            <?php
                            //check whether the image is available or not
                            if($image_name != "")
                            {
                                //display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="50px">
                            <?php

                            }
                            else
                            {
                                //display the message
                                echo "<div class='error'>Image not added.</div>";
                            }

                            ?>
                        </td>

                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update.category.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete.category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>
" class="btn-danger"> Delete Category</a>

                        </td>
                    </tr>

                    <?php
                }
            }
            else
            {
                //we do not have data
                // we'll display the message inside the table
                ?>

                <tr>
                    <td colspan="6"><div class="error">No Category Added.</div></td>
                </tr>

                <?php
            }
        ?>
    </table>
    </div>
</div>
<!-- Main Content section ends here-->

=======
<?php include('partials/header.php'); ?>

<!-- Main content section starts here-->
<div class="Main-content">
    <div class="wrapper" >
    <h2>Manage Category</h2>

    <br><br>
    <!-- button to add admin-->
    <a href="#" class="btn-primary">Add Categtory</a>
    <br><br><br>
    
    <table class="tbl-full">
        <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>

        <tr>
            <td>1.</td>
            <td>Amylee Pakhrin</td>
            <td>lylee</td>
            <td>
                <a href="#" class="btn-secondary"> Update Admin</a>
                <a href="#" class="btn-danger"> Delete Admin</a>
                Delete Admin
            </td>
        </tr>

        <tr>
            <td>2.</td>
            <td>Amylee Pakhrin</td>
            <td>lylee</td>
            <td>
            <a href="#" class="btn-secondary"> Update Admin</a>
            <a href="#" class="btn-danger"> Delete Admin</a>
            </td>
        </tr>

        <tr>
            <td>3.</td>
            <td>Amylee Pakhrin</td>
            <td>lylee</td>
            <td>
            <a href="#" class="btn-secondary"> Update Admin</a>
            <a href="#" class="btn-danger"> Delete Admin</a>
            </td>
        </tr>
    </table>
    </div>
</div>
<!-- Main Content section ends here-->

>>>>>>> bbfb406ad95cf43132de031fbc9a96f54e27315c
<?php include('partials/footer.php');?>