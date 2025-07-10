<?php 
include('../common/connect_db.php');

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 function validateEmployeeData(){
        global $first_name, $last_name, $email, $phone, $dob, $gender;
        global $first_name_err, $last_name_err, $email_err, $phone_err, $dob_err, $gender_err;
        global $is_valid;

    if (empty($_POST["first_name"])) {
            $first_name_err = "First name is required";
            $is_valid = false;
        } else {
            $first_name = test_input($_POST["first_name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
                $first_name_err = "Only letters and white space allowed";
                $is_valid = false;
            }
        }
        if (empty($_POST["last_name"])) {
            $last_name_err = "Last name is required";
            $is_valid = false;
        } else {
            $last_name = test_input($_POST["last_name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
                $last_name_err = "Only letters and white space allowed";
                $is_valid = false;
            }
        }
        if (empty($_POST["phone"])) {
            $phone_err = "Phone number is required";
            $is_valid = false;
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{10}$/", $phone)) {
                $phone_err = "Invalid phone number format";
                $is_valid = false;
            }
        }
        if (empty($_POST["email"])) {
            $email_err = "Email is required";
            $is_valid = false;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format";
                $is_valid = false;
            }
        }
        if (empty($_POST["dob"])) {
            $dob_err = "Date of birth is required";
            $is_valid = false;
        } else {
            $dob = test_input($_POST["dob"]);
        }
        if(empty($_POST["gender"])){
            $gender_err = "Gender is required";
            $is_valid = false;
        } else {
            $gender = test_input($_POST["gender"]);
        }
 };
?>