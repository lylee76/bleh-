<?php
include('../config/constants.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet"  href="admin.css">
</head>
<body>
    <div class="login">
        <h2 class="text-center">login</h2>
        <br>

        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];//displaying session message
            unset($_SESSION['login']);//removing session messages
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];//displaying session message
            unset($_SESSION['no-login-message']);//removing session messages
        }
        ?>
        <br><br>

        <!-- login form starts here -->
        <form action="" method="post" class="text-center">
            Username: 
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>
            Password:
            <input type="password" name="password" placeholder="Enter Password">
            <br><br>
            <input type="submit" value="Login" class="btn-primary">
        </form>
        <br>

        <p class="text-center">Created by - Gurung and Lylee.</p>

        <!-- login form ends here -->

    </div>

</body>
</html>

<?php

//check whether the submit button is clicked or not

if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //sql query to check the username and password
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    
    //execute the query
    $res = mysqli_query($conn, $sql);

    //count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    
    if($count==1)
    {
        //user available and login success
        $_SESSION['login'] = "<div class = 'success'>Login Successful.</div>";
        $_SESSION['user'] = $username;//to check the user is logged in or not and logout will unset it.
        //redirect to home page
        header('location:'.SITEURL.'admin/index.php');
    }
    else
    {
        //user not available or login failed
        $_SESSION['login'] = "<div class = 'error text-center'>Username or Password did not match.</div>";
        //redirect to home page
        header('location:'.SITEURL.'admin/login.php');

    }

    
}

?>