<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "dets";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db($conn, $dbname);
if(mysqli_connect_errno()) {
    echo "Connection Fails".mysqli_connect_error();
}

?>