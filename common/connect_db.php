<?php
$host = "db"; 
$username = "user";
$password = "password";
$database = "mydb";


$conn=new mysqli($host, $username, $password, $database);
if($conn->connect_error){
    die("not connected with DB" . $conn->connect_error);
}
?>