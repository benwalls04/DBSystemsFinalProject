<?php
require_once('db_connect.php');

$userID = $_POST['UserId'];
$userType = $_POST['UserType'];
$password = $_POST['Password'];

if ($userType == 'Employee') {
    $login_sql = "SELECT * FROM EMPLOYEE_GP1 WHERE UserID = '$userID' AND Password = '$password'";
} else {
    $login_sql = "SELECT * FROM MANAGER_GP1 WHERE UserID = '$userID' AND Password = '$password'";
}

$result = $conn->query($login_sql);
$conn->close();

if ($result->num_rows > 0) {
  session_start();
  $_SESSION['userID'] = $userID;
  $_SESSION['userType'] = $userType;
  if ($userType == 'Employee') {
    header("Location: employee/home.php");
  } else {
    header("Location: manager/home.php");
  }
} else {
  header("Location: index.php?error=invalid_credentials");
}
?>
