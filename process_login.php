<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) die($conn->connect_error);

$userID = $_POST['UserId'];
$userType = $_POST['UserType'];
$password = $_POST['Password'];

if ($userType == 'Employee') {
    $sql = "SELECT * FROM EMPLOYEE_GP1 WHERE UserID = '$userID' AND Password = '$password'";
} else {
    $sql = "SELECT * FROM MANAGER_GP1 WHERE UserID = '$userID' AND Password = '$password'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  session_start();
  $_SESSION['userID'] = $userID;
  $_SESSION['userType'] = $userType;
  if ($userType == 'Employee') {
    header("Location: /employee/home.php");
  } else {
    header("Location: /manager/home.php");
  }
} else {
  header("Location: index.php");
  echo "Invalid username or password";
}
