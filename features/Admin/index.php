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

            <?php
                //sql query
                $sql = "SELECT * FROM tbl_category";
                //execute the query
                $result = mysqli_query($conn, $sql);
                //get the number of rows
                $count = mysqli_num_rows($result);
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">

                <?php
                    //sql query
                    $sql2 = "SELECT * FROM tbl_product";
                    //execute the query
                    $result2 = mysqli_query($conn, $sql2);
                    //get the number of rows
                    $count2 = mysqli_num_rows($result2);
                ?>
            <h1><?php echo $count2;?></h1>
            <br />
            Products
        </div>

        <div class="col-4 text-center">

                <?php
                    //sql query
                    $sql3 = "SELECT * FROM tbl_order";
                    //execute the query
                    $result3 = mysqli_query($conn, $sql3);
                    //get the number of rows
                    $count3 = mysqli_num_rows($result3);
                ?>
            <h1><?php echo $count2;?></h1>
            <br />
            Total Orders
        </div>

        <div class="col-4 text-center">

            <?php
                //sql query to get total revenue generated
                //aggregate function in sql
                $sql4 = "SELECT SUM(total) as TOTAL FROM tbl_order WHERE status ='delivered'";
                //execute the query
                $result4 = mysqli_query($conn, $sql4);

                //fetch the data
                $row4 = mysqli_fetch_assoc($result4);
                
                //get the total revenue from the fetched data
                $total_revenue = $row4['TOTAL'];
            ?>
            <h1>$<?php echo $total_revenue;?></h1>
            <br />
            Revenue Generated
        </div>

        <div class="clearfix"></div>
    

    </div>
</div>
<!-- Main Content section ends here-->

<?php include('partials/footer.php')?>