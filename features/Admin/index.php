<<<<<<< HEAD
<?php include('partials/header.php'); ?>

<!-- Main content section starts here-->
<div class="Main-content">
    <div class="wrapper" >
    <h2>DASHBOARD</h2>
    <br>
    <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];//displaying session message
            unset($_SESSION['login']);//removing session messages
        }
    ?>
    <br><br>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="clearfix"></div>
    

    </div>
</div>
<!-- Main Content section ends here-->

<?php include('partials/footer.php')?>
=======
<<<<<<< HEAD
<?php include('partials/header.php'); ?>
=======
<html>
    <head>
        <title>Bloomify</title>
        <link rel="stylesheet"  href="/CSS/admin.css">
    </head>
    <body>
        
<!-- Product section starts here-->
<div class="product">
    <div class="wrapper" >
        Product goes here
    </div>
</div>
<!-- Product section ends here-->
>>>>>>> d2bfb52e21f661a982dbe69f0a1e06aa5a776367

<!-- Main content section starts here-->
<div class="Main-content">
    <div class="wrapper" >
<<<<<<< HEAD
    <h2>DASHBOARD</h2>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="clearfix"></div>
    
=======
        main content goes here
>>>>>>> d2bfb52e21f661a982dbe69f0a1e06aa5a776367

    </div>
</div>
<!-- Main Content section ends here-->

<<<<<<< HEAD
<?php include('partials/footer.php')?>
=======
<!-- Footer section starts here-->
<div class="footer">
    <div class="wrapper" >
    <p class="text-center">©2024 Bloomify of Gurung and lylee. All rights reserved.
</p>
    </div>
</div>
<!-- Footer section ends here-->


    </body>
</html>
<?php echo "Hello, World!"; ?>
>>>>>>> d2bfb52e21f661a982dbe69f0a1e06aa5a776367
>>>>>>> bbfb406ad95cf43132de031fbc9a96f54e27315c
