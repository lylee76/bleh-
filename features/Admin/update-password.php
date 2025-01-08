<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php

// check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //echo"clicked";
    //1.get the data from from
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $id = $_POST['id'];

    //2.check whether the user with current id and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user exists and password can be changed
            //check whether the new password and confirm password match or not
            if($new_password==$confirm_password)
            {
                //update password
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                
                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether the query is executed or not
                if($res2==true)
                {
                    //display success message
                    //redirect to the admin page with error message
                    $_SESSION['pwd-change']="<div class='success'>Password changed successfully.</div>";
                    header('location:'.SITEURL.'admin/manage.admin.php');
                }
                else
                {
                    //display the error message
                    $_SESSION['pwd-change']="<div class='error'>Failed to change password.</div>";
                    header('location:'.SITEURL.'admin/manage.admin.php');
                }
            }
            else
            {
                //redirect to the admin page with error message
                $_SESSION['pwd-not-match']="<div class='error'>Password did not match.</div>";
                header('location:'.SITEURL.'admin/manage.admin.php');
            }
        }
        else
        {
            //user doesnot exist
            $_SESSION['user-not-found']="<div class='error'>User not found.</div>";
            header('location:'.SITEURL.'admin/manage.admin.php');
        }
    }    
}
?>

<?php include('partials/footer.php'); ?>