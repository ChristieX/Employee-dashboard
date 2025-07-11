<?PHP
include('../common/connect_db.php');
$sql = "SELECT 
  e.id AS employee_id,
  e.first_name,
  e.last_name,
  e.email,
  e.phone,
  e.dob,
  e.gender,
  s.skill,
  s.proficiency_level
FROM 
  employees e
LEFT JOIN 
  skills s ON e.id = s.emp_id";

if (isset($_POST["search"]) && !empty($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
    $sql .= " WHERE e.first_name LIKE '%$searchTerm%'";
}

$sql .= " ORDER BY e.id";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed");
$output = "";
if (mysqli_num_rows($result) > 0) {
  $employees = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['employee_id'];
    if (!isset($employees[$id])) {
      $employees[$id] = [
        'name' => $row['first_name'] . ' ' . $row['last_name'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'dob' => $row['dob'],
        'gender' => $row['gender'],
        'skills' => []
      ];
    }
    if ($row['skill']) {
      $employees[$id]['skills'][] = $row['skill'] . ' (' . $row['proficiency_level'] . ')';
    }
  }

  $output = '<table class="table text-center table-striped table-bordered">
  <thead>
    <tr ">
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">phone</th>
      <th scope="col">date of birth</th>
      <th scope="col">Gender</th>
      <th scope="col">Skills</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>';

  foreach ($employees as $id => $emp) {
    if (!empty($emp['skills'])) {
      $skills = '<ul class="text-start mb-0">';
      foreach ($emp['skills'] as $skill) {
        $skills .= "<li> $skill</li>";
      }
      $skills .= '</ul>';
    } else {
      $skills = '<i>No skills</i>';
    }
    $genderLabel = $emp['gender'] === 'M' ? 'Male' : ($emp['gender'] === 'F' ? 'Female' : 'Other');
    $output .= "<tr>
        <td>{$emp['name']}</td>
        <td>{$emp['email']}</td>
        <td>{$emp['phone']}</td>
        <td>{$emp['dob']}</td>
        <td>{$genderLabel}</td>
        <td>{$skills}</td>
        <td>
            <button class='edit_btn btn btn-sm btn-warning' data-id='{$id}' data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button>
            <button class='btn btn-sm btn-danger delete-btn' data-id='{$id}'>Delete</button>
        </td>
    </tr>";
  }

  $output .= '</tbody></table>';
  echo $output;
} else {
  echo "<h2 class='text-center text-danger'>No Record Found</h2>";
}
