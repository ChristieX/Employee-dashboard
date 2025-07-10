<?php 
include('../common/connect_db.php');
$employee_id = $_POST['id'];
$sql = "DELETE FROM employees WHERE id = {$employee_id}";
if(mysqli_query($conn, $sql)){
    echo 1;
} else {
    echo 0;
}
?>