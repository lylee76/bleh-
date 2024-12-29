<?php
//start session
session_start();

//create constants to store the repeating values

define('SITEURL','http://localhost/bleh-/features/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','bloomify');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error($conn));//selecting database


?>