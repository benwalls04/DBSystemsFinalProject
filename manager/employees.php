<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM EMPLOYEE_GP1, BALANCE_GP1 WHERE EMPLOYEE_GP1.UserID = BALANCE_GP1.UserID";
$employees = $conn->query($sql);

function deleteEmployee($empId){
  global $conn;
  $sql = "DELETE FROM EMPLOYEE_GP1 WHERE UserID = '$empId'";
  $conn->query($sql);
  header("Location: employees.php");
}

if (isset($_GET['delete'])) {
  deleteEmployee($_GET['delete']);
  exit;
}

if ($employees->num_rows > 0) {
  echo "<h1>Employees</h1>";
  echo "<table>"; 
  echo "<tr><th>Employee Name</th><th>Group Number</th><th>Initial Balance</th><th>Current Balance</th><th></th></tr>";
  while ($row = mysqli_fetch_array($employees)) {
    echo "<tr>
      <td>" . $row['EmpName'] . "</td>
      <td>" . $row['GroupNO'] . "</td>
      <td>" . $row['InitialBalance'] . "</td>
      <td>" . $row['Balance'] . "</td>
      <td><a href='employees.php?delete=" . $row['UserID'] . "'>Delete</a></td>
    </tr>";
  }
  echo "</table>";
} else {
  echo "<h1>No employees found</h1>";
}

$conn->close();
?>

<br>
<a href='award_points_form.php'>Award Points</a>
<a href='add_employee.php'>Add Employee</a> <br><br>
<a href='home.php'>Back to Home</a> <br>




