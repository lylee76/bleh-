<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloomify";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn)
{
   //echo "connection ok";

}
else
{
    echo "Connection failed".mysqli_connect_error();
}
?>