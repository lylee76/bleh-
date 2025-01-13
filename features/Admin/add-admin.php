<<<<<<< HEAD
<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Admin</h2>
        <br>
    <?php
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];//displaying session message
        unset($_SESSION['add']);//removing session messages
    }
    ?>
    <br><br>

        <form action="" method="POST"> 

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter Your Name">
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" placeholder="Enter Your Username">
                </td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Enter Your Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">

                </td>
            </tr>
        </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php');?>

<?php 

//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //1.get the form data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);//password encryption

    //2.sql query to save the data into the database
    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

    //3. execute the query amd save the data into the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
    //4 check whether the query is executed or not 
    if($res==true)
    {
        //create session variable to display the message
        $_SESSION['add'] = "Admin added successfully";
        //redirect to the manage admins page
        header('location:'.SITEURL.'admin/manage.admin.php');
    }
    else{
         //create session variable to display the message
        $_SESSION['add'] = "Failed to Add admin";
         //redirect to the add admin page
        header('location:'.SITEURL.'admin/add-admin.php');
    }
}

=======
<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Admin</h2>
        <br>
    <?php
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];//displaying session message
        unset($_SESSION['add']);//removing session messages
    }
    ?>
    <br><br>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter Your Name">
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" placeholder="Enter Your Username">
                </td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Enter Your Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">

                </td>
            </tr>
        </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php');?>

<?php 

//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //1.get the form data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);//password encryption

    //2.sql query to save the data into the database
    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

    //3. execute the query amd save the data into the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
    //4 check whether the query is executed or not 
    if($res==true)
    {
        //create session variable to display the message
        $_SESSION['add'] = "Admin added successfully";
        //redirect to the manage admins page
        header('location:'.SITEURL.'admin/manage.admin.php');
    }
    else{
         //create session variable to display the message
        $_SESSION['add'] = "Failed to Add admin";
         //redirect to the add admin page
        header('location:'.SITEURL.'admin/add-admin.php');
    }
}

>>>>>>> bbfb406ad95cf43132de031fbc9a96f54e27315c
?>