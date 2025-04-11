<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addEmployee($empname, $groupno, $initialbalance, $empid, $password, $mrgid, $mrgpass){
    global $conn;
    $sql1 = "SELECT * FROM MANAGER_GP1 WHERE UserID = '$mrgid' AND Password = '$mrgpass'";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        $sql2 = "INSERT INTO EMPLOYEE_GP1 (EmpName, UserID, GroupNO, Password) VALUES ('$empname', '$empid', '$groupno', '$password')";
        $sql3 = "INSERT INTO BALANCE_GP1 (UserID, InitialBalance, Balance) VALUES ('$empid', '$initialbalance', '$initialbalance')";
        $conn->query($sql2);
        $conn->query($sql3);
        header("Location: employees.php");
    } else {
        header("Location: .php");
        echo "Invalid manager ID or password";
    }
}

if (isset($_POST['submit'])){
    addEmployee($_POST['EmpName'], $_POST['GroupNO'], $_POST['InitialBalance'], $_POST['EmpID'], $_POST['Password'], $_POST['MgrID'], $_POST['MgrPass']);
    exit;
}
?>

<html>
<head>
    <title>Add Employee</title>
</head>
<body>  
    <h1>Add Employee</h1>
    <form action="process_add_employee.php" method="POST">
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
</body>
</html>

<br>
<a href="employees.php">Back to Employees</a>