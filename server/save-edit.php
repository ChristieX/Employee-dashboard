<?php 
include('../common/connect_db.php');
$emp_id = $_POST['id'];
$first_name= $_POST['first_name'];
$last_name= $_POST['last_name']; 
$email= $_POST['email'];
$phone= $_POST['phone'];
$dob= $_POST['dob'];
$gender= $_POST['gender'];
$sql = "UPDATE employees SET first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', phone = '{$phone}', dob = '{$dob}', gender = '{$gender}' WHERE id = {$emp_id}";
if(mysqli_query($conn, $sql)){
    echo 1;
} else {
    echo 0;
}
?> 