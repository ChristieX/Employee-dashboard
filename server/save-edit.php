<?php
include('../common/connect_db.php');

$emp_id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];

$skills = isset($_POST['skills']) ? json_decode($_POST['skills'], true) : [];

$success = true;

// 1. Update employee info
$sql = "UPDATE employees 
        SET first_name = '{$first_name}', 
            last_name = '{$last_name}', 
            email = '{$email}', 
            phone = '{$phone}', 
            dob = '{$dob}', 
            gender = '{$gender}' 
        WHERE id = {$emp_id}";
if (!mysqli_query($conn, $sql)) {
    $success = false;
}

// 2. Fetch current skill IDs (updated to fetch skill_id)
$currentSkillIds = [];
$res = mysqli_query($conn, "SELECT id FROM skills WHERE emp_id = {$emp_id}");
while ($row = mysqli_fetch_assoc($res)) {
    $currentSkillIds[] = $row['id'];
}

// 3. Track submitted skill IDs
$submittedIds = [];

foreach ($skills as $s) {
    $skill_id = isset($s['id']) ? intval($s['id']) : null;
    $skill = mysqli_real_escape_string($conn, $s['skill']);
    $level = mysqli_real_escape_string($conn, $s['level']);

    if ($skill_id) {
        // Update existing skill
        $submittedIds[] = $skill_id;
        $updateQuery = "UPDATE skills 
                        SET skill = '$skill', proficiency_level = '$level' 
                        WHERE id = $skill_id AND emp_id = $emp_id";
        if (!mysqli_query($conn, $updateQuery)) {
            $success = false;
        }
    } else {
        // Insert new skill
        $insertQuery = "INSERT INTO skills (emp_id, skill, proficiency_level) 
                        VALUES ($emp_id, '$skill', '$level')";
        if (!mysqli_query($conn, $insertQuery)) {
            $success = false;
        }
    }
}

// 4. Delete removed skills
$toDelete = array_diff($currentSkillIds, $submittedIds);
if (!empty($toDelete)) {
    $ids = implode(",", array_map('intval', $toDelete));
    $deleteQuery = "DELETE FROM skills WHERE id IN ($ids)";
    if (!mysqli_query($conn, $deleteQuery)) {
        $success = false;
    }
}

echo $success ? 1 : 0;
?>
