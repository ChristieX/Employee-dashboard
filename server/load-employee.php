<?PHP 
include('../common/connect_db.php');
$sql = "Select * from employees";
$result = mysqli_query($conn,$sql) or die("SQL Query Failed");
$output="";
if(mysqli_num_rows($result)>0){
$output = '<table class="table text-center table-striped table-bordered">
  <thead>
    <tr ">
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">phone</th>
      <th scope="col">date of birth</th>
      <th scope="col">Gender</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>';
  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
      <td> {$row['first_name']} {$row['last_name']}</td>
      <td>{$row['email']}</td>
      <td>{$row['phone']}</td>
      <td>{$row['dob']}</td>
      <td>{$row['gender']}</td>
      <td>
      <button class='btn btn-sm btn-success projects-btn me-3' data-id='{$row['id']}'>View Projects</button>
        <button class='edit_btn btn btn-sm btn-warning' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button>
        <button class='btn btn-sm btn-danger delete-btn' data-id='{$row['id']}'>Delete</button>
      </td>
    </tr>";
  }
    $output .= '
        </tbody>
    </table>';
    echo $output;
}else{
   echo "<h2 class='text-center text-danger'>No Record Found</h2>";
}
?>