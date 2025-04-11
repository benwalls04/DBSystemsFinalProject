<?php
session_start();
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');

$product = $_GET['product'];
$points = $_GET['points'];
$userID = $_SESSION['userID'];

$sql1 = "SELECT * FROM BALANCE_GP1 WHERE UserID = '$userID'";
$balance = $conn->query($sql1);
$balance = mysqli_fetch_array($balance);

if ($balance['Balance'] < $points) {
  header("Location: redeem_points.php?error=insufficient_points");
  exit;
} else {
  $sql = "INSERT INTO TRANSACTION_GP1 (UserID, TransactionDate, TransactionType, TransactionPoints, TransactionItem) VALUES ('$userID', NOW(), 'Redeem', '-$points', '$product')";
  $conn->query($sql);

  $sql2 = "UPDATE BALANCE_GP1 SET Balance = Balance - '$points' WHERE UserID = '$userID'";
  $conn->query($sql2);

  $sql3 = "UPDATE PRODUCT_GP1 SET Quantity = Quantity - 1 WHERE ProductName = '$product'";
  $conn->query($sql3);
  header("Location: employee_home.php");
}

$conn->close();
?>