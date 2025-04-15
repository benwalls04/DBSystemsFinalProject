<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    
<?php
require_once('../db_connect.php');

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
    $conn->close();
    exit;
}

echo "<h1>Employees</h1>";

if ($employees->num_rows > 0) {
    echo "<div class='transactions'>";
    echo "<table>";
    echo "<tr><th>Employee Name</th><th>Group Number</th><th>Initial Balance</th><th>Current Balance</th><th>Actions</th></tr>";
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
    echo "</div>";
} else {
    echo "<p>No employees found</p>";
}

$conn->close();
?>

<div class="nav-links">
    <a href='award_points_form.php'>Award Points</a>
    <a href='add_employee.php'>Add Employee</a>
    <a href='home.php'>Back to Home</a>
</div>

</body>
</html>




