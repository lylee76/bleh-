<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>

        <br><br>
        <?php
        //1. get the id of the selected admin
        $id = $_GET['id'];

        //2. get the data of the selected admin from the database
        $sql = "SELECT* FROM tbl_admin WHERE id=$id";

        //3. display the data in the form fields
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $count= mysqli_num_rows($res);

            if($count==1)
            {
                $rows = mysqli_fetch_assoc($res);

                //get individual data
                $full_name = $rows['full_name'];
                $username = $rows['username'];

            }
            else{
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        ?>



        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name;?>" >
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" value="<?php echo $username;?>">
                </td>
            </tr>
    
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">

                </td>
            </tr>
        </table>    
    </div>
</div>
<?php
if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE tbl_admin SET full_name='$full_name', username='$username' WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query is executed successfully or not
    if($res==true)
    {
        $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
        header('location:'.SITEURL.'admin/manage.admin.php');
    }
    else{
        $_SESSION['update'] ="<div class='success'>Failed to update admin</div>";
        header('location:'.SITEURL.'admin/update-admin.php?id='.$id);
    }

}
?>


<?php include('partials/footer.php'); ?>