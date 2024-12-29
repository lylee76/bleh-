<?php include('partials/header.php'); ?>


<!-- Main content section starts here-->
<div class="Main-content">
    <div class="wrapper" >
    <h2>Manage Admin</h2>
    <br>

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

    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];//displaying session message
        unset($_SESSION['update']);//removing session messages
    }

    
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];//displaying session message
        unset($_SESSION['update']);//removing session messages
    }

    ?>


    <br><br>
    <!-- button to add admin-->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br><br><br>
    
    <table class="tbl-full">
        <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>

        <?php
        //query to get all the admin
        $sql = "SELECT * FROM tbl_admin";
        //execute the query
        $res= mysqli_query($conn, $sql);

        //check where the query is executed or not
        if($res==true)
        {
            //get the number of rows
            $count = mysqli_num_rows($res);//function to get the number of rows
            
            $sn= 1;
            //check the number of rows
            if($count>0);
            {
                while($rows = mysqli_fetch_assoc($res))
                {
                    //get individual data
                    $id = $rows['id'];
                    $full_name = $rows['full_name'];
                    $username = $rows['username'];

                    //display the values in the table
                    ?>

                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $full_name;?></td>
                        <td><?php echo $username;?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <?php

                }
            }
        }
        ?>
    </table>
    </div>
</div>
<!-- Main Content section ends here-->


<?php include('partials/footer.php');?>