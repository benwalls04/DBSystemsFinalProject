<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addEmployee($empname, $groupno, $initialbalance, $empid, $password, $mrgid, $mrgpass){
    global $conn;

    if (empty($empname) || empty($groupno) || empty($initialbalance) || empty($empid) || empty($password) || empty($mrgid) || empty($mrgpass)) {
        header("Location: add_employee.php?error=empty_fields");
        exit;
    }

    if (!is_numeric($initialbalance) || $initialbalance <= 0) {
        header("Location: add_employee.php?error=invalid_initialbalance");
        exit;
    }

    if (!is_numeric($groupno) || $groupno <= 0) {
        header("Location: add_employee.php?error=invalid_groupno");
        exit;
    }

    $mgr_auth_sql = "SELECT * FROM MANAGER_GP1 WHERE UserID = '$mrgid' AND Password = '$mrgpass'";
    $mgr_auth_result = $conn->query($mgr_auth_sql);

    if ($mgr_auth_result->num_rows > 0) {
        $emp_sql = "INSERT INTO EMPLOYEE_GP1 (EmpName, UserID, GroupNO, Password) VALUES ('$empname', '$empid', '$groupno', '$password')";
        $balance_sql = "INSERT INTO BALANCE_GP1 (UserID, InitialBalance, Balance) VALUES ('$empid', '$initialbalance', '$initialbalance')";
        $conn->query($emp_sql);
        $conn->query($balance_sql);
        header("Location: employees.php");
    } else {
        header("Location: add_employee.php?error=invalid_manager");
        exit;
    }
}

if (isset($_POST['submit'])){
    addEmployee($_POST['EmpName'], $_POST['GroupNO'], $_POST['InitialBalance'], $_POST['EmpID'], $_POST['Password'], $_POST['MgrID'], $_POST['MgrPass']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>  
    <h1>Add Employee</h1>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'empty_fields') {
            echo "<p class='error'>Please fill in all fields.</p>";
        } elseif ($_GET['error'] == 'invalid_initialbalance') {
            echo "<p class='error'>Initial balance must be a positive number.</p>";
        } elseif ($_GET['error'] == 'invalid_groupno') {
            echo "<p class='error'>Group number must be a positive number.</p>";
        } elseif ($_GET['error'] == 'invalid_manager') {
            echo "<p class='error'>Invalid manager ID or password.</p>";
        }
    }
    ?>
    <form action="add_employee.php" method="POST">
        <label for="empname">Employee Name:</label>
        <input type="text" name="EmpName" id="empname">
        <br>
        <br>
        <label for="groupno">Group Number:</label>
        <input type="text" name="GroupNO" id="groupno">
        <br>
        <br>
        <label for="initbalance">Initial Balance:</label>
        <input type="number" name="InitialBalance" id="initbalance">
        <br>
        <br>
        <label for="empid">Employee User ID:</label>
        <input type="text" name="EmpID" id="empid">
        <br>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="Password" id="password">
        <br>
        <br>
        <label for="mrgid">Your User ID:</label>
        <input type="text" name="MgrID" id="mrgid">
        <br>
        <br>
        <label for="mrgpass">Your Password:</label>
        <input type="password" name="MgrPass" id="mrgpass">
        <br>
        <br>
        <button type="submit" name="submit">Add Employee</button>
    </form>
    <div class="nav-links">
        <a href="employees.php">Back to Employees</a>
    </div>
</body>
</html>