<?PHP
$first_name = $last_name = $email = $phone = $dob = $gender = "";
$first_name_err = $last_name_err = $email_err = $phone_err = $dob_err = $gender_err = "";
$is_valid = true;
include('../common/connect_db.php');
$emp_id = $_POST['id'];
$sql = "Select * from employees where id = {$emp_id}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed");
$output = "";
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $output = '
<form method="POST" action="" id="editEmployeeForm">
    <input type="hidden" id="empId" name="id" value="' . $emp_id . '">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control ' . ($first_name_err ? 'is-invalid' : '') . '" value="' . htmlspecialchars($row['first_name']) . '" required>
            ' . ($first_name_err ? '<div class="invalid-feedback d-block">' . $first_name_err . '</div>' : '') . '
        </div>
        <div class="col-md-6">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control ' . ($last_name_err ? 'is-invalid' : '') . '" value="' . htmlspecialchars($row['last_name']) . '" required>
            ' . ($last_name_err ? '<div class="invalid-feedback d-block">' . $last_name_err . '</div>' : '') . '
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control ' . ($email_err ? 'is-invalid' : '') . '" value="' . htmlspecialchars($row['email']) . '" required>
            ' . ($email_err ? '<div class="invalid-feedback d-block">' . $email_err . '</div>' : '') . '
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control ' . ($phone_err ? 'is-invalid' : '') . '" value="' . htmlspecialchars($row['phone']) . '" required>
            ' . ($phone_err ? '<div class="invalid-feedback d-block">' . $phone_err . '</div>' : '') . '
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control ' . ($dob_err ? 'is-invalid' : '') . '" value="' . $row['dob'] . '" required>
            ' . ($dob_err ? '<div class="invalid-feedback d-block">' . $dob_err . '</div>' : '') . '
        </div>
        <div class="col-md-6">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select ' . ($gender_err ? 'is-invalid' : '') . '" name="gender" id="gender" required>
                <option value="" ' . ($row['gender'] === '' ? 'selected' : '') . ' disabled>Choose...</option>
                <option value="M" ' . ($row['gender'] === 'M' ? 'selected' : '') . '>Male</option>
                <option value="F" ' . ($row['gender'] === 'F' ? 'selected' : '') . '>Female</option>
                <option value="O" ' . ($row['gender'] === 'O' ? 'selected' : '') . '>Other</option>
            </select>
            ' . ($gender_err ? '<div class="invalid-feedback d-block">' . $gender_err . '</div>' : '') . '
        </div>
    </div>

    <button type="submit" name="update-employee" class="btn btn-success" id="update-employee">Update Employee</button>
</form>';
  }

  echo $output;
} else {
  echo "<h2 class='text-center text-danger'>No Record Found</h2>";
}
