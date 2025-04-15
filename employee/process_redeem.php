<?php
session_start();
require_once('../db_connect.php');

$product = $_GET['product'];
$points = $_GET['points'];
$userID = $_SESSION['userID'];

$sql1 = "SELECT * FROM BALANCE_GP1 WHERE UserID = '$userID'";
$balance = $conn->query($sql1);
$balance = mysqli_fetch_array($balance);

if ($balance['Balance'] < $points) {
    $conn->close();
    header("Location: redeem_points.php?error=insufficient_points");
    exit;
} else {
  $sql = "INSERT INTO TRANSACTION_GP1 (UserID, TransactionDate, TransactionType, TransactionPoints, TransactionItem) VALUES ('$userID', NOW(), 'Redeem', '-$points', '$product')";
  $conn->query($sql);

  $balance_update_sql = "UPDATE BALANCE_GP1 SET Balance = Balance - '$points' WHERE UserID = '$userID'";
  $conn->query($balance_update_sql);

  $product_quantity_sql = "SELECT Quantity FROM PRODUCT_GP1 WHERE ProductName = '$product'";
  $product_quantity = $conn->query($product_quantity_sql);
  $product_quantity = mysqli_fetch_array($product_quantity);
  $newQuantity = $product_quantity['Quantity'] - 1;
  
  if ($newQuantity > 0) {
    $sql4 = "UPDATE PRODUCT_GP1 SET Quantity = '$newQuantity' WHERE ProductName = '$product'";
    $conn->query($sql4);
  } else {
    $sql4 = "DELETE FROM PRODUCT_GP1 WHERE ProductName = '$product'";
    $conn->query($sql4);
  }

  $conn->close();
  header("Location: home.php");
}
?>