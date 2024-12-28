<html> 
    <head>
        <title>Display</title>
        <style>
            body
            {
            background-color: #6f9b3c;
    
            }
            table
            {
                background: white;
            }
        </style>
    </head>


<?php
include("connection.php");
error_reporting(0);

// Query to fetch all rows from the `form` table
$query = "SELECT * FROM form";
$data = mysqli_query($conn, $query);

// Check if query execution was successful
if ($data) {
    $total = mysqli_num_rows($data);

    // Check if the table has records
    if ($total > 0) {
       // echo "Table has records:<br>";
        ?>
        <h2 align="center"><mark>Displaying all the records</mark></h2>
       <center> <table border="1px" cellspacing="7">
        <tr>
        <th width="10%">First Name</th>
        <th width="10%">Last Name</th>
        <th width="10%">Gender</th>
        <th width="25%">Email</th>
        <th width="20%">Phone</th>
        <th width="15%">Address</th>
         </tr>
        
        <?php
        // Fetch and display all rows
        while ($result = mysqli_fetch_assoc($data))
         {
           echo "<tr>
                     <td>" . $result['firstname'] . "</td>
                     <td>" . $result['lname'] . "</td>
                     <td>" . $result['gender'] . "</td>
                     <td>" . $result['email'] . "</td>
                     <td>" . $result['phone'] . "</td>
                     <td>" . $result['address'] . "</td>
         </tr>
    ";   
        }
    } else {
        echo "No records found.";
    }
} else {
    echo "Error in query execution: " . mysqli_error($conn);
}
?>
</table>
</center>
</html>