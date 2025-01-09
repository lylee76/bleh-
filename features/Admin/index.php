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