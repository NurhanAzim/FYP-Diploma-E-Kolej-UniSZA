<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "db_kolejkediaman";

$conn = mysqli_connect("$host", "$username", "$password", "$database");

if($conn->connect_error){
    header("Location: dberror.php");
    die('Connection Failed : '. $conn->connect_error);
}
?>