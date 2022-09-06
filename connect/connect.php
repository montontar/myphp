<?php
date_default_timezone_set("Asia/Bangkok");
/*
 * set var
 */

$Host = "localhost:3306";
$User = "root";
$Password = "A$192dijd";
$Database = "php";

/*
 * connection mysql
 */
$conn = mysqli_connect($Host, $User, $Password,$Database);
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($conn, "utf8");
set_time_limit(0);
ini_set('mysql.connect_timeout','0');
ini_set('max_execution_time', '0');
?>
