<?php
include('../common/common_files.php');
include('../common/connect_db.php');

echo '<script src="./client/js/add-skills.js"></script>';

function renderSkillRow($skill = '', $level = '', $skill_id = '') {
    $levels = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];
    $selectOptions = '<option value="" disabled ' . ($level === '' ? 'selected' : '') . '>Select proficiency</option>';
    foreach ($levels as $l) {
        $selected = ($level === $l) ? 'selected' : '';
        $selectOptions .= "<option value=\"$l\" $selected>$l</option>";
    }

    return '
    <div class="row mb-3 skill-row">
        <input type="hidden" name="skill_ids[]" class="skill-id" value="' . htmlspecialchars($skill_id) . '">
        <div class="col-md-5">
            <input type="text" name="skills[]" class="form-control skill" placeholder="Skill name" required value="' . htmlspecialchars($skill) . '">
        </div>
        <div class="col-md-5">
            <select name="proficiency_levels[]" class="form-select level" required>' . $selectOptions . '</select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-btn">X</button>
        </div>
    </div>';
}

$emp_id = $_POST['id'];
$sql = "SELECT e.*, s.id as skill_id, s.skill, s.proficiency_level 
        FROM employees e 
        LEFT JOIN skills s ON e.id = s.emp_id 
        WHERE e.id = {$emp_id}";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

if (mysqli_num_rows($result) > 0) {
    $skills = [];
    $employee = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employee = $row;
        if (!empty($row['skill'])) {
            $skills[] = [
                'skill' => $row['skill'],
                'level' => $row['proficiency_level'],
                'id'    => $row['skill_id']
            ];
        }
    }

    $output = '
<form method="POST" action="" id="editEmployeeForm">
  <input type="hidden" id="empId" name="id" value="' . $emp_id . '">

  <div class="row mb-3">
    <div class="col-md-6">
      <label for="first_name" class="form-label">First Name</label>
      <input type="text" name="first_name" id="first_name" class="form-control" value="' . htmlspecialchars($employee['first_name']) . '" required>
    </div>
    <div class="col-md-6">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" name="last_name" id="last_name" class="form-control" value="' . htmlspecialchars($employee['last_name']) . '" required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="' . htmlspecialchars($employee['email']) . '" required>
    </div>
    <div class="col-md-6">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" name="phone" id="phone" class="form-control" value="' . htmlspecialchars($employee['phone']) . '" required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6">
      <label for="dob" class="form-label">Date of Birth</label>
      <input type="date" name="dob" id="dob" class="form-control" value="' . $employee['dob'] . '" required>
    </div>
    <div class="col-md-6">
      <label for="gender" class="form-label">Gender</label>
      <select class="form-select" name="gender" id="gender" required>
        <option value="" disabled ' . ($employee['gender'] === '' ? 'selected' : '') . '>Choose...</option>
        <option value="M" ' . ($employee['gender'] === 'M' ? 'selected' : '') . '>Male</option>
        <option value="F" ' . ($employee['gender'] === 'F' ? 'selected' : '') . '>Female</option>
        <option value="O" ' . ($employee['gender'] === 'O' ? 'selected' : '') . '>Other</option>
      </select>
    </div>
  </div>

  <label class="form-label">Skills:</label>
  <div id="skills-wrapper">';

    if (!empty($skills)) {
        foreach ($skills as $s) {
            $output .= renderSkillRow($s['skill'], $s['level'], $s['id']);
        }
    } else {
        $output .= renderSkillRow();
    }

    $output .= '
  </div>

  <div id="skill-template" class="d-none">' . renderSkillRow() . '</div>

  <button type="button" id="addSkillBtn" class="btn btn-secondary mb-3">+ Add Another Skill</button>
  <br>
  <button type="submit" name="update-employee" id="update-employee" class="btn btn-success" data-bs-dismiss="modal">Update Employee</button>
</form>';

    echo $output;
} else {
    echo "<h2 class='text-center text-danger'>No Record Found</h2>";
}
?>
